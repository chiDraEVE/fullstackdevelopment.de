<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php
	  global $isFictionalUniversity;
	  $classList = array();
		if ($isFictionalUniversity)
			$classList[] = 'fictional-university';
	  body_class($classList);
		?>>
  <div id="page" class="site">
	  <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'clubitsolutions-theme' ); ?></a>

	  <header id="masthead" class="site-header">
		  <?php echo  get_the_post_thumbnail()?>
		  <div class="site-branding">
			  <?php
				  the_custom_logo();
				  if ( is_front_page() && is_home() ) :
					  ?>
					  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				  <?php
				  else :
					  ?>
					  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				  <?php
				  endif;
				  $clubitsolutions_theme_description = get_bloginfo( 'description', 'display' );
				  if ( $clubitsolutions_theme_description || is_customize_preview() ) :
					  ?>
					  <p class="site-description"><?php echo $clubitsolutions_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				  <?php endif; ?>
		  </div><!-- .site-branding -->

		  <nav id="site-navigation" class="main-navigation">
			  <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'clubitsolutions-theme' ); ?></button>
			  <?php
				  wp_nav_menu(
					  array(
						  'theme_location' => 'menu-1',
						  'menu_id'        => 'primary-menu',
					  )
				  );
			  ?>
		  </nav><!-- #site-navigation -->
	  </header><!-- #masthead -->
	  <?php
		  if ($isFictionalUniversity)
			  showUniversityHeader();
	  ?>
			 