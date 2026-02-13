<?php

if (!defined('ABSPATH')) {
  exit;
}

// Legacy features are internal-only, default OFF for clients; may be
// re-enabled for v2/dev by option outside client-shell.
if (!function_exists('foleo_legacy_nav_enabled')) {
  function foleo_legacy_nav_enabled() {
    if (foleo_is_client_shell_context()) {
      return false;
    }
    // Legacy nav is internal only. Future v2/dev may re-enable via
    // option foleo_legacy_nav_enabled. Not exposed to clients.
    $value = get_option('foleo_legacy_nav_enabled', '0');
    if (is_bool($value)) {
      return $value;
    }
    $value = is_string($value) ? strtolower(trim($value)) : $value;
    return !in_array($value, array('0', 0, 'false', 'off', ''), true);
  }
}

function foleo_workspace_group_header_callback() {
  if (!foleo_is_client_shell_context()) {
    return;
  }
}

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  // Rename Dashboard to Workspace.
  global $menu;
  foreach ($menu as $index => $item) {
    if (!empty($item[2]) && $item[2] === 'index.php') {
      $menu[$index][0] = 'Workspace';
      break;
    }
  }

  // Remove Pages from the main nav; add under Workspace instead.
  remove_menu_page('edit.php?post_type=page');

  remove_menu_page('edit.php');
  remove_menu_page('upload.php');
  remove_menu_page('edit-comments.php');
  remove_menu_page('tools.php');
  remove_menu_page('rank-math');
  remove_menu_page('rank-math-options');
  remove_menu_page('seo-by-rank-math');

  // Clean up Dashboard submenu and add Workspace items.
  remove_submenu_page('index.php', 'index.php');
  remove_submenu_page('index.php', 'update-core.php');
  remove_submenu_page('index.php', 'my-sites.php');

}, 999);

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  if (!foleo_legacy_nav_enabled()) {
    return;
  }

  remove_submenu_page('index.php', 'edit.php?post_type=page');
  remove_submenu_page('index.php', 'my-sites.php');
  remove_submenu_page('index.php', 'foleo-settings');
  remove_submenu_page('index.php', 'foleo-group-legacy');

  add_submenu_page('index.php', 'My Foleos', 'My Foleos', 'edit_posts', 'edit.php?post_type=page');
  add_submenu_page('index.php', 'My Sites', 'My Sites', 'read', 'my-sites.php');
  add_submenu_page('index.php', 'FOLEO Settings', 'Settings', 'edit_posts', 'foleo-settings', 'foleo_render_settings_page');
}, 1002);

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  if (foleo_legacy_nav_enabled()) {
    return;
  }
  remove_submenu_page('index.php', 'foleo-group-legacy');
  remove_submenu_page('index.php', 'edit.php?post_type=page');
  remove_submenu_page('index.php', 'my-sites.php');
  remove_submenu_page('index.php', 'foleo-settings');
}, 1001);

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  $cleanup_slugs = array(
    'foleo-group-legacy',
    'edit.php?post_type=page',
    'my-sites.php',
    'foleo-settings',
  );
  foreach ($cleanup_slugs as $cleanup_slug) {
    remove_submenu_page('index.php', $cleanup_slug);
  }
}, 99999);

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  if (function_exists('get_user_setting') && function_exists('set_user_setting')) {
    if (get_user_setting('mfold') !== 'o') {
      set_user_setting('mfold', 'o');
    }
    if ((string) get_user_setting('unfold') !== '1') {
      set_user_setting('unfold', 1);
    }
  }

  global $pagenow;
  $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
  if ($pagenow === 'index.php' && $page === '') {
    wp_redirect(admin_url('admin.php?page=foleo-workspace'));
    exit;
  }
}, 20);

/**
 * Layer 4 nav fallback sublayer (intentionally narrow and isolated).
 * Purpose: keep Workspace logo/link resilient if adapter assets fail to load.
 */
add_action('admin_head', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  ?>
  <style id="foleo-nav-fallback-style">
    body.foleo-client-shell-active #adminmenuwrap #adminmenu .foleo-admin-logo {
      height: 40px;
      margin: 10px 0 6px;
      padding-left: 7px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }
    body.foleo-client-shell-active #adminmenuwrap #adminmenu .foleo-admin-logo a {
      display: flex;
      align-items: center;
      gap: 6px;
      width: 100%;
      height: 100%;
    }
    body.foleo-client-shell-active #adminmenuwrap #adminmenu .foleo-admin-logo .foleo-logo-icon {
      width: 20px;
      height: 20px;
      background: url("https://foleo.co/wp-content/uploads/SVG/foleo-icon-color1.svg") no-repeat 50% 50% / 20px 20px;
      flex: 0 0 20px;
    }
    body.foleo-client-shell-active #adminmenuwrap #adminmenu .foleo-admin-logo .foleo-logo-word {
      width: 60px;
      height: 20px;
      background: url("https://foleo.co/wp-content/uploads/SVG/foleo-wordmark-wht.svg") no-repeat 0 50% / 60px auto;
      flex: 0 0 60px;
    }
    body.foleo-client-shell-active.folded #adminmenuwrap #adminmenu .foleo-admin-logo {
      padding-left: 0;
      justify-content: center;
    }
    body.foleo-client-shell-active.folded #adminmenuwrap #adminmenu .foleo-admin-logo .foleo-logo-word {
      display: none;
    }
  </style>
  <?php
});

add_action('admin_print_footer_scripts', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  ?>
  <script id="foleo-nav-fallback-script">
    (function () {
      var workspaceUrl = <?php echo wp_json_encode(admin_url('admin.php?page=foleo-workspace')); ?>;
      var menu = document.getElementById("adminmenu");
      if (!menu) return;
      if (menu.getAttribute("data-foleo-nav-fallback") === "1") return;

      function ensureLogo() {
        if (!menu || menu.querySelector(".foleo-admin-logo")) return;
        var li = document.createElement("li");
        li.className = "foleo-admin-logo";
        var a = document.createElement("a");
        a.href = workspaceUrl;
        a.setAttribute("aria-label", "FOLEO");
        a.innerHTML = '<span class="foleo-logo-icon"></span><span class="foleo-logo-word"></span>';
        li.appendChild(a);
        menu.insertBefore(li, menu.firstChild);
      }
      function ensureWorkspaceLink() {
        var dashboardLink = menu.querySelector("#menu-dashboard > a.menu-top");
        if (!dashboardLink) return false;
        dashboardLink.href = workspaceUrl;
        return true;
      }
      function run() {
        var hadLogo = !!menu.querySelector(".foleo-admin-logo");
        ensureLogo();
        var hasLogo = !!menu.querySelector(".foleo-admin-logo");
        var rewired = ensureWorkspaceLink();
        if ((hadLogo || hasLogo) && rewired) {
          menu.setAttribute("data-foleo-nav-fallback", "1");
        }
      }
      run();
      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", run);
      }
      var retries = 0;
      var timer = window.setInterval(function () {
        run();
        retries += 1;
        if (menu.querySelector(".foleo-admin-logo") || retries >= 8) {
          window.clearInterval(timer);
        }
      }, 200);
    })();
  </script>
  <?php
});
