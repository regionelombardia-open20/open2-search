<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\documenti
 * @category   CategoryName
 */

use lispa\amos\search\AmosSearch;
use yii\helpers\Html;

if($tagIds){
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' =>  \lispa\amos\tag\models\Tag::find()->andWhere(['id' => $tagIds])
    ]);
    $columns = [
        [
            'value' => function ($model)  {
                    $tagName = Html::a($model->nome , '/search/search/index?tagIds='.$model->id);
                return "<div class=\"tags-list-single\" data-tag='".$model->id."'>
                                        <div>" . \lispa\amos\core\icons\AmosIcons::show('label') . "</div>
                                        <div>
                                            <p class=\"tag-label\">" . $tagName . "</p>
                                            <small>" . $model->tagRoot->nome . ($model->path ? " / " . $model->path : "") . "</small>
                                        </div>
                                    </div>";
            },
            'format' => 'raw'
        ],
    ];
}

$moduleLayout = Yii::$app->getModule('layout');
if(!is_null($moduleLayout)) {
    \lispa\amos\layout\assets\SpinnerWaitAsset::register($this);
}
?>

<div class="loading" id="loader" hidden></div>

<div class="toolbar-search">
    <?php if(!$tagIds){ ?>
    <p id="query-info" class="result_key" data-i18n="<?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono la parola: <strong>{queryString}</strong>') ?>">
        <?php if($queryString){
          echo AmosSearch::t('amossearch', 'Risultati della ricerca che contengono la parola: <strong>{queryString}</strong>',['queryString' => $queryString]);
        }
        ?>
    </p>
    <?php } else { ?>
        <p id="query-info" class="result_key" data-i18n="<?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono i tag:') ?>">
                 <?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono i tag:') ?>
        </p>
    <?php echo \lispa\amos\core\views\AmosGridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'showPager' => false,
            'columns' => $columns
        ]);
    } ?>
     <div class="row container-searchBar <?= $tagIds ? 'hidden' : ''?>">
         <form id="formSearch">
             <?php echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView')); ?>
             <div class="col-sm-3"><p class="label-search"><?= AmosSearch::tHtml('amossearch', 'CERCA') ?></p></div>

            <div class="col-sm-6">
                <div class="form-group">
                    <input id="queryString" class="form-control" name="queryString" type="text" value="<?= $queryString ?>">
                    <input id="tagIds" class="form-control hidden" name="tagIds" type="hidden" value="<?= $tagIds ?>">
                    <div class="help-block"><?= AmosSearch::tHtml('amossearch', 'Inserisci una o più parole chiave per affinare ulteriormente la ricerca') ?></div>
                </div>
            </div>

            <div class="col-sm-3">
                <div>
                    <?= Html::submitButton(AmosSearch::tHtml('amossearch', 'Inizia'), ['class' => 'btn btn-navigation-primary']) ?>
                </div>
            </div>
        </form>
    </div>
</div>