<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  if (isset($_GET['breakdance']) && $_GET['breakdance'] === 'builder') {
    $builder_id = isset($_GET['id']) ? absint($_GET['id']) : 0;
    if ($builder_id) {
      wp_safe_redirect(home_url('/compiler/' . $builder_id));
      exit;
    }
  }

  global $pagenow;
  if ($pagenow !== 'post.php') {
    return;
  }

  $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
  if ($post_id && get_post_type($post_id) === 'page') {
    $ref = wp_get_referer();
    if ($ref && (strpos($ref, 'breakdance=builder') !== false || strpos($ref, '/compiler/') !== false)) {
      wp_safe_redirect(admin_url('edit.php?post_type=page'));
      exit;
    }

    wp_safe_redirect(foleo_get_compiler_url($post_id));
    exit;
  }
}, 30);
