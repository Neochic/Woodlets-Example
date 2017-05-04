<?php

add_action('init', function () {
    register_nav_menu('header-menu', __('headerMenu', 'woodlets-example'));
});
