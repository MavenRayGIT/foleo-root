<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_compiler_meta_field_labels() {
  $labels = array(
    'foleo_fade_img_1' => 'Fade Image 1',
    'foleo_fade_img_2' => 'Fade Image 2',
    'foleo_fade_img_3' => 'Fade Image 3',
    'foleo_cf_stream_id' => 'CF Stream ID',
    'foleo_cf_poster' => 'CF Poster'
  );

  $labels = apply_filters('foleo_compiler_meta_field_labels', $labels);

  $fields = array();
  foreach (foleo_compiler_allowed_meta_keys() as $key) {
    $fields[] = array(
      'key' => $key,
      'label' => isset($labels[$key]) ? $labels[$key] : $key
    );
  }

  return $fields;
}

add_action('wp_enqueue_scripts', function () {
  if (!foleo_is_compiler_request()) {
    return;
  }

  $post_id = foleo_get_compiler_post_id();
  if (!$post_id) {
    return;
  }

  if (!is_user_logged_in()) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  $base_url = plugin_dir_url(__FILE__) . '../assets/';

  wp_enqueue_style(
    'foleo-compiler-utility',
    $base_url . 'css/foleo-compiler-utility.css',
    array(),
    FOLEO_CORE_VERSION
  );

  wp_enqueue_script(
    'foleo-compiler-utility',
    $base_url . 'js/foleo-compiler-utility.js',
    array(),
    FOLEO_CORE_VERSION,
    true
  );

  wp_localize_script('foleo-compiler-utility', 'FOLEO_COMPILER_UTILITY', array(
    'restBase' => rest_url('foleo/v1/page/'),
    'nonce' => wp_create_nonce('wp_rest'),
    'postId' => $post_id,
    'metaFields' => foleo_compiler_meta_field_labels()
  ));
});
