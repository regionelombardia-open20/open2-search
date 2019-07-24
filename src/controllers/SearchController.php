<?php
/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search\controllers
 * @category   CategoryName
 */

namespace lispa\amos\search\controllers;

use lispa\amos\search\models\GeneralSearch;
use Yii;
use lispa\amos\core\controllers\BackendController;
use lispa\amos\search\assets\SearchAsset;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class SearchController
 * @package lispa\amos\search\controllers
 */
class SearchController extends BackendController
{
    /**
     * @var string $layout
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        SearchAsset::register(Yii::$app->view);
        $this->setUpLayout();
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
                [
                'access' => [
                    'class' => AccessControl::className(),
                    'ruleConfig' => [
                        'class' => AccessRule::className(),
                    ],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'do-search'
                            ],
                            'roles' => ['@']
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post', 'get']
                    ]
                ]
        ]);
    }

    public function actionIndex($layout = null, $queryString = null, $tagIds = null, $moduleName = null)
    {

        Url::remember();
        $modelSearch = new GeneralSearch();
        $searchModule = Yii::$app->getModule('search');
        if(!$searchModule->enableNetworkScope) {
            $moduleCwh = Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                $moduleCwh->resetCwhScopeInSession();
            }
        }
        $modulesToSearch = $searchModule->modulesToSearch;
        $modelSearch->load(\Yii::$app->request->get());

        if (!empty($tagIds) && array_key_exists('admin', $modulesToSearch)) {
            $admin['admin']  = $modulesToSearch['admin'];
            $modulesToSearch = array_diff($modulesToSearch, $admin);
        }

        //if there's a current module, display the result block for that module first
        if (!is_null($moduleName) && array_key_exists($moduleName, $modulesToSearch)) {
            $moduleArray[$moduleName] = $modulesToSearch[$moduleName];
            if (!empty($tagIds)) {
                $modulesToSearch = $moduleArray;
            } else {
                $modulesToSearch = ArrayHelper::merge($moduleArray, $modulesToSearch);
            }
        }

        return $this->render('index',
                [
                'queryString' => $queryString,
                'tagIds' => $tagIds,
                'searchModels' => $modulesToSearch,
                'moduleName' => $moduleName ? $moduleName : null,
                'modelSearch' => $modelSearch
        ]);
    }

    public function actionDoSearch($layout = null, $queryString = null, $moduleName = null, $tagIds = null)
    {
        Url::remember();
        $modelSearch = new GeneralSearch();
        $modelSearch->load(\Yii::$app->request->get());


        $searchModule = Yii::$app->getModule('search');
        if(!$searchModule->enableNetworkScope) {
            $moduleCwh = Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                $moduleCwh->resetCwhScopeInSession();
            }
        }

        $searchParamsArray = !empty($queryString) ? explode(" ", $queryString) : [];

        $searchModelName    = $searchModule->modulesToSearch[$moduleName];
        $currentModelSearch = new $searchModelName();

        $modelLabel = $currentModelSearch->getGrammar()->getModelLabel();

        if (!empty($tagIds)) {
            $arrayTagIds = explode(',',$tagIds);
            $dataProvider = $currentModelSearch->globalSearchTags($arrayTagIds);
        } else {
            $dataProvider = $currentModelSearch->globalSearch($searchParamsArray);

        }

        if (Yii::$app->request->isPjax) {
            return $this->render('doSearch',
                    [
                    'dataProvider' => $dataProvider,
                    'queryString' => $queryString,
                    'tagIds' => $tagIds,
                    'moduleName' => $moduleName ? $moduleName : null,
                    'modelLabel' => $modelLabel ? $modelLabel : null,
                    'modelSearch' => $modelSearch
            ]);
        } else {
            // La richiesta non è Pjax. Faccio redirect alla search index passando la query string.
            return $this->redirect(['/search/search/index', 'queryString' => $queryString, 'tagIds' => $tagIds, 'moduleName' => $moduleName]);
        }
    }
}