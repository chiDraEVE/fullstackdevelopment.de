<?php
	require_once 'assets/fictional-university/fictional-university.php';
	
/**
 * Clubitsolutions-child_theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clubitsolutions-child_theme
 */

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'clubitsolutions_theme_parent_theme_enqueue_styles' );

function clubitsolutions_theme_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'clubitsolutions-theme-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'clubitsolutions-child_theme-meta-information',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'clubitsolutions-theme-style' )
	);
	wp_enqueue_style( 'clubitsolutions-child_theme-style',
		get_stylesheet_directory_uri() . '/dist/index.css',
		array( 'clubitsolutions-theme-style' )
	);
	
	// Loading assets for Fictional-University-Project
	
	if ( isFictionalUniversity() ) {
		wp_enqueue_style( 'fictional-university-style', get_stylesheet_directory_uri() . '/assets/fictional-university/styles.css' );
		wp_enqueue_script('fictional-university-scripts', get_stylesheet_directory_uri() . '/assets/fictional-university/scripts.js', array('jquery'), '1.0', true);
		wp_enqueue_style('roboto-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto.css');
		wp_enqueue_style('roboto-condensed-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto-condensed.css');
		wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/fictional-university/fontawesome47/css/font-awesome.min.css');
		wp_enqueue_script('fictional-university-vendors', get_stylesheet_directory_uri() . '/assets/fictional-university/vendors-scripts.js');
	}
	
	
	if ( get_post_type() == 'project') {
		if ( get_post_field( 'post_name', get_post()) == 'nexter') {
			wp_enqueue_style('josefin-sans-font', get_stylesheet_directory_uri() . '/assets/advanced-css/nexter/josefin-sans.css');
			wp_enqueue_style('nunito-font', get_stylesheet_directory_uri() . '/assets/advanced-css/nexter/nunito.css');
			loadAssetsDependingOnDevMode('nexter', false);
		}
		if ( get_post_field( 'post_name', get_post()) == 'natours') {
			wp_enqueue_style('lato-font', get_stylesheet_directory_uri() . '/assets/advanced-css/natours/css/lato.css');
			wp_enqueue_style('linea-icon-font', get_stylesheet_directory_uri() . '/assets/advanced-css/natours/icon-font.css');
			loadAssetsDependingOnDevMode('natours', false);
		}
		if ( get_post_field( 'post_name', get_post()) == 'trillo') {
			wp_enqueue_style( 'opensans-font', get_stylesheet_directory_uri() . '/assets/advanced-css/trillo/open-sans.css' );
			loadAssetsDependingOnDevMode( 'trillo', false );
		}
	}
}
	
function loadAssetsDependingOnDevMode($projectName, $devMode) {
	if (strstr($_SERVER['SERVER_NAME'], '.local') && $devMode) {
		wp_enqueue_script(
			$projectName.'-js',
			'http://localhost:8080/'.$projectName.'.js',
			array(),
			wp_get_theme()->get
			( 'Version' )
		);
	} else {
		wp_enqueue_style(
			$projectName.'-style',
			get_stylesheet_directory_uri() . '/assets/advanced-css/dist/' . $projectName.'.css'
		);
	}
}