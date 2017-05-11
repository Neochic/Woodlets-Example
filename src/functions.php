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

/*
 * load textdomain
 */
add_action('after_setup_theme', function () {
	load_theme_textdomain('woodlets-example', get_template_directory() . '/languages');
});

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'sidebar', 'woodlets-example' ),
		'id'            => 'sidebar-1'
	) );
} );


add_theme_support( 'html5' );
