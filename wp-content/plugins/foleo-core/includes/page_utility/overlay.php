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
    'foleo_poster' => 'Poster'
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
  if (!foleo_should_load_compiler_utility()) {
    return;
  }

  wp_enqueue_style(
    'foleo-compiler-utility',
    foleo_core_asset_url('assets/css/compiler-utility.css'),
    array(),
    FOLEO_CORE_VERSION
  );

  wp_enqueue_script(
    'foleo-compiler-utility',
    foleo_core_asset_url('assets/js/compiler-utility.js'),
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

function foleo_should_load_compiler_utility() {
  if (!foleo_is_compiler_request()) {
    return false;
  }

  $post_id = foleo_get_compiler_post_id();
  if (!$post_id) {
    return false;
  }

  if (!is_user_logged_in()) {
    return false;
  }

  if (!foleo_client_shell_enabled()) {
    return false;
  }

  if (!foleo_is_client_editor()) {
    return false;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return false;
  }

  return true;
}

function foleo_output_compiler_utility_in_builder_shell() {
  if (!foleo_should_load_compiler_utility()) {
    return;
  }

  static $printed = false;
  if ($printed) {
    return;
  }
  $printed = true;

  $post_id = foleo_get_compiler_post_id();
  if (!$post_id) {
    return;
  }

  $config = wp_json_encode(array(
    'restBase' => rest_url('foleo/v1/page/'),
    'nonce' => wp_create_nonce('wp_rest'),
    'postId' => $post_id,
    'metaFields' => foleo_compiler_meta_field_labels()
  ));

  $script_url = esc_url(foleo_compiler_versioned_asset_url('assets/js/compiler-utility.js'));
  $style_url = esc_url(foleo_compiler_versioned_asset_url('assets/css/compiler-utility.css'));

  echo '<script>window.FOLEO_COMPILER_UTILITY=' . $config . ';</script>';
  echo '<link rel="stylesheet" href="' . $style_url . '" />';
  echo '<script src="' . $script_url . '"></script>';
}

function foleo_compiler_versioned_asset_url($path) {
  $url = foleo_core_asset_url($path);
  if (!$url) {
    return $url;
  }
  $ver = defined('FOLEO_CORE_VERSION') ? FOLEO_CORE_VERSION : '';
  if ($ver === '') {
    return $url;
  }
  return add_query_arg('ver', $ver, $url);
}

add_action(
  'unofficial_i_am_kevin_geary_master_of_all_things_css_and_html',
  'foleo_output_compiler_utility_in_builder_shell'
);

add_action('admin_print_footer_scripts', function () {
  if (!foleo_should_load_compiler_utility()) {
    return;
  }
  if (!foleo_is_builder_request()) {
    return;
  }
  foleo_output_compiler_utility_in_builder_shell();
}, 99);
