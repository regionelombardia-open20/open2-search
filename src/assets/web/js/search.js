/* 
 * To change this proscription header, choose Proscription Headers in Project Properties.
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
        form.find('input[name=queryString]').val(queryString);
        form.find('input[name=tagIds]').val(tagIds);
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

        var message = $('#query-info').attr('data-i18n');
        $('#query-info').html(message.replace('{queryString}',queryString));

        if (queryString.length) {
            history.pushState({}, '', '/search/search/index?queryString='+encodeURI(queryString));
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
