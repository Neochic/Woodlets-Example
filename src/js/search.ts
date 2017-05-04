import * as $ from 'jquery';

$(document).ready(function() {
    let $fixed = $('.header .fixed');
    $fixed.on('click', '.icon-search', function() {
        $fixed.toggleClass('show-search');
        if($fixed.hasClass('show-search')) {
            $fixed.find('.search-field').focus();
        }
    });

    $(window).on('scroll', function() {
        $fixed.removeClass('show-search');
    });
});
