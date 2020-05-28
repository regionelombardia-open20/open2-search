<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\search\assets
 * @category   CategoryName
 */

namespace open20\amos\search\assets;

use yii\web\AssetBundle;
use open20\amos\core\widget\WidgetAbstract;


/**
 * Class SearchAsset
 * @package open20\amos\search\assets
 */
class SearchAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/open20/amos-search/src/assets/web';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG, 
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'less/search.less'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/search.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];
    
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/search_fullsize.less'];
        }

        if (!empty($moduleL)) {
            $this->depends [] = 'open20\amos\layout\assets\BaseAsset';
        } else {
            $this->depends [] = 'open20\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }

}
