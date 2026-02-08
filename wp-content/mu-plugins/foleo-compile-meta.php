<?php
/**
 * Plugin Name: Foleo Compile Meta
 * Description: Registers compile-mode meta fields for hero content.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_compile_is_enabled() {
    if ( ! isset( $_GET['compile'] ) ) {
        return false;
    }
    $value = sanitize_text_field( wp_unslash( $_GET['compile'] ) );
    return $value === '1';
}

function foleo_compile_resolve_post_id() {
    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        $post_id = (int) get_option( 'page_on_front' );
    }
    return $post_id ? (int) $post_id : 0;
}

add_action( 'send_headers', function () {
    if ( ! foleo_compile_is_enabled() ) {
        return;
    }

    $post_id = foleo_compile_resolve_post_id();
    $logged_in = is_user_logged_in();
    $can_edit = $post_id ? current_user_can( 'edit_post', $post_id ) : false;

    header( 'X-Foleo-Compile-MU: 1' );
    header( 'X-Foleo-Compile-LoggedIn: ' . ( $logged_in ? '1' : '0' ) );
    header( 'X-Foleo-Compile-PostId: ' . ( $post_id ? (string) $post_id : '0' ) );
    header( 'X-Foleo-Compile-CanEdit: ' . ( $can_edit ? '1' : '0' ) );
}, 0 );

add_action( 'after_setup_theme', function () {
    if ( ! foleo_compile_is_enabled() ) {
        return;
    }
    if ( current_user_can( 'manage_options' ) ) {
        return;
    }
    add_filter( 'show_admin_bar', '__return_false', 99 );
}, 0 );

add_action( 'init', function () {
    $auth_callback = function ( $allowed, $meta_key, $post_id ) {
        return current_user_can( 'edit_post', $post_id );
    };

    register_post_meta( 'page', 'foleo_hero_gallery1_header', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => $auth_callback,
    ] );

    register_post_meta( 'page', 'foleo_hero_gallery1_body', [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_textarea_field',
        'auth_callback'     => $auth_callback,
    ] );
} );

function foleo_compile_output_rest_nonce() {
    static $printed = false;
    if ( $printed ) {
        return;
    }
    if ( ! is_user_logged_in() ) {
        return;
    }

    if ( ! foleo_compile_is_enabled() ) {
        return;
    }

    echo "<!-- compile meta plugin loaded -->\n";

    $post_id = foleo_compile_resolve_post_id();
    if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $nonce = wp_create_nonce( 'wp_rest' );
    echo '<meta name="wp-rest-nonce" content="' . esc_attr( $nonce ) . '">' . "\n";
    echo '<script>window.wpApiSettings = window.wpApiSettings || {}; window.wpApiSettings.nonce ||= "' . esc_js( $nonce ) . '";</script>' . "\n";
    if ( current_user_can( 'manage_options' ) ) {
        echo '<script>window.FOLEO_COMPILE_IS_ADMIN = 1;</script>' . "\n";
    }
    header( 'X-Foleo-Compile-Nonce: emitted' );
    $printed = true;
}

add_action( 'wp_head', 'foleo_compile_output_rest_nonce', 5 );
add_action( 'wp_footer', 'foleo_compile_output_rest_nonce', 5 );
