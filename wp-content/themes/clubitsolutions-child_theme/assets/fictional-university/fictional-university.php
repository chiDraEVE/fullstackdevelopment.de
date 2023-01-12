<?php
	
	function isFictionalUniversity(): void {
		global $isFictionalUniversity;
		$isFictionalUniversity = false;
		
		$relations = get_field('relations');
		$postType = get_post_type();
		$postTypesOfFictionalUniversity = array("program", "professor", "program", "event", "campus");
		if ($relations && !is_home()) {
			foreach ( $relations as $relation ) {
				$title = get_the_title( $relation );
				if ( str_contains( $title, 'Fictional University' )
				     || str_contains( $title, 'Become a WordPress Developer: Unlocking Power With Code'
				     ) ) {
					$isFictionalUniversity = true;
				}
			}
		}
		if ((in_array($postType, $postTypesOfFictionalUniversity) || has_category('Fictional University'))
		&& !is_home())
			$isFictionalUniversity = true;
        
        if (str_contains(get_the_title(), 'Fictional University'))
            $isFictionalUniversity = true;
        
        if ($isFictionalUniversity) {
            global $projectName;
            $projectName = 'fictional-university';
            require get_theme_file_path('/inc/like-route.php');
	        require get_theme_file_path('/inc/search-route.php');
	
        }
	}
 
 
	function university_custom_rest() {
	  register_rest_field('post', 'authorName', array(
	    'get_callback' => function() {return get_the_author();}
	  ));
	
	  register_rest_field('note', 'userNoteCount', array(
	    'get_callback' => function() {return count_user_posts(get_current_user_id(), 'note');}
	  ));
	}
	
	add_action('rest_api_init', 'university_custom_rest');
	function pageBanner($args = NULL) {
		
		if (!isset($args['title'])) {
			$args['title'] = get_the_title();
		}
		
		if (!isset($args['subtitle'])) {
			$args['subtitle'] = get_field('page_banner_subtitle');
		}
		
		if (!isset($args['photo'])) {
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
				</div>

	<?php }
	
	function showUniversityHeader() {
		?>
		<div class="fictional-university__header">
		<header class="site-header">
		<div class="container">
			<h1 class="school-logo-text float-left"><a href="<?php echo site_url('/fictional-university') ?>"><strong>Fictional</strong> University</a></h1>
			<a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
			<i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
			<div class="site-header__menu group">
				<nav class="main-navigation">
					<ul>
						<li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"'
						?>><a href="<?php echo site_url('/fictional-university/about-us') ?>">About Us</a></li>
						<li <?php if (get_post_type() == 'program') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('program') ?>">Programs</a></li>
						<li <?php if (get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"';  ?>><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
						<li <?php if (get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('campus'); ?>">Campuses</a></li>
						<li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/category/udemy-kurs/fictional-university/'); ?>">Blog</a></li>
					</ul>
				</nav>
				<div class="site-header__util">
					<?php if(is_user_logged_in()) { ?>
						<a href="<?php echo esc_url(site_url('/fictional-university/my-notes')); ?>" class="btn btn--small btn--orange float-left push-right">My Notes</a>
						<a href="<?php echo wp_logout_url();  ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">
							<span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
							<span class="btn__text">Log Out</span>
						</a>
					<?php } else { ?>
						<a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
						<a href="<?php echo wp_registration_url(); ?>" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
					<?php } ?>
					
					<a href="<?php echo esc_url(site_url('/fictional-university/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		</header>
		<?php
	}
	
	function showUniversityFooter() {
		?>
		<footer class="fictional-university__site-footer">

		<div class="site-footer__inner container container--narrow">

			<div class="group">

				<div class="site-footer__col-one">
					<h1 class="school-logo-text school-logo-text--alt-color"><a href="<?php echo site_url() ?>"><strong>Fictional</strong> University</a></h1>
					<p><a class="site-footer__link" href="#">555.555.5555</a></p>
				</div>

				<div class="site-footer__col-two-three-group">
					<div class="site-footer__col-two">
						<h3 class="headline headline--small">Explore</h3>
						<nav class="nav-list">
							<ul>
								<li><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>
								<li><a href="#">Programs</a></li>
								<li><a href="#">Events</a></li>
								<li><a href="#">Campuses</a></li>
							</ul>
						</nav>
					</div>

					<div class="site-footer__col-three">
						<h3 class="headline headline--small">Learn</h3>
						<nav class="nav-list">
							<ul>
								<li><a href="#">Legal</a></li>
								<li><a href="<?php echo site_url('/privacy-policy') ?>">Privacy</a></li>
								<li><a href="#">Careers</a></li>
							</ul>
						</nav>
					</div>
				</div>

				<div class="site-footer__col-four">
					<h3 class="headline headline--small">Connect With Us</h3>
					<nav>
						<ul class="min-list social-icons-list group">
							<li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
							<li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</footer>
	<?php }
	
    function university_features() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('professorLandscape', 400, 260, true);
        add_image_size('professorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);
    }

    add_action('after_setup_theme', 'university_features');
    
    add_action('after_setup_theme', 'university_features');
	
	function university_adjust_queries($query) {
	  if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
	    $query->set('posts_per_page', -1);
	  }
	
	  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
	    $query->set('orderby', 'title');
	    $query->set('order', 'ASC');
	    $query->set('posts_per_page', -1);
	  }
	
	  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
	    $today = date('Ymd');
	    $query->set('meta_key', 'event_date');
	    $query->set('orderby', 'meta_value_num');
	    $query->set('order', 'ASC');
	    $query->set('meta_query', array(
	              array(
	                'key' => 'event_date',
	                'compare' => '>=',
	                'value' => $today,
	                'type' => 'numeric'
	              )
	            ));
	  }
	}
	
	add_action('pre_get_posts', 'university_adjust_queries');
	
	function universityMapKey($api) {
	  $api['key'] = 'yourKeyGoesHere';
	  return $api;
	}
	
