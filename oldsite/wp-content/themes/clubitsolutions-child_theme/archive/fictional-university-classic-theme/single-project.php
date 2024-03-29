<?php
	/**
	 * The template for displaying all single projects
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package clubitsolutions-theme
	 */
	
	get_header();
	$projectName = get_post_field('post_name');
?>
	
	<main id="primary" class="site-main <?php echo $projectName ?>">
		
		<?php
			while ( have_posts() ) :
				the_post();
				
				/**
				 * check for specific projects like the example trillo. I didn't put the structure in the editor but
                 * will
				 * load it from a file and ignore content from editor
				 */
				switch ( $projectName ) {
					case 'trillo': require_once( 'assets/advanced-css/trillo/trillo.php' ); break;
					default: get_template_part( 'template-parts/content', get_post_type() );
				}
				
				
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'clubitsolutions-theme' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'clubitsolutions-theme' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			
			endwhile; // End of the loop.
		?>
	
	</main><!-- #main -->

<?php
	get_sidebar();
	get_footer();
