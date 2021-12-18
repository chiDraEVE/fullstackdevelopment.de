<?php
	require_once( 'header.php' );
	
	?>
	
	<h1>Hello World</h1>
<?php
	
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	
	require_once( 'footer.php' );
