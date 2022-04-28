<?php
	
	function pageBanner($args = NULL) {
		
		if (!$args['title']) {
			$args['title'] = get_the_title();
		}
		
		if (!$args['subtitle']) {
			$args['subtitle'] = get_field('page_banner_subtitle');
		}
		
		if (!$args['photo']) {
			if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
				$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
			} else {
				$args['photo'] = get_stylesheet_directory_uri() . '/assets/fictional-university/images/ocean.jpg';
			}
		}
		
		?>
		<div class="page-banner">
			<div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
			<div class="page-banner__content container container--narrow">
				<h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
				<div class="page-banner__intro">
					<p><?php echo $args['subtitle']; ?></p>
				</div>
			</div>
		</div>
	<?php }
/**
 * Clubitsolutions-child_theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clubitsolutions-child_theme
 */

add_action( 'wp_enqueue_scripts', 'clubitsolutions_theme_parent_theme_enqueue_styles' );
	
	function university_features() {
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_image_size('professorLandscape', 400, 260, true);
		add_image_size('professorPortrait', 480, 650, true);
		add_image_size('pageBanner', 1500, 350, true);
	}
	
	add_action('after_setup_theme', 'university_features');

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
	
	// Loading assets for Fictional-University-Project
	$relations = get_field('relations');
	$isFictionalUniversity = false;
	$postType = get_post_type();
	$postTypesOfFictionalUniversity = array("program", "professor", "program", "event", "campus");
	if ($relations) {
		foreach ( $relations as $relation ) {
			$title = get_the_title( $relation );
			if ( str_contains( $title, 'Fictional University' )
			     || str_contains( $title, 'Become a WordPress Developer: Unlocking Power With Code'
			     ) ) {
				$isFictionalUniversity = true;
			}
		}
	}
	if (in_array($postType, $postTypesOfFictionalUniversity))
		$isFictionalUniversity = true;
	
	if ( $isFictionalUniversity ) {
		wp_enqueue_style( 'fictional-university-style', get_stylesheet_directory_uri() . '/assets/fictional-university/styles.css' );
		wp_enqueue_script('fictional-university-scripts', get_stylesheet_directory_uri() . '/assets/fictional-university/scripts.js', array('jquery'), '1.0', true);
		wp_enqueue_style('roboto-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto.css');
		wp_enqueue_style('roboto-condensed-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto-condensed.css');
		wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/fictional-university/fontawesome47/css/font-awesome.min.css');
		wp_enqueue_script('fictional-university-vendors', get_stylesheet_directory_uri() . '/assets/fictional-university/vendors-scripts.js');
	}
	
	
	if ( $postType == 'project') {
		$currentlyDeveloping = array(
			'natours' => false,
			'nexter' => false,
			'trillo' => false
		);
		
		if ( get_post_field( 'post_name', get_post()) == 'nexter') {
			wp_enqueue_style('josefin-sans-font', get_stylesheet_directory_uri() . '/assets/advanced-css/nexter/josefin-sans.css');
			wp_enqueue_style('nunito-font', get_stylesheet_directory_uri() . '/assets/advanced-css/nexter/nunito.css');
			
			if (strstr($_SERVER['SERVER_NAME'], '.local') && $currentlyDeveloping['nexter']) {
				wp_enqueue_script( 'clubitsolutions-js', 'http://localhost:8080/nexter.js', array(),
					wp_get_theme()->get
					( 'Version' ) );
			} else {
				wp_enqueue_style( 'nexter-style', get_stylesheet_directory_uri() . '/assets/advanced-css/dist/nexter.css' );
			}
		}
		
		if ( get_post_field( 'post_name', get_post()) == 'natours') {
			wp_enqueue_style('lato-font', get_stylesheet_directory_uri() . '/assets/advanced-css/natours/css/lato.css');
			wp_enqueue_style('linea-icon-font', get_stylesheet_directory_uri() . '/assets/advanced-css/natours/icon-font.css');
			
			if (strstr($_SERVER['SERVER_NAME'], '.local') && $currentlyDeveloping['natours']) {
				wp_enqueue_script( 'natours-js', 'http://localhost:8080/natours.js', array(),
					wp_get_theme()->get
					( 'Version' ) );
			} else {
				wp_enqueue_style( 'natours-style', get_stylesheet_directory_uri() . '/assets/advanced-css/dist/natours.css' );
			}
		}
		
		if ( get_post_field( 'post_name', get_post()) == 'trillo') {
			wp_enqueue_style('opensans-font', get_stylesheet_directory_uri() . '/assets/advanced-css/trillo/open-sans.css');
			
			if (strstr($_SERVER['SERVER_NAME'], '.local') && $currentlyDeveloping['trillo']) {
				wp_enqueue_script( 'trillo-js', 'http://localhost:8080/trillo.js', array(),
					wp_get_theme()->get
					( 'Version' ) );
			} else {
				wp_enqueue_style( 'trillo-style', get_stylesheet_directory_uri() . '/assets/advanced-css/dist/trillo.css' );
			}
		}
	}
}
	
