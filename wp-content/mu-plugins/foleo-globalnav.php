<?php
/*
Plugin Name: Foleo Global Nav Include
*/

add_shortcode('foleo_globalnav', function () {
  $file = WP_CONTENT_DIR . '/uploads/foleo/globalnav.html'; // change path
  if (!file_exists($file)) return '';
  return file_get_contents($file);
});