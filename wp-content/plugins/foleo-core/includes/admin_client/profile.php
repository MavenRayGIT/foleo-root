<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_head', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  global $pagenow;
  if ($pagenow !== 'profile.php') {
    echo '<style>
      #wpadminbar { display: none !important; }
      html.wp-toolbar { padding-top: 0 !important; }
      body.admin-bar { padding-top: 0 !important; }
      #adminmenu #toplevel_page_foleo-logout .wp-submenu li:nth-child(n+2),
      #adminmenu #menu-users .wp-submenu li:nth-child(n+2) {
        display: none !important;
      }
    </style>';
    return;
  }

  echo '<style>
    #your-profile .user-admin-color-wrap,
    #your-profile .user-comment-shortcuts-wrap,
    #your-profile .show-admin-bar,
    #your-profile .user-display-name-wrap,
    #your-profile .user-description-wrap,
    #your-profile .user-profile-picture,
    #your-profile #rank_math_additional_profile_urls,
    #your-profile input[name="rank_math_twitter_profile_url"],
    #your-profile input[name="rank_math_facebook_profile_url"],
    #your-profile .rank-math-profile-header,
    #your-profile #application-passwords,
    #your-profile #application-passwords-section,
    #your-profile [id*="rank-math"],
    #your-profile [class*="rank-math"],
    #your-profile .rank-math-wrap,
    #your-profile .rank-math-settings,
    #your-profile .rank-math-section,
    #your-profile .rank-math-profile-options,
    #your-profile .rank-math-profile-options * {
      display: none !important;
    }
    #profile-page h2,
    #profile-page .form-table {
      margin-top: 0;
    }
    #profile-page #application-passwords {
      margin-top: 0 !important;
    }
    #wpadminbar { display: none !important; }
    html.wp-toolbar { padding-top: 0 !important; }
    body.admin-bar { padding-top: 0 !important; }
    #adminmenu #toplevel_page_foleo-logout .wp-submenu li:nth-child(n+2),
    #adminmenu #menu-users .wp-submenu li:nth-child(n+2) {
      display: none !important;
    }
  </style>
  <script>
    (function () {
      function removeSections() {
        var root = document.getElementById("profile-page");
        if (!root) return;

        var headings = root.querySelectorAll("h2");
        headings.forEach(function (h2) {
          var text = (h2.textContent || "").trim();
          if (!text) return;
          if (!/about yourself/i.test(text) && !/rank math/i.test(text)) return;
          var node = h2.nextElementSibling;
          h2.remove();
          while (node && node.tagName && node.tagName.toLowerCase() !== "h2") {
            var next = node.nextElementSibling;
            node.remove();
            node = next;
          }
        });

        var rankNodes = root.querySelectorAll(\'[id*="rank-math"], [class*="rank-math"], [id*="rank_math"], [class*="rank_math"], input[name="rank_math_twitter_profile_url"], input[name="rank_math_facebook_profile_url"], textarea#rank_math_additional_profile_urls\');
        rankNodes.forEach(function (node) {
          var row = node.closest("tr");
          if (row) {
            row.remove();
          } else {
            node.remove();
          }
        });

        var socialRows = root.querySelectorAll(\'tr.user-twitter-wrap, tr.user-facebook-wrap, tr.user-additional_profile_urls-wrap\');
        socialRows.forEach(function (row) {
          row.remove();
        });

        var rankFooter = document.getElementById("footer-left");
        if (rankFooter && /rank math/i.test(rankFooter.textContent || "")) {
          rankFooter.remove();
        }

        var bioRow = root.querySelector(\'tr.user-description-wrap, #description\');
        if (bioRow) {
          var row = bioRow.closest("tr") || bioRow.closest(".form-table");
          if (row) row.remove();
        }
      }

      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", removeSections);
      } else {
        removeSections();
      }
      setTimeout(removeSections, 300);
    })();
  </script>';
});

add_filter('show_admin_bar', function ($show) {
  if (!foleo_is_client_editor() || !foleo_client_shell_enabled()) {
    return $show;
  }
  return false;
});

function foleo_admin_logout_redirect() {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  wp_safe_redirect(wp_logout_url(wp_login_url()));
  exit;
}

function foleo_admin_profile_redirect() {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  wp_safe_redirect(admin_url('profile.php'));
  exit;
}

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  add_menu_page(
    'Logout',
    'Logout',
    'read',
    'foleo-logout',
    'foleo_admin_logout_redirect',
    'dashicons-external',
    1
  );

  // Add submenu items to force collapsed flyouts.
  add_submenu_page('foleo-logout', 'Logout', 'Logout', 'read', 'foleo-logout-sub');
  add_submenu_page('profile.php', 'Profile', 'Profile', 'read', 'foleo-profile-sub');
}, 999);

add_action('adminmenu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  global $submenu;
  if (!is_array($submenu)) {
    return;
  }

  $submenu['foleo-logout'] = array(
    array('Logout', 'read', 'foleo-logout-sub'),
  );

  $submenu['profile.php'] = array(
    array('Profile', 'read', 'foleo-profile-sub'),
  );
}, 1000);

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  if (isset($_GET['page']) && $_GET['page'] === 'foleo-logout') {
    foleo_admin_logout_redirect();
  }

  if (isset($_GET['page']) && $_GET['page'] === 'foleo-logout-sub') {
    foleo_admin_logout_redirect();
  }

  if (isset($_GET['page']) && $_GET['page'] === 'foleo-profile-sub') {
    foleo_admin_profile_redirect();
  }
}, 5);
