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
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
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

function university_files() {
	wp_enqueue_style( 'fictional-university-style', get_stylesheet_directory_uri() . '/assets/fictional-university/styles.css' );
	wp_enqueue_script('fictional-university-scripts', get_stylesheet_directory_uri() . '/assets/fictional-university/scripts.js', array('jquery'), '1.0', true);
	wp_enqueue_style('roboto-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto.css');
	wp_enqueue_style('roboto-condensed-font', get_stylesheet_directory_uri() . '/assets/fictional-university/roboto-condensed.css');
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/fictional-university/fontawesome47/css/font-awesome.min.css');
	wp_enqueue_script('fictional-university-vendors', get_stylesheet_directory_uri() . '/assets/fictional-university/vendors-scripts.js');
}


//add_action('after_setup_theme', 'university_features');
//
//function university_adjust_queries($query) {
//  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
//    $query->set('orderby', 'title');
//    $query->set('order', 'ASC');
//    $query->set('posts_per_page', -1);
//  }
//
//  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
//    $today = date('Ymd');
//    $query->set('meta_key', 'event_date');
//    $query->set('orderby', 'meta_value_num');
//    $query->set('order', 'ASC');
//    $query->set('meta_query', array(
//              array(
//                'key' => 'event_date',
//                'compare' => '>=',
//                'value' => $today,
//                'type' => 'numeric'
//              )
//            ));
//  }
//}
//
//add_action('pre_get_posts', 'university_adjust_queries');
//
//function universityMapKey($api) {
//  $api['key'] = 'yourKeyGoesHere';
//  return $api;
//}
//
//add_filter('acf/fields/google_map/api', 'universityMapKey');