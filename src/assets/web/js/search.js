/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var pjaxForms = [];

var callPjax = function () {
    computeTotal();
    if (pjaxForms.length > 0) {
        var form = pjaxForms.shift();
        var queryString = $('#formSearch').find('#queryString').val();
        var tagIds = $('#formSearch').find('#tagIds').val();
        var tagValuesArray = [];
        $('#formSearch').find('input[name^="GeneralSearch[tagValues]"]').each(function(){
            if($(this).val().length > 0){
                tagValuesArray.push($(this).val());
            }
        });
        var tagValues = tagValuesArray.join(',');
        tagValuesArray = [];

        form.find('input[name=queryString]').val(queryString);
        form.find('input[name=tagIds]').val(tagIds);
        form.find('input[name=tagValues]').val(tagValues);
        form.on('submit', function(event) {
            event.preventDefault();
            $.pjax.submit(event, "#" + form.parent().attr('id'));
        });
        form.submit();
    }else{
        $('.loading').removeAttr('style');
    }
};

var retrieveForms = function(){
    pjaxForms = [];
    $('.pjax-container').each(function () {
        pjaxForms.push($(this).find("form"));
    });
};

var computeTotal = function(){
    var total = 0;
    $('.search-title').each(function () {
        total += parseInt($(this).attr('data-result-count'));
    });
    var message = $('#results-info').attr('data-i18n');
    $('#results-info').html(message.replace('#NUMEL#',total));
};

$(window).on('load', function () {
    var queryString = $('#formSearch').find('#queryString').val();
    var tagIds = $('#formSearch').find('#tagIds').val();

    retrieveForms();

    $('#formSearch').on('submit', function (event) {
        event.preventDefault();

        var queryString = $('#formSearch').find('#queryString').val();
        var filteredQueryString = queryString.replace(/(<([^>]+)>)/ig,"");
        var tagValues = $('#formSearch').find('input[name^="GeneralSearch[tagValues]"]').serialize();

        var message = $('#query-info').attr('data-i18n');
        $('#query-info').html(message.replace('{queryString}',filteredQueryString));

        if (queryString.length >0 || tagValues.length > 0) {
            history.pushState({}, '', '/search/search/index?queryString='+encodeURI(queryString)+'&'+tagValues);
            $('.loading').show();
            retrieveForms();
            callPjax();
        }
        var tagIds = $('#formSearch').find('#tagIds').val();
        if (tagIds.length) {
            history.pushState({}, '', '/search/search/index?tagIds='+encodeURI(tagIds));
            $('.loading').show();
            retrieveForms();
            callPjax();
        }
    });

    $('.search-index .pjax-container').on('pjax:end', callPjax);
    
    if (queryString || tagIds) {
        $('.loading').show();
        callPjax();
    }
});
