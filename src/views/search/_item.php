<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\search
 * @category   CategoryName
 */
use lispa\amos\core\icons\AmosIcons;
use lispa\amos\core\module\BaseAmosModule;
use lispa\amos\core\helpers\Html;
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
                        if(is_a($model->immagine , '\lispa\amos\attachments\models\File')){
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
                        $contentText = substr(strip_tags($model->abstract),1,255);
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
