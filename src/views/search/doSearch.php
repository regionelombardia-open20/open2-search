<?php

use lispa\amos\core\views\ListView;
use lispa\amos\core\icons\AmosIcons;
use lispa\amos\search\AmosSearch;
use yii\widgets\Pjax;

Pjax::begin([
    'id' => 'pjax-'.$moduleName
]);

echo $this->render('_pjaxForm', [
    'moduleName' => $moduleName,
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id
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
