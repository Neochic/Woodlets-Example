<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/services/Tgm.php');

/*
 * remove wp-embed javascript, since it's included in webpack build
 */
add_action('wp_print_scripts', function() {
    wp_deregister_script('wp-embed');
}, 100);

add_filter('neochic_woodlets_twig', function ($twig) {
    return $twig;
});
