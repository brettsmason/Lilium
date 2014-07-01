<?php
/**
 * @package    Lilium
 * @version    1.0.0
 * @author     Brett Mason <brettsmason@gmail.com>
 * @copyright  Copyright (c) 2014, Brett Mason
 * @link       http://themehybrid.com/themes/lilium
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Add the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'lilium_theme_setup' );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove 
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 */
function lilium_theme_setup() {

	/*
	 * Add a custom background to overwrite the defaults.  Remove this section if you want to use 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => '2d2d2d',
			'default-image' => get_stylesheet_directory_uri() . '/images/backgrounds/dark.png',
		)
	);

	/*
	 * Add a custom header to overwrite the defaults.  Remove this section if you want to use the 
	 * the parent theme defaults instead.
	 *
	 * @link http://codex.wordpress.org/Custom_Headers
	 */
	add_theme_support( 
		'custom-header', 
		array(
			'default-text-color' => '252525',
			'default-image'      => get_stylesheet_directory_uri() . '/images/headers/bridge.jpg',
			'random-default'     => false,
		)
	);

	/*
	 * Registers default headers for the theme.  The below are examples from the parent theme and should 
	 * not be used (use your own headers).  If you don't want to add custom headers, remove this section.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_default_headers
	 */
	register_default_headers(
		array(
			'bridge' => array(
				'url'           => '%2$s/images/headers/bridge.jpg',
				'thumbnail_url' => '%2$s/images/headers/bridge-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Bridge', 'lilium' )
			),
			'flowers' => array(
				'url'           => '%2$s/images/headers/flowers.jpg',
				'thumbnail_url' => '%2$s/images/headers/flowers-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Flowers', 'lilium' )
			),
			'water' => array(
				'url'           => '%2$s/images/headers/water.jpg',
				'thumbnail_url' => '%2$s/images/headers/water-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Water', 'lilium' )
			),
		)
	);

	/* Filter to add custom default backgrounds (supported by the framework). */
	add_filter( 'hybrid_default_backgrounds', 'lilium_default_backgrounds' );

	/* Add a custom default color for the "primary" color option. */
	add_filter( 'theme_mod_color_primary', 'lilium_color_primary' );
	
	/* Custom editor stylesheet. */
	add_editor_style( '//fonts.googleapis.com/css?family=Trocchi|Alegreya+Sans' );
	
	/* Load stylesheets. */
	add_action( 'wp_enqueue_scripts', 'lilium_styles', 0 );
}

/**
 * This works just like the WordPress `register_default_headers()` function.  You're just setting up an 
 * array of backgrounds.  The following backgrounds are merely examples from the parent theme.  Please 
 * don't use them.  Use your own backgrounds.  Or, remove this section (and the `add_filter()` call earlier) 
 * if you don't want to register custom backgrounds.
 */
function lilium_default_backgrounds( $backgrounds ) {

	$new_backgrounds = array(
		'dark' => array(
			'url'           => '%2$s/images/backgrounds/dark.png',
			'thumbnail_url' => '%2$s/images/backgrounds/dark-thumb.png',
		),
		'light' => array(
			'url'           => '%2$s/images/backgrounds/light.png',
			'thumbnail_url' => '%2$s/images/backgrounds/light-thumb.png',
		),
	);

	return array_merge( $new_backgrounds, $backgrounds );
}

/**
 * Add a default custom color for the theme's "primary" color option.  Users can overwrite this from the 
 * theme customizer, so we want to make sure to check that there's no value before returning our custom 
 * color.  If you want to use the parent theme's default, remove this section of the code and the 
 * `add_filter()` call from earlier.  Otherwise, just plug in the 6-digit hex code for the color you'd like 
 * to use (the below is the parent theme default).
 */
function lilium_color_primary( $hex ) {
	return $hex ? $hex : '9e0061';
}

/**
 * Loads custom stylesheets for the theme.
 */
function lilium_styles() {
	wp_deregister_style( 'stargazer-fonts' );
	wp_enqueue_style( 'lilium-fonts', '//fonts.googleapis.com/css?family=Nunito|Trocchi|Alegreya+Sans|Oleo+Script+Swash+Caps' );
}