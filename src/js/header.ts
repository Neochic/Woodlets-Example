import * as $ from 'jquery';

/*
 * scrolling to first content element
 */
$(document).ready(function() {
    let $header = $('.header');
    $('.header .header-home').on('click', function() {
        let targetPosition = $header.offset().top+$header.height();
        $("html, body").stop().animate({scrollTop:targetPosition}, 500, 'swing');
    });
});


/*
 * tell other elements if admin bar is sticky
 */
$(document).ready(function() {
    let $body = $('body');
    let $fixed = $('.header .fixed');
    let $adminBar = $('#wpadminbar');
    let adminBarHeight = $adminBar.height();

    if($adminBar.length) {
        adminBarHeight = 0;
    }

    function update() {
        if($adminBar.css("position") === "absolute") {
            $body.toggleClass("admin-bar-absolute", $(window).scrollTop() < adminBarHeight);
        }

        $fixed.toggleClass("not-top", $(window).scrollTop() > 0);
    }

    update();

    $(window).on('resize', function() {
        adminBarHeight = $adminBar.height();
        update();
    });
    $(window).on('scroll', update);
});
