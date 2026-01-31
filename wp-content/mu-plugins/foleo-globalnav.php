<?php
/*
Plugin Name: Foleo Global Nav Include
*/

add_shortcode('foleo_globalnav', function () {
  $log_enabled = defined('WP_DEBUG') && WP_DEBUG;
  $mount_base = '<div class="foleo-globalnav" data-foleo-globalnav data-nav-source="shortcode"';

  $tracked_file = plugin_dir_path(__FILE__) . 'foleo/partials/globalnav.html';
  $uploads_file = WP_CONTENT_DIR . '/uploads/foleo/globalnav.html';
  $source = 'missing_all';
  $file = null;

  $context = array(
    'logged_in' => function_exists('is_user_logged_in') ? (is_user_logged_in() ? '1' : '0') : 'na',
    'can_manage' => function_exists('current_user_can') ? (current_user_can('manage_options') ? '1' : '0') : 'na',
    'blog_id' => function_exists('get_current_blog_id') ? get_current_blog_id() : 'na',
    'post_id' => function_exists('get_queried_object_id') ? get_queried_object_id() : 'na',
    'post_type' => function_exists('get_post_type') ? get_post_type(get_queried_object_id()) : 'na',
    'path' => isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'na',
  );

  if ($log_enabled) {
    error_log('[foleo_globalnav] shortcode invoked ' . wp_json_encode($context));
  }

  if (file_exists($tracked_file)) {
    $file = $tracked_file;
    $source = 'tracked_default';
  }

  if (file_exists($uploads_file)) {
    $file = $uploads_file;
    $source = 'uploads_override';
  }

  if (!$file) {
    if ($log_enabled) {
      error_log('[foleo_globalnav] missing files: tracked=' . $tracked_file . ' uploads=' . $uploads_file);
    }
    return $mount_base . ' data-nav-disabled="1" data-nav-reason="missing_all"></div>';
  }

  $html = file_get_contents($file);
  if ($html === false || trim($html) === '') {
    if ($log_enabled) {
      error_log('[foleo_globalnav] empty file: ' . $file);
    }
    return $mount_base . ' data-nav-disabled="1" data-nav-reason="' . $source . '_empty"></div>';
  }

  $has_mount =
    (strpos($html, 'data-foleo-globalnav') !== false) ||
    (strpos($html, 'foleo-globalnav') !== false);

  if ($has_mount) {
    if ($log_enabled) {
      error_log('[foleo_globalnav] source=' . $source . ' file=' . $file);
    }
    return $html;
  }

  if ($log_enabled) {
    error_log('[foleo_globalnav] source=' . $source . ' file=' . $file . ' append_mount=1');
  }

  return $html . $mount_base . ' data-nav-reason="' . $source . '"></div>';
});
