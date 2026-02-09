<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_is_pages_list_screen($hook_suffix = '') {
  if (!is_admin()) {
    return false;
  }

  if ($hook_suffix && $hook_suffix !== 'edit.php') {
    return false;
  }

  if (function_exists('get_current_screen')) {
    $screen = get_current_screen();
    if ($screen && $screen->base === 'edit' && $screen->post_type === 'page') {
      return true;
    }
  }

  global $pagenow;
  if ($pagenow !== 'edit.php') {
    return false;
  }
  return isset($_GET['post_type']) && $_GET['post_type'] === 'page';
}

function foleo_can_manage_search_visibility() {
  if (!is_user_logged_in()) {
    return false;
  }
  return foleo_is_client_editor() || foleo_is_admin_user();
}

function foleo_get_seo_master_visibility() {
  $value = get_option('foleo_seo_master_visibility', '');
  if ($value === 'on' || $value === 'off') {
    return $value;
  }
  return get_option('blog_public', 1) ? 'on' : 'off';
}

function foleo_get_seo_scope_params() {
  $allowed = array(
    'post_status',
    's',
    'author',
    'm',
    'orderby',
    'order',
    'paged',
    'posts_per_page',
  );
  $scope = array();
  foreach ($allowed as $key) {
    if (!isset($_GET[$key])) {
      continue;
    }
    $value = wp_unslash($_GET[$key]);
    if ($key === 'author' || $key === 'paged' || $key === 'posts_per_page' || $key === 'm') {
      $scope[$key] = absint($value);
      continue;
    }
    $scope[$key] = sanitize_text_field($value);
  }
  return $scope;
}

add_action('rest_api_init', function () {
  if (!foleo_client_shell_enabled()) {
    return;
  }
  register_rest_route('foleo/v1', '/seo/master', array(
    'methods' => WP_REST_Server::CREATABLE,
    'permission_callback' => 'foleo_can_manage_search_visibility',
    'args' => array(
      'value' => array(
        'type' => 'string',
        'required' => true,
      ),
      'bulk_noindex_pages' => array(
        'type' => 'boolean',
        'required' => false,
      ),
      'scope' => array(
        'type' => 'object',
        'required' => false,
      ),
    ),
    'callback' => function ($request) {
      $value = $request->get_param('value') === 'off' ? 'off' : 'on';
      update_option('foleo_seo_master_visibility', $value);
      update_option('blog_public', $value === 'on' ? '1' : '0');
      $updated = 0;

      if ($request->get_param('bulk_noindex_pages')) {
        $scope = (array) $request->get_param('scope');
        $query_args = array(
          'post_type' => 'page',
          'post_status' => 'any',
          'fields' => 'ids',
          'numberposts' => -1,
          'no_found_rows' => true,
          'orderby' => 'date',
          'order' => 'DESC',
        );
        if (!empty($scope['post_status'])) {
          $query_args['post_status'] = $scope['post_status'];
        }
        if (!empty($scope['s'])) {
          $query_args['s'] = $scope['s'];
        }
        if (!empty($scope['author'])) {
          $query_args['author'] = absint($scope['author']);
        }
        if (!empty($scope['m'])) {
          $query_args['m'] = absint($scope['m']);
        }
        if (!empty($scope['orderby'])) {
          $query_args['orderby'] = $scope['orderby'];
        }
        if (!empty($scope['order'])) {
          $query_args['order'] = strtoupper($scope['order']) === 'ASC' ? 'ASC' : 'DESC';
        }
        $page_ids = get_posts($query_args);
        foreach ($page_ids as $page_id) {
          update_post_meta($page_id, 'foleo_seo_visibility', $value);
          $updated++;
        }
      }

      return array(
        'value' => $value,
        'updated' => $updated,
      );
    },
  ));

  register_rest_route('foleo/v1', '/seo/page/(?P<id>\\d+)', array(
    'methods' => WP_REST_Server::CREATABLE,
    'permission_callback' => function ($request) {
      $post_id = absint($request['id']);
      if (!$post_id) {
        return false;
      }
      return current_user_can('edit_post', $post_id);
    },
    'args' => array(
      'value' => array(
        'type' => 'string',
        'required' => true,
      ),
    ),
    'callback' => function ($request) {
      $post_id = absint($request['id']);
      $value = $request->get_param('value') === 'off' ? 'off' : 'on';
      update_post_meta($post_id, 'foleo_seo_visibility', $value);
      return array(
        'post_id' => $post_id,
        'value' => $value,
      );
    },
  ));
});

