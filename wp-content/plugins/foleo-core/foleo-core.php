<?php
/**
 * Plugin Name: FOLEO Core
 * Description: Core FOLEO utilities and compiler/builder tooling.
 * Version: 0.1.1
 * Network: true
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!defined('FOLEO_CORE_VERSION')) {
  define('FOLEO_CORE_VERSION', '0.1.8');
}

if (!defined('FOLEO_CORE_FILE')) {
  define('FOLEO_CORE_FILE', __FILE__);
}

if (!defined('FOLEO_COMPILER_REWRITE_VERSION')) {
  define('FOLEO_COMPILER_REWRITE_VERSION', '1');
}

if (!defined('FOLEO_CORE_LOADED')) {
  define('FOLEO_CORE_LOADED', true);
}

$foleo_core_dir = plugin_dir_path(__FILE__);

if (!function_exists('foleo_core_require')) {
  function foleo_core_require($file) {
    if (file_exists($file)) {
      require_once $file;
      return true;
    }
    static $logged = array();
    if (!isset($logged[$file])) {
      $logged[$file] = true;
      error_log('[foleo-core] Missing include: ' . $file);
    }
    return false;
  }
}

foleo_core_require($foleo_core_dir . 'includes/core/capabilities.php');
foleo_core_require($foleo_core_dir . 'includes/core/context.php');
foleo_core_require($foleo_core_dir . 'includes/core/assets.php');

foleo_core_require($foleo_core_dir . 'includes/compiler/route.php');
foleo_core_require($foleo_core_dir . 'includes/compiler/tweaks.php');
foleo_core_require($foleo_core_dir . 'includes/compiler/widgets.php');
foleo_core_require($foleo_core_dir . 'includes/compiler/rest.php');

foleo_core_require($foleo_core_dir . 'includes/page_utility/rest.php');
foleo_core_require($foleo_core_dir . 'includes/page_utility/overlay.php');

foleo_core_require($foleo_core_dir . 'includes/admin_client/menus.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/pages_list.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/search_visibility.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/editor_block.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/profile.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/settings.php');
foleo_core_require($foleo_core_dir . 'includes/admin_client/theme.php');

foleo_core_require($foleo_core_dir . 'includes/binder/schema.php');
foleo_core_require($foleo_core_dir . 'includes/binder/rest.php');
foleo_core_require($foleo_core_dir . 'includes/binder/ui.php');

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
