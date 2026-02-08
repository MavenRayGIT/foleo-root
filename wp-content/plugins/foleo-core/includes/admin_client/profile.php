<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_head', function () {
  if (!foleo_is_client_editor()) {
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
  if (!foleo_is_client_editor()) {
    return $show;
  }
  return false;
});
