<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

use open20\amos\core\views\ListView;
use open20\amos\core\icons\AmosIcons;
use open20\amos\search\AmosSearch;
use yii\widgets\Pjax;

Pjax::begin([
    'id' => 'pjax-'.$moduleName
]);

$queryString = \yii\helpers\HtmlPurifier::process(trim($queryString));
$tagIds = \yii\helpers\HtmlPurifier::process(trim($tagIds));


$queryString = strip_tags($queryString);
$queryString = addslashes($queryString);
$tagIds = strip_tags($tagIds);
$tagIds = addslashes($tagIds);

/*
pr($queryString);
die();
*/

echo $this->render('_pjaxForm', [
    'moduleName' => $moduleName,
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id,
    'modelSearch' => $modelSearch
]);

if ($dataProvider->getTotalCount() > 0) {
    ?>
    <div class="row search-row-buffer">
        <div class="col-md-12">
            <div class="search-title" data-result-count="<?= $dataProvider->getTotalCount() ?>">
                <?= AmosIcons::show(Yii::$app->getModule($moduleName)->getModuleIconName(), ['class' => 'search-section-icon h3'], 'dash') ?><span class="h3"><?= strtoupper($modelLabel) ?></span> <span class="h4">(<?= AmosSearch::t('amossearch', '{0} di {1}', [$dataProvider->getCount(), $dataProvider->getTotalCount()]) ?>)</span>
            </div>
        </div>
    </div>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
    ]);
}

Pjax::end();
