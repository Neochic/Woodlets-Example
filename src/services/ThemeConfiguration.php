<?php
add_action('neochic_woodlets_theme', function ($themeConfig) {
	$header = $themeConfig->section( __('header', 'woodlets-example'), 'header' );

	$header->add( 'text', 'woodlets-example-logo-text', array(
		'label' => __('logoText', 'woodlets-example')
	));

	$header->add( 'media', 'woodlets-example-logo', array(
		'label' => __('logo', 'woodlets-example'),
		'type' => 'image'
	));

	$footer = $themeConfig->section( __('footer', 'woodlets-example'), 'footer' );

	$footer->add( 'contentArea', 'woodlets-example-footer-elements', array(
		'label' => __('footerElements', 'woodlets-example'),
		'allowed' => array(
			'footer-menu',
			'footer-rte'
		)
	));
	$footer->add( 'text', 'woodlets-example-copyright-text', array(
		'label' => __('copyrightText', 'woodlets-example')
	));
});

add_filter('neochic_woodlets_twig', function ($twig) {
	$twig->addFunction( new \Twig_SimpleFunction( 'navMenus', function () {
		$menuitems = array();
		foreach(wp_get_nav_menus() as $item) {
			$menuitems[$item->term_id] = $item->name;
		}

		return $menuitems;
	}));

	return $twig;
});
