<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('init', function () {
  add_rewrite_rule(
    '^compiler/([0-9]+)/?$',
    'index.php?foleo_compiler=1&foleo_compiler_id=$matches[1]',
    'top'
  );
});

add_filter('query_vars', function ($vars) {
  $vars[] = 'foleo_compiler';
  $vars[] = 'foleo_compiler_id';
  return $vars;
});

add_filter('redirect_canonical', function ($redirect, $requested) {
  if (get_query_var('foleo_compiler') === '1') {
    return false;
  }
  return $redirect;
}, 10, 2);

add_action('wp_initialize_site', function ($new_site) {
  if (!isset($new_site->blog_id)) {
    return;
  }
  $blog_id = (int) $new_site->blog_id;
  if ($blog_id <= 0) {
    return;
  }
  switch_to_blog($blog_id);
  update_option('foleo_rewrite_needs_flush', '1', true);
  update_option('foleo_compiler_rewrite_version', FOLEO_COMPILER_REWRITE_VERSION, true);
  restore_current_blog();
}, 10, 1);

add_action('init', function () {
  $stored_version = get_option('foleo_compiler_rewrite_version');
  if ($stored_version === false) {
    update_option('foleo_rewrite_needs_flush', '1', true);
    update_option('foleo_compiler_rewrite_version', FOLEO_COMPILER_REWRITE_VERSION, true);
  }
});

add_action('wp_loaded', function () {
  if (!is_user_logged_in()) {
    return;
  }
  if (!foleo_is_admin_user()) {
    return;
  }
  if (is_network_admin()) {
    return;
  }

  $stored_version = get_option('foleo_compiler_rewrite_version');
  if ($stored_version !== FOLEO_COMPILER_REWRITE_VERSION) {
    update_option('foleo_rewrite_needs_flush', '1', true);
    update_option('foleo_compiler_rewrite_version', FOLEO_COMPILER_REWRITE_VERSION, true);
  }

  if (get_option('foleo_rewrite_needs_flush') !== '1') {
    return;
  }

  flush_rewrite_rules(false);
  update_option('foleo_rewrite_needs_flush', '0', true);
}, 20);

add_action('template_redirect', function () {
  if (get_query_var('foleo_compiler') !== '1') {
    return;
  }

  $id = absint(get_query_var('foleo_compiler_id'));
  if (!$id) {
    wp_die('Not Found', 404);
  }

  if (!is_user_logged_in()) {
    auth_redirect();
  }

  if (!current_user_can('edit_post', $id)) {
    wp_die('Forbidden', 403);
  }

  if (!defined('FOLEO_COMPILER_MODE')) {
    define('FOLEO_COMPILER_MODE', true);
  }

  $_GET['breakdance'] = 'builder';
  $_GET['id'] = (string) $id;

  global $wp;
  if (is_object($wp) && isset($wp->query_vars)) {
    $wp->query_vars['breakdance'] = 'builder';
    $wp->query_vars['id'] = (string) $id;
  }
});

add_action('wp_footer', function () {
  if (!defined('FOLEO_COMPILER_MODE') || !FOLEO_COMPILER_MODE) {
    return;
  }

  $id = foleo_get_compiler_post_id();
  if (!$id) {
    return;
  }

  echo '<script>(function(){try{var path="/compiler/' . $id . '";if(window.location.pathname!==path){window.history.replaceState({},"",path+window.location.search+window.location.hash);}}catch(e){}})();</script>';
}, 1000);
