<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_admin_theme_schema_version() {
  return '1';
}

function foleo_admin_theme_required_tokens() {
  return array(
    'foleo-bg',
    'foleo-surface',
    'foleo-border',
    'foleo-text',
    'foleo-text-muted',
    'foleo-accent',
    'foleo-accent-contrast',
    'foleo-control-bg',
    'foleo-control-border',
    'foleo-control-text',
    'foleo-font-family',
    'foleo-font-size-base',
    'foleo-radius-sm',
  );
}

function foleo_admin_theme_default_tokens() {
  return array(
    'foleo-bg' => '#0f141a',
    'foleo-surface' => '#111827',
    'foleo-surface-2' => '#1f2937',
    'foleo-border' => '#1f2937',
    'foleo-border-subtle' => '#2b3441',
    'foleo-text' => '#e5e7eb',
    'foleo-text-muted' => '#9ca3af',
    'foleo-text-subtle' => '#6b7280',
    'foleo-heading' => '#ffffff',
    'foleo-accent' => '#2663eb',
    'foleo-accent-hover' => '#3b76ff',
    'foleo-accent-active' => '#1f55cc',
    'foleo-accent-contrast' => '#ffffff',
    'foleo-focus-ring' => '0 0 0 2px rgba(38, 99, 235, 0.35)',
    'foleo-control-bg' => '#0f172a',
    'foleo-control-bg-hover' => '#111c2f',
    'foleo-control-border' => '#1f2937',
    'foleo-control-border-focus' => '#2663eb',
    'foleo-control-text' => '#e5e7eb',
    'foleo-control-placeholder' => '#6b7280',
    'foleo-control-shadow' => 'none',
    'foleo-radius-sm' => '6px',
    'foleo-radius-md' => '10px',
    'foleo-radius-lg' => '14px',
    'foleo-shadow-panel' => '0 10px 30px rgba(0,0,0,0.35)',
    'foleo-shadow-overlay' => '0 18px 50px rgba(0,0,0,0.45)',
    'foleo-font-family' => 'Inter, system-ui, -apple-system, sans-serif',
    'foleo-font-size-sm' => '12px',
    'foleo-font-size-base' => '13px',
    'foleo-font-size-lg' => '15px',
    'foleo-font-weight-regular' => '400',
    'foleo-font-weight-semibold' => '600',
    'foleo-line-height' => '1.4',
    'foleo-space-1' => '4px',
    'foleo-space-2' => '8px',
    'foleo-space-3' => '12px',
    'foleo-space-4' => '16px',
    'foleo-overlay-bg' => '#111827',
    'foleo-overlay-border' => '#1f2937',
    'foleo-backdrop' => 'rgba(15, 23, 42, 0.7)',
  );
}

function foleo_admin_theme_compile_css_vars($tokens) {
  $pairs = array();
  foreach ($tokens as $key => $value) {
    if ($value === '' || $value === null) {
      continue;
    }
    $pairs[] = '--' . $key . ':' . $value . ';';
  }
  return implode('', $pairs);
}

function foleo_admin_theme_get_tokens() {
  $stored = get_option('foleo_admin_tokens_json', array());
  if (!is_array($stored)) {
    $stored = array();
  }
  $tokens = isset($stored['tokens']) && is_array($stored['tokens']) ? $stored['tokens'] : array();
  $defaults = foleo_admin_theme_default_tokens();
  return array_merge($defaults, $tokens);
}

function foleo_admin_theme_get_css_vars() {
  $stored = get_option('foleo_admin_tokens_css', '');
  if (is_string($stored) && $stored !== '') {
    return $stored;
  }
  return foleo_admin_theme_compile_css_vars(foleo_admin_theme_get_tokens());
}

add_action('admin_head', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  $tokens = foleo_admin_theme_get_tokens();
  $tokens['foleo-bg'] = '#f2f4f7';
  $tokens['foleo-text'] = '#0f172a';
  $tokens['foleo-accent'] = 'rgb(37, 99, 235)';
  $vars = foleo_admin_theme_compile_css_vars($tokens);
  if (!$vars) {
    return;
  }

  echo '<style>
    body.foleo-client-shell-active .foleo-admin-theme-scope {
      ' . esc_html($vars) . '
    }
    .foleo-compiler-theme {
      ' . esc_html($vars) . '
    }
  </style>';
});

add_action('admin_enqueue_scripts', function () {
  if (!foleo_is_client_shell_context()) {
    return;
  }

  wp_enqueue_style(
    'foleo-admin-client',
    foleo_core_asset_url('assets/css/admin-client.css'),
    array(),
    FOLEO_CORE_VERSION
  );
}, 20);

