<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-search
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
