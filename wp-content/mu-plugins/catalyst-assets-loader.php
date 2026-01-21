<?php
/**
 * Plugin Name: Catalyst Assets Loader
 * Description: Enqueue Catalyst CSS/JS from /wp-content/assets/catalyst/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_catalyst_assets_base_dir() {
    return WP_CONTENT_DIR . '/assets/catalyst/';
}

function foleo_catalyst_assets_base_url() {
    return content_url( '/assets/catalyst/' );
}

function foleo_current_host() {
    return isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
}

/**
 * Enqueue a list of asset files from /wp-content/assets/catalyst/
 */
function foleo_enqueue_asset_files( array $files ) {

    $base_dir = foleo_catalyst_assets_base_dir();
    $base_url = foleo_catalyst_assets_base_url();

    foreach ( $files as $file ) {

        $path = $base_dir . $file;

        if ( ! file_exists( $path ) ) {
            continue;
        }

        $ver    = filemtime( $path );
        $handle = 'catalyst-' . sanitize_key( pathinfo( $file, PATHINFO_FILENAME ) );

        $is_css = ( substr( $file, -4 ) === '.css' );
        $is_js  = ( substr( $file, -3 ) === '.js' );

        if ( $is_css ) {
            wp_enqueue_style(
                $handle,
                $base_url . $file,
                [],
                $ver
            );
        } elseif ( $is_js ) {
            wp_enqueue_script(
                $handle,
                $base_url . $file,
                [],
                $ver,
                true
            );
        }
    }
}

add_action( 'wp_enqueue_scripts', function () {

    $host = foleo_current_host();

    /**
     * 1) CORE: always on everywhere
     * Add Body.js here since you just created it.
     */
    $core_assets = [
        'Body.css',
        'Graphic_Elements.css',
        'Body.js',
        'Foleo_Modules.js',
        'SnapScroll.js',
    ];

    /**
     * 2) TABS BUNDLE: only on selected sites
     */
    $tabs_allow_hosts = [
        'catalyst.foleo.co',
        // 'another-site.foleo.co',
    ];

    $tabs_assets = [
        'Tabs.css',
        'Tabs_Mobile.css',
        'Tabs.js',
        'Tabs_Mobile.js',
    ];

    /**
     * 3) LOTTIE BUNDLE: only on selected sites
     * This is where Lenis lives today (inside your Lottie/Lenis files),
     * so controlling this allowlist controls Lenis too.
     */
    $lottie_allow_hosts = [
        // 'catalyst.foleo.co',
        // 'huronperformance.foleo.co',
    ];

    $lottie_assets = [
        'Lenis_Lottie.css',
        'Lottie_Global.js',
        'Lottie_Inject.js',
    ];

    // Enqueue core everywhere
    foleo_enqueue_asset_files( $core_assets );

    // Enqueue Tabs only where allowed
    if ( in_array( $host, $tabs_allow_hosts, true ) ) {
        foleo_enqueue_asset_files( $tabs_assets );
    }

    // Enqueue Lottie only where allowed
    if ( in_array( $host, $lottie_allow_hosts, true ) ) {
        foleo_enqueue_asset_files( $lottie_assets );
    }

}, 100 );
