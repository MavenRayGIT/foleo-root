<?php

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('foleo_core_asset_url')) {
  function foleo_core_asset_url($path) {
    if (defined('FOLEO_CORE_FILE')) {
      return plugins_url($path, FOLEO_CORE_FILE);
    }
    return plugins_url($path, dirname(__FILE__) . '/../..');
  }
}
