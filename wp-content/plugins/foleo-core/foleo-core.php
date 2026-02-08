<?php
/**
 * Plugin Name: FOLEO Core
 * Description: Core FOLEO utilities and compiler/builder tooling.
 * Version: 0.1.0
 * Network: true
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!defined('FOLEO_CORE_VERSION')) {
  define('FOLEO_CORE_VERSION', '0.1.0');
}

if (!defined('FOLEO_COMPILER_REWRITE_VERSION')) {
  define('FOLEO_COMPILER_REWRITE_VERSION', '1');
}

if (!defined('FOLEO_CORE_LOADED')) {
  define('FOLEO_CORE_LOADED', true);
}

$foleo_core_dir = plugin_dir_path(__FILE__);

require_once $foleo_core_dir . 'includes/compiler-route.php';
require_once $foleo_core_dir . 'includes/compiler-tweaks.php';
require_once $foleo_core_dir . 'includes/client-admin.php';
require_once $foleo_core_dir . 'includes/page-utility-rest.php';
require_once $foleo_core_dir . 'includes/page-utility-overlay.php';

function foleo_core_activate($network_wide) {
  if (is_multisite() && $network_wide) {
    $site_ids = get_sites(array('fields' => 'ids'));
    foreach ($site_ids as $site_id) {
      switch_to_blog((int) $site_id);
      update_option('foleo_rewrite_needs_flush', '1', true);
      update_option('foleo_compiler_rewrite_version', FOLEO_COMPILER_REWRITE_VERSION, true);
      restore_current_blog();
    }
    return;
  }

  update_option('foleo_rewrite_needs_flush', '1', true);
  update_option('foleo_compiler_rewrite_version', FOLEO_COMPILER_REWRITE_VERSION, true);
}

register_activation_hook(__FILE__, 'foleo_core_activate');
