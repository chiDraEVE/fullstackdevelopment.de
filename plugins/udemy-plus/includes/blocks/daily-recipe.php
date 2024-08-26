<?php

function up_daily_recipe_cb($atts) {
  $title = esc_html($atts['title']);
  $id = get_transient('up_daily_recipe_id');

  if(!$id) {
    $id = up_generate_daily_recipe();
  }

  /*************************************
   ***  Start Measuring Performance  ***
   *************************************/
  $startTime = microtime(true);

  global $wpdb;
  $wpdb->get_var(
    "SELECT ID FROM {$wpdb->posts}
    WHERE post_status='publish' AND post_type='recipe'
    ORDER BY rand() LIMIT 1"
  );

  $endTime = microtime(true);
  $SQLExecutionTime = $endTime - $startTime;

  $startTime = microtime(true);

  new WP_Query([
    'post_type' => 'recipe',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'orderby' => 'rand'
  ]);

  $endTime = microtime(true);
  $WPExecutionTime = $endTime - $startTime;

  /*************************************
   ***   End Measuring Performance   ***
   *************************************/

  ob_start();
  ?>
  <div class="wp-block-udemy-plus-daily-recipe">
    <h6><?php echo $title; ?></h6>
    <a href="<?php the_permalink($id); ?>">
      <img src="<?php echo get_the_post_thumbnail_url($id, 'full'); ?>" />
      <h3><?php echo get_the_title($id); ?></h3>
    </a>
    <p>
      SQL Query: <?php echo $SQLExecutionTime * 1000; ?> <br>
      WP Query: <?php echo $WPExecutionTime * 1000; ?>
    </p>
  </div>
  <?php
  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}