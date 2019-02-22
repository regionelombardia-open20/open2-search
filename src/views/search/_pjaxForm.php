<form name="search" action="/search/search/do-search" data-pjax>
    <input type="hidden" name="queryString" value="<?= $queryString ?>"/>
    <input type="hidden" name="tagIds" value="<?= $tagIds ?>"/>
    <input type="hidden" name="moduleName" value="<?= $moduleName ?>"/>
</form>