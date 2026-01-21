<?php
/**
 * MU Plugin: Suppress response cookies on /cx/ so Cloudflare can cache HTML.
 */

add_action('send_headers', function () {
    // Only front-end GET/HEAD requests.
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    if ($method !== 'GET' && $method !== 'HEAD') return;

    // Only /cx/ path.
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    if (strpos($uri, '/cx/') !== 0) return;

    // Never interfere with wp-admin, previews, or logged-in sessions.
    if (strpos($uri, '/wp-admin') === 0) return;

    // If the user is logged in, do not strip cookies (safety).
    foreach ($_COOKIE as $name => $value) {
        if (strpos($name, 'wordpress_logged_in_') === 0) return;
        if (strpos($name, 'wordpress_sec_') === 0) return;
    }

    // If a PHP session is active, close it to avoid session cookies.
    if (function_exists('session_status') && session_status() === PHP_SESSION_ACTIVE) {
        @session_write_close();
    }

    // Remove all Set-Cookie headers for this response.
    header_remove('Set-Cookie');
}, 9999);

add_action('shutdown', function () {
    if (headers_sent()) return;

    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    if (strpos($uri, '/cx/') !== 0) return;

    header_remove('Set-Cookie');
}, 0);