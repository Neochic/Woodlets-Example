<?php

/*
* activate post thumbnail support
*/

add_theme_support( 'post-thumbnails' );

/*
* add used image sizes
*/
add_image_size( 'logo', 240, 65, true );
add_image_size( 'logo-2x', 480, 130, true );
add_image_size( 'logo-3x', 720, 195, true );
add_image_size( 'full-width-wvga', 854, 480, true );
add_image_size( 'full-width-hd', 1280, 720, true );
add_image_size( 'full-width', 1920, 1080, true );
add_image_size( 'full-width-wqhd', 2560, 1440, true );
add_image_size( 'full-width-4k', 3840, 2160, true );
add_image_size( 'post-thumbnail-0.5x', 670, 180, true );
add_image_size( 'post-thumbnail-1x', 1340, 360, true );
add_image_size( 'post-thumbnail-2x', 2680, 720, true );
add_image_size( 'post-thumbnail-3x', 4020, 1080, true );
add_image_size( 'full-content-0.5x', 670);
add_image_size( 'full-content', 1340);
add_image_size( 'full-content-2x', 2680);
add_image_size( 'full-content-3x', 4020);
add_image_size( 'half-content-0.5x', 325);
add_image_size( 'half-content', 650);
add_image_size( 'half-content-2x', 1300);
add_image_size( 'half-content-3x', 1950);
add_image_size( 'two-thirds-content-0.5x', 434);
add_image_size( 'two-thirds-content', 866);
add_image_size( 'two-thirds-content-2x', 1732);
add_image_size( 'two-thirds-content-3x', 2598);
add_image_size( 'third-content', 434);
add_image_size( 'third-content-2x', 868);
add_image_size( 'third-content-3x', 1302);

/*
* fix sizes attribute for responsive images
*/
add_filter( 'wp_get_attachment_image_attributes', function ( $atts, $attachment, $size ) {
	switch ( $size ) {
		case "third-content":
			$atts['sizes'] = "(max-width: 1020px) 50vw, (max-width: 760px) 100vw, 434px";
			break;
		case "two-thirds-content":
			$atts['sizes'] = "(max-width: 1020px) 50vw, (max-width: 760px) 100vw, 866px";
			break;
		case "half-content":
			$atts['sizes'] = "(max-width: 1020px) 50vw, (max-width: 760px) 100vw, 650px";
			break;
		case "full-content":
			$atts['sizes'] = "(max-width: 1020px) 100vw, 1340px";
			break;
		case "full-width":
			$atts['sizes'] = "100vw";
			break;
	}

	return $atts;
}, 10, 3 );

/*
 * increase max srcset size to 4k
 */
add_filter( 'max_srcset_image_width', function ( ) {
	return 4020;
}, 10, 2 );

/*
 * helper to generate urls for responsive backgrounds
 */

add_filter('neochic_woodlets_twig', function ($twig) {
	$twig->addFunction( new \Twig_SimpleFunction( 'getBackgroundUrls', function ($image, $name, $fallbackPath = null) {
		global $_wp_additional_image_sizes;
		$backgroundImage = null;
		$backgroundVariants = array();
		$fallBackImage = null;
		$fallBackVariants = array();
		$length = strlen($name);

		if($fallbackPath) {
			$fallBackImage = $fallbackPath . '.jpg';
		}

		foreach($_wp_additional_image_sizes as $sizeName => $size) {
			$namePart = substr($sizeName, 0, $length);
			if($namePart === $name) {
				$variantPart = substr($sizeName, $length);

				if($image) {
					if($variantPart === '') {
						$backgroundImage = wp_get_attachment_image_url($image, $sizeName);
					}

					array_push($backgroundVariants, array(
						"width" => $size['width'],
						"height" => $size['height'],
						"src" => wp_get_attachment_image_url($image, $sizeName)
					));
				}

				if($fallbackPath) {
					array_push( $fallBackVariants, array(
						"width"  => $size['width'],
						"height" => $size['height'],
						"src"    => $fallbackPath . $variantPart . '.jpg'
					) );
				}
			}
		}

		return array(
			"image" => $backgroundImage,
			"variants" => $backgroundVariants,
			"fallback" => $fallBackImage,
			"fallbackVariants" => $fallBackVariants
		);
	}));

	return $twig;
});