add_filter('admin_body_class', function ($classes) {
  if (!foleo_is_client_shell_context()) {
    return $classes;
  }
  return trim($classes . ' foleo-client-shell-active');
});

add_filter('body_class', function ($classes) {
  if (!foleo_client_shell_enabled()) {
    return $classes;
  }
  if (!foleo_is_compiler_request()) {
    return $classes;
  }
  if (!foleo_is_client_editor()) {
    return $classes;
  }
  $classes[] = 'foleo-client-shell-active';
  return $classes;
});

add_action('wp_head', function () {
  if (!foleo_client_shell_enabled()) {
    return;
  }
  if (!foleo_is_compiler_request()) {
    return;
  }
  $vars = foleo_admin_theme_get_css_vars();
  if (!$vars) {
    return;
  }
  echo '<style>
    .foleo-compiler-theme {
      ' . esc_html($vars) . '
    }
  </style>';
});

add_action('rest_api_init', function () {
  if (!foleo_client_shell_enabled()) {
    return;
  }

  register_rest_route('foleo/v1', '/admin-theme/capture', array(
    'methods' => WP_REST_Server::CREATABLE,
    'permission_callback' => function () {
      return current_user_can('manage_options');
    },
    'callback' => function (WP_REST_Request $request) {
      $payload = $request->get_json_params();
      if (!is_array($payload)) {
        return new WP_Error('foleo_theme_bad_payload', 'Invalid payload', array('status' => 400));
      }

      $tokens = isset($payload['tokens']) && is_array($payload['tokens']) ? $payload['tokens'] : array();
      $required = foleo_admin_theme_required_tokens();
      $missing = array();
      foreach ($required as $key) {
        if (!isset($tokens[$key]) || $tokens[$key] === '') {
          $missing[] = $key;
        }
      }
      if (!empty($missing)) {
        return new WP_Error('foleo_theme_missing_tokens', 'Missing required tokens', array('status' => 422, 'missing' => $missing));
      }

      $meta = array(
        'schema_version' => foleo_admin_theme_schema_version(),
        'captured_at' => current_time('mysql'),
        'token_checksum' => isset($payload['checksum']) ? sanitize_text_field($payload['checksum']) : '',
        'breakdance_version' => isset($payload['breakdance_version']) ? sanitize_text_field($payload['breakdance_version']) : '',
      );

      update_option('foleo_admin_tokens_json', array(
        'tokens' => $tokens,
        'meta' => $meta,
      ), false);

      $vars = isset($payload['css']) ? $payload['css'] : '';
      if (!is_string($vars) || $vars === '') {
        $vars = foleo_admin_theme_compile_css_vars(array_merge(foleo_admin_theme_default_tokens(), $tokens));
      }
      update_option('foleo_admin_tokens_css', $vars, false);

      return array('success' => true);
    }
  ));

  register_rest_route('foleo/v1', '/admin-theme/reset', array(
    'methods' => WP_REST_Server::CREATABLE,
    'permission_callback' => function () {
      return current_user_can('manage_options');
    },
    'callback' => function () {
      delete_option('foleo_admin_tokens_json');
      delete_option('foleo_admin_tokens_css');
      return array('success' => true);
    }
  ));
});

add_action('wp_enqueue_scripts', function () {
  if (!foleo_client_shell_enabled()) {
    return;
  }
  if (!foleo_is_compiler_request()) {
    return;
  }
  if (!current_user_can('manage_options')) {
    return;
  }
  if (empty($_GET['foleo_capture_theme'])) {
    return;
  }

  $post_id = foleo_get_compiler_post_id();
  if (!$post_id) {
    return;
  }

  wp_enqueue_script(
    'foleo-admin-theme-capture',
    foleo_core_asset_url('assets/js/admin-theme-capture.js'),
    array(),
    FOLEO_CORE_VERSION,
    true
  );

  wp_localize_script('foleo-admin-theme-capture', 'FOLEO_ADMIN_THEME_CAPTURE', array(
    'restUrl' => esc_url_raw(rest_url('foleo/v1/admin-theme/capture')),
    'nonce' => wp_create_nonce('wp_rest'),
    'returnUrl' => isset($_GET['foleo_capture_return']) ? esc_url_raw(wp_unslash($_GET['foleo_capture_return'])) : '',
    'schemaVersion' => foleo_admin_theme_schema_version(),
    'required' => foleo_admin_theme_required_tokens(),
    'defaults' => foleo_admin_theme_default_tokens()
  ));
});
