<?php

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('foleo_core_asset_url')) {
  function foleo_core_asset_url($path) {
    return plugins_url($path, dirname(__FILE__) . '/../..');
  }
}
