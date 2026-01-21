<?php
/*
Plugin Name: Foleo Nav State
Description: Server-first nav state resolver for binder vs standalone.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_nav_binder_config() {
    $config_path = __DIR__ . '/foleo-binder-config.php';
    if ( file_exists( $config_path ) ) {
        $binders = require $config_path;
        if ( is_array( $binders ) ) {
            return $binders;
        }
    }

    return [
        'cx-pitch' => [ 'label' => 'CX + Pitch', 'pages' => [ 'cx', 'pitch' ] ],
        'tofu-cx'  => [ 'label' => 'TOFU + CX',  'pages' => [ 'tofu', 'cx' ] ],
    ];
}

function foleo_nav_active_slug() {
    global $wp;

    if ( isset( $wp ) && is_object( $wp ) && isset( $wp->request ) ) {
        $path = $wp->request;
    } else {
        $url  = home_url( add_query_arg( [] ) );
        $info = wp_parse_url( $url );
        $path = $info['path'] ?? '';
    }

    $path = trim( $path, '/' );
    if ( $path === '' ) {
        return '';
    }

    $parts = explode( '/', $path );
    return end( $parts );
}

function foleo_resolve_nav_state() {
    static $state = null;
    if ( $state !== null ) {
        return $state;
    }

    $binders = foleo_nav_binder_config();

    $standalone = isset( $_GET['standalone'] ) && (string) $_GET['standalone'] === '1';
    $binder_id  = isset( $_GET['binder'] ) ? sanitize_key( wp_unslash( $_GET['binder'] ) ) : '';

    if ( $standalone ) {
        $state = [ 'mode' => 'standalone' ];
        return $state;
    }

    if ( $binder_id && isset( $binders[ $binder_id ] ) ) {
        $active_slug = foleo_nav_active_slug();
        $pages       = $binders[ $binder_id ]['pages'] ?? [];
        if ( ! in_array( $active_slug, $pages, true ) ) {
            $active_slug = '';
        }

        $state = [
            'mode'        => 'binder',
            'binderId'    => $binder_id,
            'binderLabel' => $binders[ $binder_id ]['label'] ?? '',
            'pages'       => array_values( $pages ),
            'activeSlug'  => $active_slug,
        ];

        return $state;
    }

    $state = [ 'mode' => 'standalone' ];
    return $state;
}

function foleo_print_nav_state() {
    $state = foleo_resolve_nav_state();
    $json  = wp_json_encode( $state, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    if ( ! $json ) {
        $json = '{"mode":"standalone"}';
    }

    $b64 = base64_encode( $json );

    echo "\n<!-- FOLEO_NAV_STATE_META_TEST -->\n";
    echo '<meta name="foleo-nav-state" content="' . esc_attr( $b64 ) . '">' . "\n";
    echo '<script id="foleo-nav-state" type="application/json">' . $json . '</script>' . "\n";
}

function foleo_print_vidstack_assets() {
    echo '<link rel="stylesheet" href="https://cdn.vidstack.io/player/theme.css">' . "\n";
    echo '<link rel="stylesheet" href="https://cdn.vidstack.io/player/video.css">' . "\n";
    echo '<script type="module" src="https://cdn.vidstack.io/player"></script>' . "\n";
}

add_action( 'wp_head', 'foleo_print_nav_state', 1 );
add_action( 'wp_head', 'foleo_print_vidstack_assets', 5 );

function foleo_nav_body_class( $classes ) {
    $state = foleo_resolve_nav_state();
    $mode  = $state['mode'] ?? 'standalone';

    if ( $mode === 'binder' ) {
        $classes[] = 'foleo-mode-binder';
    } else {
        $classes[] = 'foleo-mode-standalone';
    }

    return $classes;
}

add_filter( 'body_class', 'foleo_nav_body_class' );
