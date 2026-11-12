<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\search
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
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\module\BaseAmosModule;
use open20\amos\core\helpers\Html;
?>
<div class="listview-container">
    <div class="post-horizontal">
        <?php
        $dataPubblicazione=null;
        if ($model->data_pubblicazione) {
            $dataPubblicazione = Yii::$app->getFormatter()->asDate($model->data_pubblicazione);
        }
        ?>
        <div class="col-md-2 col-sm-3 col-xs-12 ">
            <div class="box search-box">
                <?php if ($model->box_type == "file") { ?>
                    <?php $contentFile = '<span class="icon">' . AmosIcons::show('file-text-o', ['class' => 'am-4'], 'dash') . '</span>'; ?>
                    <?= Html::a($contentFile, $model->url, ['data-pjax' => '0']) ?>
                    <?php
                } elseif ($model->box_type == "image") {
                    $urlImage = '/img/img_default.jpg';

                    if (!is_null($model->immagine)) {
                        if(is_a($model->immagine , '\open20\amos\attachments\models\File')){
                            $urlImage = $model->immagine->getUrl('square_medium', false, true);
                        }else{
                            $urlImage = $model->immagine;
                        }
                    }
                    $contentImage = Html::img($urlImage, [
                                'class' => 'img-responsive'
                    ]);
                    ?>
                    <?= Html::a($contentImage, $model->url, ['data-pjax' => '0']) ?>

                    <?php
                }
                ?>

            </div>
        </div>

        <div class="col-md-9 col-sm-8 col-xs-12">
            <?php if($dataPubblicazione){ ?>
                <p class="publication-date"><?= BaseAmosModule::t('amoscore', 'Pubblicato il') ?> <?= $dataPubblicazione ?></p>
            <?php } ?>
            <div class="post-content col-xs-12 nop">
                <div class="post-title col-xs-12">
                    <a href="<?= $model->url ?>" data-pjax="0">
                        <h2><?= $model->titolo ?></h2>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="row nom post-wrap">
                    <div class="post-text col-xs-12">
                        <?php
                        $contentText = substr(strip_tags($model->abstract),0,255);
                        if($contentText){
                            $contentText .= '...';
                        }
                        ?>
                        <p><?=  $contentText  ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1 col-sm-1 col-xs-12">
            <a class="pull-right" href="<?= $model->url ?>" data-pjax="0"><?= AmosIcons::show('chevron-right', [
                    'class' => 'am-4'
                ]) ?>
            </a>
        </div>
    </div>
</div>
