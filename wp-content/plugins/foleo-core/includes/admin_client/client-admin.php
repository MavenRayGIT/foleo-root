<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_get_compiler_url($post_id) {
  $post_id = absint($post_id);
  if (!$post_id) {
    return home_url('/');
  }
  return home_url('/compiler/' . $post_id);
}

add_action('admin_menu', function () {
  if (!foleo_is_client_user()) {
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
  if (!foleo_is_client_user()) {
    return;
  }

  global $pagenow;
  if ($pagenow === 'index.php') {
    wp_redirect(admin_url('edit.php?post_type=page'));
    exit;
  }

  if ($pagenow === 'post.php') {
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    if ($post_id && get_post_type($post_id) === 'page') {
      wp_redirect(foleo_get_compiler_url($post_id));
      exit;
    }
  }
}, 20);

add_filter('page_row_actions', function ($actions, $post) {
  if (!foleo_is_client_user()) {
    return $actions;
  }

  if (!($post instanceof WP_Post) || $post->post_type !== 'page') {
    return $actions;
  }

  $url = foleo_get_compiler_url($post->ID);
  return array(
    'edit' => '<a href="' . esc_url($url) . '">Edit</a>'
  );
}, 10, 2);

add_filter('get_edit_post_link', function ($link, $post_id, $context) {
  if (!foleo_is_client_user()) {
    return $link;
  }

  if (get_post_type($post_id) !== 'page') {
    return $link;
  }

  return foleo_get_compiler_url($post_id);
}, 10, 3);

add_action('admin_head', function () {
  if (!foleo_is_client_user()) {
    return;
  }

  global $pagenow;
  if ($pagenow !== 'profile.php') {
    return;
  }

  echo '<style>
    #rank-math-profile-options,
    .rank-math-profile-options,
    .rank-math-wrap,
    .rank-math-settings,
    .rank-math-section {
      display: none !important;
    }
  </style>';
});

add_filter('show_admin_bar', function ($show) {
  if (!foleo_is_client_user()) {
    return $show;
  }
  return false;
});
