<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_menu', function () {
  if (!foleo_is_client_editor()) {
    return;
  }

  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
  remove_menu_page('tools.php');
  remove_menu_page('rank-math');
  remove_menu_page('rank-math-options');
  remove_menu_page('seo-by-rank-math');
}, 999);

add_action('admin_init', function () {
  if (!foleo_is_client_editor()) {
    return;
  }

  global $pagenow;
  if ($pagenow === 'index.php') {
    wp_redirect(admin_url('edit.php?post_type=page'));
    exit;
  }
}, 20);
