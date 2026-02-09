<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_should_load_compiler_tweaks() {
  if (!foleo_is_compiler_request()) {
    return false;
  }

  if (!foleo_is_client_editor()) {
    return false;
  }

  return true;
}

function foleo_enqueue_compiler_tweaks_assets() {
  if (!foleo_should_load_compiler_tweaks()) {
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


  wp_enqueue_style(
    'foleo-compiler-tweaks',
    foleo_core_asset_url('assets/css/compiler-tweaks.css'),
    array(),
    FOLEO_CORE_VERSION
  );
}

add_action('wp_enqueue_scripts', 'foleo_enqueue_compiler_tweaks_assets');

function foleo_output_compiler_tweaks_in_builder_shell() {
  if (!foleo_should_load_compiler_tweaks()) {
    return;
  }

  static $printed = false;
  if ($printed) {
    return;
  }
  $printed = true;
  $GLOBALS['foleo_compiler_tweaks_printed'] = true;

  $config = wp_json_encode(
    array(
      'exitUrl' => admin_url('edit.php?post_type=page'),
    )
  );

  $script_url = esc_url(foleo_core_asset_url('assets/js/compiler-tweaks.js'));
  $style_url = esc_url(foleo_core_asset_url('assets/css/compiler-tweaks.css'));

  echo '<script>window.FOLEO_COMPILER_TWEAKS=' . $config . ';</script>';
  echo '<link rel="stylesheet" href="' . $style_url . '" />';
  echo '<script src="' . $script_url . '"></script>';
}

add_action(
  'unofficial_i_am_kevin_geary_master_of_all_things_css_and_html',
  'foleo_output_compiler_tweaks_in_builder_shell'
);

add_action('admin_print_footer_scripts', function () {
  if (!foleo_should_load_compiler_tweaks()) {
    return;
  }
  if (!foleo_is_builder_request()) {
    return;
  }
  foleo_output_compiler_tweaks_in_builder_shell();
}, 99);

add_action('shutdown', function () {
  if (!foleo_should_load_compiler_tweaks()) {
    return;
  }
  if (!empty($GLOBALS['foleo_compiler_tweaks_printed'])) {
    return;
  }

  $rate_key = 'foleo_compiler_tweaks_hook_miss';
  if (get_transient($rate_key)) {
    return;
  }

  set_transient($rate_key, '1', HOUR_IN_SECONDS);
  error_log('FOLEO: builder-shell injection hook not fired; Breakdance update may have changed hook.');
}, 99);
