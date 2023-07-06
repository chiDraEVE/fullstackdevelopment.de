<?php
	require_once "inc/to-the-top.php";
	global $isFictionalUniversity;
	if ($isFictionalUniversity)
		showUniversityFooter();
?>
<hr>
<footer id="colophon" class="site-footer">
		<div class="menu-social__item site-footer__item">
			<svg class="menu-social__icon">
				<use xlink:href="<?php echo get_parent_theme_file_uri(); ?>/img/sprite.svg#icon-github"></use>
			</svg>
			<ul>
				<li><a target="_blank" rel="noopener noreferrer" href="https://github.com/chiDraEVE">Mein GitHub-Profil</a></li>
				<li><a target="_blank" rel="noopener noreferrer" href="https://github.com/chiDraEVE/fullstackdevelopment
				.de">Repository dieser Portfolio-Seite</a></li>
			</ul>
		</div>
		<div class="menu-social__item site-footer__item">
			<svg class="menu-social__icon">
				<use xlink:href="<?php echo get_parent_theme_file_uri(); ?>/img/sprite.svg#icon-facebook"></use>
			</svg>
			<ul>
				<li><a target="_blank" rel="noopener noreferrer" href="https://www.facebook
				.com/Clubitsolutionsde-1035038789996718/">Facebook-Seite: clubITsolutions.de</a></li>
				<li><a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/fullstackdevelopment
				.de/">Facebook-Seite: fullstackdevelopment.de</a></li>
			</ul>
		</div>
<!--			<li>-->
<!--				<svg class="menu-social__icon">-->
<!--					<use xlink:href="--><?php //echo get_parent_theme_file_uri(); ?><!--/img/sprite.svg#icon-instagram"></use>-->
<!--				</svg>-->
<!--				<ul>-->
<!--					<li><a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/chidra_eve/">Instagram</a></li>-->
<!--				</ul>-->
<!--			</li>-->
<!--		<div class="menu-social__item">-->
<!--				<svg class="menu-social__icon">-->
<!--					<use xlink:href="--><?php //echo get_parent_theme_file_uri(); ?><!--/img/sprite.svg#icon-link"></use>-->
<!--				</svg>-->
<!--			<ul>-->
<!--			-->
<!--			</ul>-->
<!--		</div>-->
		<div class="menu-social__item site-footer__item">
			<svg class="menu-social__icon">
				<use xlink:href="<?php echo get_parent_theme_file_uri(); ?>/img/sprite.svg#icon-linkedin"></use>
			</svg>
			<ul>
				<li><a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/in/lukas-mainka/">LinkedIn-Profil</a></li>
				<li><a target="_blank" rel="noopener noreferrer" href="https://www.xing.com/profile/Lukas_Mainka">Xing-Profil</a></li>
			</ul>
		</div>
<!--			<li>-->
<!--				<svg class="menu-social__icon">-->
<!--					<use xlink:href="--><?php //echo get_parent_theme_file_uri(); ?><!--/img/sprite.svg#icon-twitter"></use>-->
<!--				</svg>-->
<!--				<ul>-->
<!--					<li><a target="_blank" rel="noopener noreferrer" href="https://twitter.com/chiDra_EVE">Twitter</a></li>-->
<!--				</ul>-->
<!--			</li>-->
	</ul>
	
	<div class="site-info site-footer__item">
		<a href="<?php echo esc_url( __( 'https://clubitsolutions.de/', 'clubitsolutions-theme' ) ); ?>">
			clubITsolutions
		</a>
		<span class="sep"> | </span>
		<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'clubitsolutions-theme' ), 'clubitsolutions-theme', '<a href="https://github.com/chiDraEVE/">chiDraEVE</a>' );
			?>
	</div><!-- .site-info -->
	<div class="menu-footer site-footer__item">
	<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'menu_id'        => 'menu-footer',
				)
			);
			?>
	</div>
	<?php toTheTop(); ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>