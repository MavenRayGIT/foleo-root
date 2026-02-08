<?php

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('foleo_is_client_editor')) {
  function foleo_is_client_editor() {
    return current_user_can('edit_posts') && !current_user_can('manage_options');
  }
}

if (!function_exists('foleo_is_admin_user')) {
  function foleo_is_admin_user() {
    return current_user_can('manage_options');
  }
}
