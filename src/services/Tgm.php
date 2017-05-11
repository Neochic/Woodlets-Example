<?php
require_once(__DIR__ . '/../vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', function() {
	$plugins = array(
		array(
			'name'               => 'Woodlets',
			'slug'               => 'woodlets',
			'source'             => 'https://github.com/Neochic/Woodlets/releases/download/v0.6.0/woodlets-v0.6.0-bundled.zip',
			'required'           => true,
			'force_activation'   => true,
			'force_deactivation' => true
		)
	);

	$config = array(
        'dismissable'  => false,
        'is_automatic' => true
	);

	tgmpa( $plugins, $config );
});
