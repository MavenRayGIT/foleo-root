<?php

if (!defined('ABSPATH')) {
  exit;
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
  remove_menu_page('edit-comments.php');
  remove_menu_page('tools.php');
  remove_menu_page('rank-math');
  remove_menu_page('rank-math-options');
  remove_menu_page('seo-by-rank-math');

  // Clean up Dashboard submenu and add Workspace items.
  remove_submenu_page('index.php', 'index.php');
  remove_submenu_page('index.php', 'update-core.php');
  remove_submenu_page('index.php', 'my-sites.php');
  add_submenu_page('index.php', 'My Foleos', 'My Foleos', 'edit_posts', 'edit.php?post_type=page');
  add_submenu_page('index.php', 'My Sites', 'My Sites', 'read', 'my-sites.php');
}, 999);

add_action('admin_head', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  $icon = esc_url(foleo_core_asset_url('assets/img/workspace-foleo1.svg'));
  $logo_full = esc_url('https://foleo.co/wp-content/uploads/SVG/foleo-wordmark-wht.svg');
  $logo_icon = esc_url('https://foleo.co/wp-content/uploads/SVG/foleo-icon-color1.svg');

  echo '<style>
    #adminmenuwrap,
    #adminmenuback,
    #adminmenu {
      height: 100vh !important;
    }
    #adminmenuwrap,
    #adminmenuback {
      position: fixed !important;
      top: 0;
      bottom: 0;
      height: 100vh !important;
      overflow: hidden !important;
    }
    #adminmenu {
      display: flex !important;
      flex-direction: column !important;
      min-height: 0;
      height: 100% !important;
      overflow: hidden !important;
      padding-bottom: 60px !important;
    }
    #adminmenu:before,
    #adminmenu:after {
      content: "";
      display: block;
      flex: 0.45 1 auto;
    }
    #adminmenu li#collapse-menu {
      margin-bottom: 20px !important;
    }
    #adminmenu:before { order: 2; }
    #adminmenu:after { order: 5; }
    #adminmenu li#toplevel_page_foleo-logout,
    #adminmenu li#menu-users {
      order: 1;
    }
    #adminmenu .foleo-admin-logo {
      order: 0;
      height: 40px;
      margin: 10px 0 6px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding-left: 12px;
    }
    #adminmenu .foleo-admin-logo a {
      display: flex;
      align-items: center;
      gap: 6px;
      width: 100%;
      height: 100%;
    }

    #adminmenu .foleo-admin-logo {padding-left: 7px !important;}

    #adminmenu .foleo-admin-logo .foleo-logo-icon {
      width: 20px;
      height: 20px;
      background: url("' . $logo_icon . '") no-repeat 50% 50% / 20px 20px;
      flex: 0 0 20px;
    }
    #adminmenu .foleo-admin-logo .foleo-logo-word {
      width: 60px;
      height: 20px;
      background: url("' . $logo_full . '") no-repeat 0 50% / 60px auto;
      flex: 0 0 60px;
    }
    body.folded #adminmenu .foleo-admin-logo {
      height: 40px;
      margin: 10px 0 4px;
      padding-left: 0;
    }
    body.folded #adminmenu .foleo-admin-logo a {
      justify-content: center;
      gap: 0;
    }
    body.folded #adminmenu .foleo-admin-logo .foleo-logo-word {
      display: none;
    }
    #adminmenu li#menu-dashboard {
      order: 3;
    }
    #adminmenu li#menu-media {
      order: 4;
    }
    #adminmenu li#collapse-menu {
      order: 6;
      margin-bottom: 0;
    }
    #adminmenu li {
      margin-top: 0 !important;
      margin-bottom: 0 !important;
    }
    #adminmenu #menu-dashboard .wp-menu-image:before,
    #adminmenu #menu-dashboard .dashicons-dashboard:before {
      content: "";
      display: block;
      width: 20px;
      height: 20px;
      margin: 8px auto 0;
      background: url("' . $icon . '") no-repeat 50% 50% / 20px 20px !important;
      opacity: 0.6;
    }
    #adminmenu #menu-dashboard .dashicons-dashboard:before {
      color: transparent !important;
    }
    #adminmenu #menu-dashboard .wp-menu-image {
      background: none !important;
    }
    #adminmenu #menu-dashboard .wp-menu-image {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    #adminmenu #menu-dashboard .wp-menu-image:before {
      margin: 0;
    }
    #adminmenu li#menu-dashboard.current .wp-menu-image:before,
    #adminmenu li#menu-dashboard.wp-has-current-submenu .wp-menu-image:before,
    #adminmenu li#menu-dashboard.current .dashicons-dashboard:before,
    #adminmenu li#menu-dashboard.wp-has-current-submenu .dashicons-dashboard:before {
      opacity: 1;
    }
    body.folded #adminmenu a.menu-top,
    body.folded #adminmenu a.menu-top:focus,
    body.folded #adminmenu a.menu-top:hover {
      position: relative;
      overflow: visible;
    }
    body.folded #adminmenu a.menu-top .wp-menu-name {
      display: block !important;
      position: absolute !important;
      left: 48px;
      top: 50%;
      transform: translateY(-50%);
      background: #1d2327;
      color: #fff;
      padding: 6px 10px;
      border-radius: 4px;
      font-size: 12px;
      line-height: 1.2;
      white-space: nowrap;
      box-shadow: 0 4px 10px rgba(0,0,0,0.25);
      opacity: 0 !important;
      pointer-events: none;
      z-index: 99999;
    }
    body.folded #adminmenu a.menu-top:hover .wp-menu-name,
    body.folded #adminmenu a.menu-top:focus .wp-menu-name {
      opacity: 1 !important;
    }
    body.folded #adminmenu .wp-submenu {
      display: none !important;
    }
  </style>';

  echo '<script>
    (function () {
      var tooltip = null;
      function ensureLogo() {
        var menu = document.getElementById("adminmenu");
        if (!menu) return;
        if (menu.querySelector(".foleo-admin-logo")) return;
        var li = document.createElement("li");
        li.className = "foleo-admin-logo";
        var a = document.createElement("a");
        a.href = "' . esc_js(admin_url('edit.php?post_type=page')) . '";
        a.setAttribute("aria-label", "FOLEO");
        a.innerHTML = \'<span class="foleo-logo-icon"></span><span class="foleo-logo-word"></span>\';
        li.appendChild(a);
        menu.insertBefore(li, menu.firstChild);
      }
      function showTooltip(target) {
        var name = target.querySelector(".wp-menu-name");
        if (!name) return;
        var text = (name.textContent || "").trim();
        if (!text) return;
        if (!tooltip) {
          tooltip = document.createElement("div");
          tooltip.setAttribute("data-foleo-tooltip", "1");
          tooltip.style.position = "fixed";
          tooltip.style.background = "#1d2327";
          tooltip.style.color = "#fff";
          tooltip.style.padding = "6px 10px";
          tooltip.style.borderRadius = "4px";
          tooltip.style.fontSize = "12px";
          tooltip.style.lineHeight = "1.2";
          tooltip.style.whiteSpace = "nowrap";
          tooltip.style.boxShadow = "0 4px 10px rgba(0,0,0,0.25)";
          tooltip.style.zIndex = "99999";
          document.body.appendChild(tooltip);
        }
        tooltip.textContent = text;
        var rect = target.getBoundingClientRect();
        tooltip.style.left = (rect.right + 8) + "px";
        tooltip.style.top = (rect.top + rect.height / 2) + "px";
        tooltip.style.transform = "translateY(-50%)";
        tooltip.style.opacity = "1";
      }
      function hideTooltip() {
        if (tooltip) {
          tooltip.style.opacity = "0";
        }
      }
      document.addEventListener("mouseover", function (e) {
        var link = e.target.closest("#adminmenu a.menu-top");
        if (!link) return;
        if (!document.body.classList.contains("folded") && !document.body.classList.contains("auto-fold")) return;
        showTooltip(link);
      });
      document.addEventListener("mouseout", function (e) {
        var link = e.target.closest("#adminmenu a.menu-top");
        if (!link) return;
        hideTooltip();
      });
      if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", ensureLogo);
      } else {
        ensureLogo();
      }
    })();
  </script>';
});

add_filter('admin_body_class', function ($classes) {
  if (!foleo_is_client_shell_context()) {
    return $classes;
  }
  return trim($classes . ' foleo-client-shell-active');
});

add_action('admin_init', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  if (function_exists('get_user_setting') && function_exists('set_user_setting')) {
    if (get_user_setting('mfold') !== 'f') {
      set_user_setting('mfold', 'f');
    }
  }

  global $pagenow;
  if ($pagenow === 'index.php') {
    wp_redirect(admin_url('edit.php?post_type=page'));
    exit;
  }
}, 20);

add_action('admin_print_footer_scripts', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  echo "<script>
  (function(){
    try {
      var notices = document.querySelectorAll('.notice');
      if (!notices || !notices.length) return;
      notices.forEach(function(notice){
        var text = (notice.textContent || '').toLowerCase();
        if (!text) return;
        if (text.indexOf('seo notice') !== -1 &&
            (text.indexOf('no index') !== -1 ||
             text.indexOf('noindex') !== -1 ||
             text.indexOf('search engine visibility') !== -1)) {
          notice.style.display = 'none';
        }
      });
    } catch(e) {}
  })();
  </script>";
});
