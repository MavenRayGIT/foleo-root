<?php
/**
 * MU Loader for FOLEO Core plugin.
 */

if (!defined('ABSPATH')) {
  exit;
}

$plugin_main = WP_CONTENT_DIR . '/plugins/foleo-core/foleo-core.php';
if (file_exists($plugin_main)) {
  require_once $plugin_main;
  return;
}

return;
