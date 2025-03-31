<?php

function up_save_options() {
  if(!current_user_can('edit_theme_options')) {
    wp_die(
      __("You are not allowed to be on this page.", 'udemy-plus')
    );
  }

  check_admin_referer('up_options_verify');

  $options = get_option('up_options');

  $options['og_title'] = sanitize_text_field($_POST['up_og_title']);
  $options['og_img'] = sanitize_url($_POST['up_og_image']);
  $options['og_description'] = sanitize_text_field($_POST['up_og_description']);
  $options['enable_og'] = absint($_POST['up_enable_og']);

  update_option('up_options', $options);

  wp_redirect(admin_url('admin.php?page=up-plugin-options&status=1'));
}