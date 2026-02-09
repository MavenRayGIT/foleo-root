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

function foleo_client_page_row_actions($actions, $post) {
  if (!foleo_is_client_shell_context()) {
    return $actions;
  }

  if (!($post instanceof WP_Post) || $post->post_type !== 'page') {
    return $actions;
  }

  $url = foleo_get_compiler_url($post->ID);
  return array(
    'edit' => '<a href="' . esc_url($url) . '">Compile FOLEO</a>'
  );
}

add_filter('page_row_actions', 'foleo_client_page_row_actions', 999, 2);
add_filter('post_row_actions', 'foleo_client_page_row_actions', 999, 2);

add_filter('get_edit_post_link', function ($link, $post_id, $context) {
  if (!foleo_is_client_shell_context()) {
    return $link;
  }

  if (get_post_type($post_id) !== 'page') {
    return $link;
  }

  return foleo_get_compiler_url($post_id);
}, 10, 3);

add_filter('display_post_states', function ($post_states, $post) {
  if (!foleo_is_client_shell_context()) {
    return $post_states;
  }

  if (!($post instanceof WP_Post) || $post->post_type !== 'page') {
    return $post_states;
  }

  foreach ($post_states as $key => $label) {
    if (is_string($label) && strpos($label, 'Breakdance') !== false) {
      $post_states[$key] = str_replace('Breakdance', 'Foleo', $label);
    }
  }

  return $post_states;
}, 999, 2);

add_action('admin_head', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  global $pagenow;
  if ($pagenow !== 'edit.php') {
    return;
  }

  if (empty($_GET['post_type']) || $_GET['post_type'] !== 'page') {
    return;
  }

  echo '<script>
    document.addEventListener("DOMContentLoaded", function () {
      var heading = document.querySelector(".wrap .wp-heading-inline");
      if (heading && heading.textContent) {
        heading.textContent = "My Foleos";
      }
    });
  </script>';
});
