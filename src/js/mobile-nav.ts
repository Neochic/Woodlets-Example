import * as $ from 'jquery';

$(document).ready(function() {
    let $fixed = $('.header .fixed');
    let $body = $('body');
    let $trigger = $($fixed.data('mobileNavTrigger'));
    let $mobileNav = $($fixed.data('mobileNav'));

    $fixed.append($trigger);
    $body.append($mobileNav);

    $trigger.on('click', function() {
        $body.addClass('show-mobile-nav');
    });

    $mobileNav.on('click', '.icon-close', function() {
        $body.removeClass('show-mobile-nav');
    });
});
