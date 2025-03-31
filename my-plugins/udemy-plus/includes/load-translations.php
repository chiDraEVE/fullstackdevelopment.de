<?php

function up_load_php_translations() {
  load_plugin_textdomain(
    'udemy-plus', 
    false, 
    'udemy-plus/languages' 
  ); 
}

function up_load_block_translations() {
  $blocks = [
    'udemy-plus-fancy-header-editor-script',
    'udemy-plus-advanced-search-editor-script',
    'udemy-plus-page-header-editor-script',
    'udemy-plus-featured-video-editor-script',
    'udemy-plus-header-tools-editor-script',
    'udemy-plus-auth-modal-script',
    'udemy-plus-auth-modal-editor-script',
    'udemy-plus-recipe-summary-script',
    'udemy-plus-recipe-summary-editor-script',
    'udemy-plus-team-members-group-editor-script',
    'udemy-plus-team-member-editor-script',
    'udemy-plus-popular-recipes-editor-script',
    'udemy-plus-daily-recipe-editor-script'
  ];

  foreach($blocks as $block) {
    wp_set_script_translations(
      $block,
      "udemy-plus",
      UP_PLUGIN_DIR . "languages"
    );
  }
}