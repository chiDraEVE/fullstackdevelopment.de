<?php

$post_id = get_the_ID();
$layout  = $attributes['layout'] ?? 'card';

if ( ! $post_id || get_post_type( $post_id ) !== 'instructor' ) {
	return '<div class="fsd-instructor-card">Author Card: außerhalb eines Dozenten-Posts.</div>';
}

$projects = get_posts([
	'post_type' => 'project',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'meta_query' => [[
		'key' => 'instructor',
		'value' => (string) $post_id,
		'compare' => '='
	]]
]);

$sources = get_posts([
	'post_type' => 'source',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'meta_query' => [[
		'key' => 'instructor',
		'value' => (string) $post_id,
		'compare' => '='
	]]
]);

//ob_start();
//?>
<!--	<article class="fsd-author-card fsd-author-card----><?php //echo esc_attr($layout); ?><!--">-->
<!--		<h2>--><?php //echo esc_html( get_the_title( $post_id ) ); ?><!--</h2>-->
<!--		<div>Projekte: --><?php //echo count($projects); ?><!--</div>-->
<!--		<div>Quellen: --><?php //echo count($sources); ?><!--</div>-->
<!--	</article>-->
<?php
//return ob_get_clean();
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php
	if ( ! $post_id && isset( $block->context['postId'] ) ) {
		$post_id = $block->context['postId'];
	}

	esc_html_e( 'Render Block von Instructor Card – hello from a dynamic block!', 'fullstack-blocks' );
	print('<p>' . $post_id) . ' Layout: ' . $layout . '</p>';
	var_dump($projects);
	var_dump($sources);
	?>
</p>
