<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search\views\search
 * @category   CategoryName
 */


use yii\widgets\Pjax;
use lispa\amos\search\AmosSearch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var lispa\amos\documenti\models\search\DocumentiSearch $model
 * @var \lispa\amos\dashboard\models\AmosUserDashboards $currentDashboard
 */

/** @var \lispa\amos\documenti\controllers\DocumentiController $controller */


$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = AmosSearch::t('amossearch', '#search_title');

echo $this->render('_search', [
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id
]);
?>

<div class="row">
    <div class="col-xs-12 results-info">
        <span id="results-info" data-i18n="<?= AmosSearch::t('amossearch','Sono stati trovati <strong>#NUMEL#</strong> elementi') ?>"></span>
    </div>
</div>
<div class="search-index">
    <div class="list_view">
    <?php
    foreach($searchModels as $moduleName => $moduleConfigs){

        Pjax::begin([
            'id' => 'pjax-'.$moduleName, // checked id on the inspect element
            'options' => ['class' => 'pjax-container clearfix'],
            'enablePushState' => false , // I would like the browser to change link
            'timeout' => 60000// Timeout needed
        ]);

        echo $this->render('_pjaxForm',[
            'moduleName' => $moduleName,
            'queryString' => $queryString,
            'tagIds' => $tagIds,
            'originAction' => Yii::$app->controller->action->id
        ]);

        Pjax::end();
    }
    $js = <<<JS
   
JS;

    $this->registerJs($js);
    ?>
    </div>
</div>
