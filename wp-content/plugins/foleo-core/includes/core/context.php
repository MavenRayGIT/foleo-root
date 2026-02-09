<?php

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('foleo_is_compiler_request')) {
  function foleo_is_compiler_request() {
    if (get_query_var('foleo_compiler') === '1') {
      return true;
    }
    if (!empty($_SERVER['REQUEST_URI']) && preg_match('#/compiler/\d+/?#', $_SERVER['REQUEST_URI'])) {
      return true;
    }
    return false;
  }
}

if (!function_exists('foleo_get_compiler_post_id')) {
  function foleo_get_compiler_post_id() {
    $id = absint(get_query_var('foleo_compiler_id'));
    if ($id) {
      return $id;
    }
    if (!empty($_SERVER['REQUEST_URI']) && preg_match('#/compiler/(\d+)/?#', $_SERVER['REQUEST_URI'], $matches)) {
      return absint($matches[1]);
    }
    return 0;
  }
}

if (!function_exists('foleo_is_builder_request')) {
  function foleo_is_builder_request() {
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
}

if (!function_exists('foleo_client_shell_enabled')) {
  function foleo_client_shell_enabled() {
    $enabled = true;
    if (defined('FOLEO_CLIENT_SHELL_ENABLED')) {
      $enabled = (bool) FOLEO_CLIENT_SHELL_ENABLED;
    }
    return (bool) apply_filters('foleo_client_shell_enabled', $enabled);
  }
}

if (!function_exists('foleo_is_client_shell_context')) {
  function foleo_is_client_shell_context() {
    if (!is_admin() || is_network_admin()) {
      return false;
    }
    if (!foleo_is_client_editor()) {
      return false;
    }
    return foleo_client_shell_enabled();
  }
}
