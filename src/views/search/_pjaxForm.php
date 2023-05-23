<form name="search" action="/search/search/do-search" data-pjax>
    <?php echo \yii\helpers\Html::input("hidden", "queryString", $queryString); ?>
    <?php echo \yii\helpers\Html::input("hidden", "tagIds", $tagIds ); ?>
    <?php echo \yii\helpers\Html::input("hidden", "moduleName", $moduleName); ?>
    <?php echo \yii\helpers\Html::input("hidden", "tagValues", $moduleName, (!empty($tagValues) ? implode(',', $tagValues ): '')) ?>
</form>