add_action('admin_enqueue_scripts', function ($hook_suffix) {
  if (!foleo_is_client_shell_context()) {
    return;
  }
  if (!foleo_is_pages_list_screen($hook_suffix)) {
    return;
  }

  wp_enqueue_script(
    'foleo-search-visibility',
    foleo_core_asset_url('assets/js/search-visibility.js'),
    array(),
    FOLEO_CORE_VERSION,
    true
  );

  wp_localize_script(
    'foleo-search-visibility',
    'FOLEO_SEARCH_VISIBILITY',
    array(
      'restUrl' => esc_url_raw(rest_url('foleo/v1/seo/master')),
      'pageRestUrl' => esc_url_raw(rest_url('foleo/v1/seo/page/')),
      'nonce' => wp_create_nonce('wp_rest'),
      'state' => foleo_get_seo_master_visibility(),
      'scope' => foleo_get_seo_scope_params(),
    )
  );

  wp_enqueue_style(
    'foleo-search-visibility',
    foleo_core_asset_url('assets/css/search-visibility.css'),
    array(),
    FOLEO_CORE_VERSION
  );
}, 20);

add_filter('manage_edit-page_columns', function ($columns) {
  if (!foleo_is_client_shell_context()) {
    return $columns;
  }
  $state = foleo_get_seo_master_visibility();
  $columns['foleo_seo_visibility'] =
    '<div class="foleo-seo-master-wrap foleo-admin-theme-scope">' .
    '<div class="foleo-seo-master-title">Search Visibility</div>' .
    '<label class="foleo-seo-master">' .
    '<span class="foleo-seo-label foleo-seo-label--left" data-foleo-seo-label-left="1">All on</span>' .
    '<input type="checkbox" data-foleo-seo-master="1" ' . checked('on', $state, false) . ' />' .
    '<span class="foleo-seo-label foleo-seo-label--right" data-foleo-seo-label-right="1">All off</span>' .
    '</label>' .
    '</div>';
  if (isset($columns['rank_math_seo_details'])) {
    unset($columns['rank_math_seo_details']);
  }
  if (isset($columns['rank_math_seo_score'])) {
    unset($columns['rank_math_seo_score']);
  }
  return $columns;
});

function foleo_render_seo_visibility_cell($column, $post_id) {
  if ($column !== 'foleo_seo_visibility') {
    return;
  }
  if (!foleo_is_client_shell_context()) {
    return;
  }
  static $rendered = array();
  if (isset($rendered[$post_id])) {
    return;
  }
  $rendered[$post_id] = true;
  $master = foleo_get_seo_master_visibility();
  $value = get_post_meta($post_id, 'foleo_seo_visibility', true);
  if ($value !== 'off') {
    $value = 'on';
  }
  if ($master === 'off') {
    $value = 'off';
  }
  echo '<label class="foleo-seo-toggle foleo-admin-theme-scope">';
  echo '<span class="foleo-seo-label foleo-seo-label--left" data-foleo-seo-label-left="1">On</span>';
  echo '<input type="checkbox" data-foleo-seo-toggle="1" data-post-id="' . esc_attr($post_id) . '" ' . checked('on', $value, false) . ' />';
  echo '<span class="foleo-seo-label foleo-seo-label--right" data-foleo-seo-label-right="1">Off</span>';
  echo '</label>';
}

add_action('manage_pages_custom_column', 'foleo_render_seo_visibility_cell', 10, 2);
