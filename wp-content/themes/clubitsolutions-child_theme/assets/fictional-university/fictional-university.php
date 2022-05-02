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
	
	function isFictionalUniversity(): bool {
		$relations = get_field('relations');
		$isFictionalUniversity = false;
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

		return $isFictionalUniversity;
	}

	function showUniversityHeader() {
		?>
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

		</div>
	<?php }
	
function university_features() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'university_features');