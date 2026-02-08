<?php

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('foleo_is_client_user')) {
  function foleo_is_client_user() {
    return current_user_can('edit_posts') && !current_user_can('manage_options');
  }
}

function foleo_is_breakdance_builder_context() {
  if (defined('BREAKDANCE_IS_EDITING') && BREAKDANCE_IS_EDITING) {
    return true;
  }

  if (!empty($_GET['breakdance']) && $_GET['breakdance'] === 'builder') {
    return true;
  }

  if (!empty($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'breakdance=builder') !== false) {
    return true;
  }

  return false;
}

function foleo_enqueue_compiler_tweaks_assets() {
  if (!foleo_is_breakdance_builder_context()) {
    return;
  }

  if (!foleo_is_client_user()) {
    return;
  }

  $base_url = plugin_dir_url(__FILE__) . '../assets/js/';
  wp_enqueue_script(
    'foleo-compiler',
    $base_url . 'foleo-compiler.js',
    array(),
    FOLEO_CORE_VERSION,
    true
  );
}

add_action('admin_enqueue_scripts', 'foleo_enqueue_compiler_tweaks_assets');
add_action('wp_enqueue_scripts', 'foleo_enqueue_compiler_tweaks_assets');
