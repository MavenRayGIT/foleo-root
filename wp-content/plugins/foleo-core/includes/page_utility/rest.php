<?php

if (!defined('ABSPATH')) {
  exit;
}

function foleo_compiler_allowed_meta_keys() {
  $keys = array(
    'foleo_fade_img_1',
    'foleo_fade_img_2',
    'foleo_fade_img_3',
    'foleo_cf_stream_id',
    'foleo_poster'
  );
  return apply_filters('foleo_compiler_allowed_meta_keys', $keys);
}

function foleo_compiler_verify_rest_request($request, $post_id) {
  if (!is_user_logged_in()) {
    return new WP_Error('foleo_rest_not_logged_in', 'Unauthorized', array('status' => 401));
  }

  $nonce = $request->get_header('X-WP-Nonce');
  if (!$nonce || !wp_verify_nonce($nonce, 'wp_rest')) {
    return new WP_Error('foleo_rest_bad_nonce', 'Invalid nonce', array('status' => 403));
  }

  if (!current_user_can('edit_post', $post_id)) {
    return new WP_Error('foleo_rest_forbidden', 'Forbidden', array('status' => 403));
  }

  return true;
}

add_action('rest_api_init', function () {
  register_rest_route('foleo/v1', '/page/(?P<id>\d+)', array(
    array(
      'methods' => 'GET',
      'callback' => function (WP_REST_Request $request) {
        $post_id = absint($request['id']);
        if (!$post_id) {
          return new WP_Error('foleo_rest_bad_id', 'Invalid post ID', array('status' => 400));
        }

        $permission = foleo_compiler_verify_rest_request($request, $post_id);
        if (is_wp_error($permission)) {
          return $permission;
        }

        $post = get_post($post_id);
        if (!$post) {
          return new WP_Error('foleo_rest_not_found', 'Not found', array('status' => 404));
        }

        $thumb_id = get_post_thumbnail_id($post_id);
        $thumb_url = $thumb_id ? wp_get_attachment_url($thumb_id) : '';

        $meta = array();
        foreach (foleo_compiler_allowed_meta_keys() as $key) {
          $meta[$key] = get_post_meta($post_id, $key, true);
        }

        return array(
          'id' => $post_id,
          'title' => get_the_title($post_id),
          'slug' => $post->post_name,
          'status' => $post->post_status,
          'thumbnail' => array(
            'id' => $thumb_id,
            'url' => $thumb_url
          ),
          'meta' => $meta
        );
      },
      'permission_callback' => '__return_true'
    ),
    array(
      'methods' => 'POST',
      'callback' => function (WP_REST_Request $request) {
        $post_id = absint($request['id']);
        if (!$post_id) {
          return new WP_Error('foleo_rest_bad_id', 'Invalid post ID', array('status' => 400));
        }

        $permission = foleo_compiler_verify_rest_request($request, $post_id);
        if (is_wp_error($permission)) {
          return $permission;
        }

        $post = get_post($post_id);
        if (!$post) {
          return new WP_Error('foleo_rest_not_found', 'Not found', array('status' => 404));
        }

        $payload = $request->get_json_params();
        if (!is_array($payload)) {
          $payload = $request->get_body_params();
        }

        $update = array('ID' => $post_id);
        if (isset($payload['title'])) {
          $update['post_title'] = sanitize_text_field($payload['title']);
        }
        if (isset($payload['slug'])) {
          $update['post_name'] = sanitize_title($payload['slug']);
        }
        if (isset($payload['status'])) {
          $status = sanitize_key($payload['status']);
          if (in_array($status, array('draft', 'publish'), true)) {
            $update['post_status'] = $status;
          }
        }

        if (count($update) > 1) {
          $result = wp_update_post($update, true);
          if (is_wp_error($result)) {
            return $result;
          }
        }

        if (array_key_exists('thumbnail_id', $payload)) {
          $thumb_id = absint($payload['thumbnail_id']);
          if ($thumb_id > 0) {
            set_post_thumbnail($post_id, $thumb_id);
          } else {
            delete_post_thumbnail($post_id);
          }
        }

        if (isset($payload['meta']) && is_array($payload['meta'])) {
          $allowed = foleo_compiler_allowed_meta_keys();
          foreach ($payload['meta'] as $key => $value) {
            if (!in_array($key, $allowed, true)) {
              continue;
            }
            update_post_meta($post_id, $key, sanitize_text_field($value));
          }
        }

        return array('success' => true);
      },
      'permission_callback' => '__return_true'
    )
  ));
});
