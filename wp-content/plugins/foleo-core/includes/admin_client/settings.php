<?php

if (!defined('ABSPATH')) {
  exit;
}

add_action('admin_menu', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  add_submenu_page(
    'index.php',
    'FOLEO Settings',
    'Settings',
    'edit_posts',
    'foleo-settings',
    'foleo_render_settings_page'
  );
}, 999);

add_action('admin_menu', function () {
  if (!current_user_can('manage_options')) {
    return;
  }
  if (!foleo_client_shell_enabled()) {
    return;
  }
  add_submenu_page(
    null,
    'FOLEO Settings',
    'FOLEO Settings',
    'manage_options',
    'foleo-settings',
    'foleo_render_settings_page'
  );
}, 1000);

function foleo_render_settings_page() {
  if (!foleo_is_client_shell_context() && !current_user_can('manage_options')) {
    return;
  }

  echo '<div class="wrap foleo-admin-theme-scope">';
  echo '<h1>FOLEO Settings (coming soon)</h1>';
  echo '<p>Binder/Profile configuration will live here.</p>';

  if (foleo_client_shell_enabled() && current_user_can('manage_options')) {
    $rest_url = esc_url_raw(rest_url('foleo/v1/admin-theme/capture'));
    $reset_url = esc_url_raw(rest_url('foleo/v1/admin-theme/reset'));
    $nonce = wp_create_nonce('wp_rest');
    $return = esc_url(admin_url('admin.php?page=foleo-settings'));
    echo '<hr />';
    echo '<h2>Admin Theme</h2>';
    echo '<p>Capture a Breakdance snapshot to theme FOLEO UI.</p>';
    echo '<label for="foleo-theme-post-id">Builder Page ID</label><br />';
    echo '<input id="foleo-theme-post-id" type="number" min="1" style="width:160px; margin: 6px 0;" />';
    echo '<div style="margin-top:8px;">';
    echo '<button class="button button-primary" id="foleo-theme-capture">Capture Admin Theme from Builder</button> ';
    echo '<button class="button" id="foleo-theme-reset">Reset to FOLEO Defaults</button>';
    echo '</div>';
    echo '<p id="foleo-theme-status" style="margin-top:8px;"></p>';
    echo '<script>
      (function(){
        var captureBtn = document.getElementById("foleo-theme-capture");
        var resetBtn = document.getElementById("foleo-theme-reset");
        var postIdEl = document.getElementById("foleo-theme-post-id");
        var statusEl = document.getElementById("foleo-theme-status");
        var restUrl = "' . esc_js($rest_url) . '";
        var resetUrl = "' . esc_js($reset_url) . '";
        var nonce = "' . esc_js($nonce) . '";
        var returnUrl = "' . esc_js($return) . '";

        function setStatus(msg) {
          if (statusEl) statusEl.textContent = msg || "";
        }

        if (captureBtn) {
          captureBtn.addEventListener("click", function(e){
            e.preventDefault();
            var id = parseInt(postIdEl.value || "0", 10);
            if (!id) {
              setStatus("Enter a valid Page ID.");
              return;
            }
            var url = "' . esc_js(home_url('/compiler/')) . '" + id + "?foleo_capture_theme=1&foleo_capture_return=" + encodeURIComponent(returnUrl);
            window.open(url, "_blank");
            setStatus("Builder opened for capture.");
          });
        }

        if (resetBtn) {
          resetBtn.addEventListener("click", function(e){
            e.preventDefault();
            setStatus("Resetting...");
            fetch(resetUrl, {
              method: "POST",
              credentials: "same-origin",
              headers: { "Content-Type": "application/json", "X-WP-Nonce": nonce }
            })
              .then(function(res){ return res.json(); })
              .then(function(){ setStatus("Reset to defaults."); })
              .catch(function(){ setStatus("Reset failed."); });
          });
        }
      })();
    </script>';
  }
  echo '</div>';
}
