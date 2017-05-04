<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/services/Tgm.php');
require_once(__DIR__ . '/services/Images.php');
require_once(__DIR__ . '/services/Menus.php');
require_once(__DIR__ . '/services/ThemeConfiguration.php');

/*
 * remove wp-embed javascript, since it's included in webpack build
 */
add_action('wp_print_scripts', function() {
    wp_deregister_script('wp-embed');
}, 100);

add_filter('neochic_woodlets_twig', function ($twig) {
    return $twig;
});

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'sidebar', 'woodlets-example' ),
		'id'            => 'sidebar-1'
	) );
} );


add_theme_support( 'html5' );
