<?php
/**
 * MU Loader for FOLEO Core plugin.
 */

if (!defined('ABSPATH')) {
  exit;
}

if (defined('FOLEO_CORE_LOADED')) {
  return;
}

$plugin_file = WP_CONTENT_DIR . '/plugins/foleo-core/foleo-core.php';
if (file_exists($plugin_file)) {
  require_once $plugin_file;
}
