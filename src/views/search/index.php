<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\search\views\search
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */


use yii\widgets\Pjax;
use open20\amos\search\AmosSearch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var open20\amos\documenti\models\search\DocumentiSearch $model
 * @var \open20\amos\dashboard\models\AmosUserDashboards $currentDashboard
 */

/** @var \open20\amos\documenti\controllers\DocumentiController $controller */



$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = AmosSearch::t('amossearch', '#search_title');

$queryString = \yii\helpers\HtmlPurifier::process(trim($queryString));
$queryString = strip_tags($queryString);
$queryString = addslashes($queryString);

$tagIds = \yii\helpers\HtmlPurifier::process(trim($tagIds));
$tagIds = strip_tags($tagIds);
$tagIds = addslashes($tagIds);



echo $this->render('_search', [
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id,
    'modelSearch' => $modelSearch
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
            'modelSearch' => $modelSearch,
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
