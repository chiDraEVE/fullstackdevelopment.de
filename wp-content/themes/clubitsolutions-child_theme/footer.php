<?php
	global $isFictionalUniversity;
	if ($isFictionalUniversity)
		showUniversityFooter();
?>
<hr>
<footer id="colophon" class="site-footer">
	
	<div class="site-info">
		<a href="<?php echo esc_url( __( 'https://clubitsolutions.de/', 'clubitsolutions-theme' ) ); ?>">
			clubITsolutions
		</a>
		<span class="sep"> | </span>
		<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'clubitsolutions-theme' ), 'clubitsolutions-theme', '<a href="https://github.com/chiDraEVE/">chiDraEVE</a>' );
			?>
	</div><!-- .site-info -->
	<div class="menu-footer">
	<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'menu_id'        => 'menu-footer',
				)
			);
			?>
	</div>
	<div class="menu-social">
	<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-social',
					'menu_id'        => 'socialmedia-menu',
				)
			);
		?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>