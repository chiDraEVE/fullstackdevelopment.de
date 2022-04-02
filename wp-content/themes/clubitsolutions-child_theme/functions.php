<?php
/**
 * Clubitsolutions-child_theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clubitsolutions-child_theme
 */

add_action( 'wp_enqueue_scripts', 'clubitsolutions_theme_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
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
	
	if ( is_page( 'fictional-university' ) ) {
		wp_enqueue_style( 'fictional-university-style', get_stylesheet_directory_uri() . '/assets/fictional-university/styles.css' );
		wp_enqueue_script('fictional-university-scripts', get_stylesheet_directory_uri() . '/assets/fictional-university/scripts.js', array('jquery'), '1.0', true);
		wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
		wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_script('fictional-university-vendors', get_stylesheet_directory_uri() . '/assets/fictional-university/vendors-scripts.js');
	}
	
	if ( get_post_type() == 'project') {
		$currentlyDeveloping = array(
			'natours' => true,
			'nexter' => false,
		);
		
		if ( get_post_field( 'post_name', get_post()) == 'nexter') {
			
			wp_enqueue_style('josefin-sans', '//fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;1,400');
			wp_enqueue_style('nunito', '//fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;1,400');
			
			if (strstr($_SERVER['SERVER_NAME'], '.local') && $currentlyDeveloping['nexter']) {
				wp_enqueue_script( 'clubitsolutions-js', 'http://localhost:8080/nexter.js', array(),
					wp_get_theme()->get
					( 'Version' ) );
			} else {
				wp_enqueue_style( 'nexter-style', get_stylesheet_directory_uri() . '/assets/advanced-css/dist/nexter.css' );
			}
		}
		
		if ( get_post_field( 'post_name', get_post()) == 'natours') {
			
			wp_enqueue_style('lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900');
			
			if (strstr($_SERVER['SERVER_NAME'], '.local') && $currentlyDeveloping['natours']) {
				wp_enqueue_script( 'natours-js', 'http://localhost:8080/natours.js', array(),
					wp_get_theme()->get
					( 'Version' ) );
			} else {
				wp_enqueue_style( 'natours-style', get_stylesheet_directory_uri() . '/assets/advanced-css/dist/natours.css' );
			}
		}
	}
}