//	add_filter('acf/fields/google_map/api', 'universityMapKey');
	
	// Redirect subscriber accounts out of admin and onto homepage
	add_action('admin_init', 'redirectSubsToFrontend');
	
	function redirectSubsToFrontend() {
	  $ourCurrentUser = wp_get_current_user();
	
	  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
	    wp_redirect(site_url('/'));
	    exit;
	  }
	}
	
	add_action('wp_loaded', 'noSubsAdminBar');
	
	function noSubsAdminBar() {
	  $ourCurrentUser = wp_get_current_user();
	
	  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
	    show_admin_bar(false);
	  }
	}
	
	// Customize Login Screen
	add_filter('login_headerurl', 'ourHeaderUrl');
	
	function ourHeaderUrl() {
	  return esc_url(site_url('/'));
	}
    
    // Force note posts to be private
	add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);
	
	function makeNotePrivate($data, $postarr) {
	  if ($data['post_type'] == 'note') {
	    if(count_user_posts(get_current_user_id(), 'note') > 40 AND !$postarr['ID']) {
	      die("You have reached your note limit.");
	    }
	
	    $data['post_content'] = sanitize_textarea_field($data['post_content']);
	    $data['post_title'] = sanitize_text_field($data['post_title']);
	  }
	
	  if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
	    $data['post_status'] = "private";
	  }
	  
	  return $data;
	}
 
    class PlaceholderBlock {
		function __construct($name) {
			$this->name = $name;
			add_action('init', [$this, 'onInit']);
		}
		
		function ourRenderCallback($attributes, $content ) {
			ob_start();
			require get_theme_file_path("/blocks/fictional-university/{$this->name}.php");
			return ob_get_clean();
		}
		
		function onInit() {
			wp_register_script($this->name, get_stylesheet_directory_uri() . "/blocks/fictional-university/{$this->name}.js",
			array
			('wp-blocks',	'wp-editor'));
			
			register_block_type("ourblocktheme/{$this->name}", array(
				'editor_script' => $this->name,
				'render_callback' => [$this, 'ourRenderCallback']
			));
		}
	}

	new PlaceholderBlock( "eventsandblogs" );
	new PlaceholderBlock( "header" );
	new PlaceholderBlock( "footer" );
	new PlaceholderBlock( "singlepost" );
	new PlaceholderBlock( "page" );
	new PlaceholderBlock( "blogindex" );
	new PlaceholderBlock( "programarchive" );
	new PlaceholderBlock( "singleprogram" );
	new PlaceholderBlock( "singleprofessor" );
	new PlaceholderBlock( "mynotes" );
	new PlaceholderBlock("archivecampus");
	new PlaceholderBlock("archiveevent");
	new PlaceholderBlock("archive");
	new PlaceholderBlock("pastevents");
	new PlaceholderBlock("search");
	new PlaceholderBlock("searchresults");
	new PlaceholderBlock("singlecampus");
	new PlaceholderBlock("singleevent");

	class JSXBlock {
	  function __construct($name, $renderCallback = null, $data = null) {
	    $this->name = $name;
			$this->data = $data;
	    $this->renderCallback = $renderCallback;
	    add_action('init', [$this, 'onInit']);
	  }
	
	  function ourRenderCallback($attributes, $content ) {
	    ob_start();
	    require get_theme_file_path("/blocks/fictional-university/{$this->name}.php");
	    return ob_get_clean();
	  }
	
	  function onInit() {
	    wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'));
			
			if ($this->data) {
				wp_localize_script( $this->name, $this->name, $this->data );
			}
	    
	    $ourArgs = array(
	      'editor_script' => $this->name
	    );
	
	    if ($this->renderCallback) {
	      $ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
	    }
	
	    register_block_type("ourblocktheme/{$this->name}", $ourArgs);
	  }
	}
	
	new JSXBlock('banner', true, ['fallbackimage' => get_theme_file_uri('/images/library-hero.jpg')]);
	new JSXBlock('genericheading');
	new JSXBlock('genericbutton');
	new JSXBlock( 'slideshow', true );
	new JSXBlock( 'slide', true, ['themeimagepath' => get_theme_file_uri('/images/')] );
	
	function myallowedblocks($allowed_block_types, $editor_context) {
//		if ($editor_context->post->post_type == "professor")
//			return array( 'core/paragraph', 'core/list' );
		
		// If you are on a page/post editor screen
		if (!empty($editor_context->post))
			return $allowed_block_types;
		
		// if you are on the FSE screen
		return array(
			'ourblocktheme/header',
			'ourblocktheme/footer',
		);
	}
	
//	add_filter('allowed_block_types_all', 'myallowedblocks',10, 2);