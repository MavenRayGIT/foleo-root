<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_enqueue_compiler_tweaks_assets() {
  if (!foleo_is_compiler_request()) {
    return;
  }

  if (!foleo_is_client_editor()) {
    return;
  }

  wp_enqueue_script(
    'foleo-compiler-tweaks',
    foleo_core_asset_url('assets/js/compiler-tweaks.js'),
    array(),
    FOLEO_CORE_VERSION,
    true
  );

  wp_localize_script(
    'foleo-compiler-tweaks',
    'FOLEO_COMPILER_TWEAKS',
    array(
      'exitUrl' => admin_url('edit.php?post_type=page'),
    )
  );

  wp_add_inline_script(
    'foleo-compiler-tweaks',
    'window.__FOLEO_TWEAKS_LOADED__=true;',
    'after'
  );

  wp_enqueue_style(
    'foleo-compiler-tweaks',
    foleo_core_asset_url('assets/css/compiler-tweaks.css'),
    array(),
    FOLEO_CORE_VERSION
  );
}

add_action('wp_enqueue_scripts', 'foleo_enqueue_compiler_tweaks_assets');
