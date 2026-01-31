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
    $post_id = is_singular( 'page' ) ? get_queried_object_id() : 0;
    $flags   = $post_id ? get_post_meta( $post_id, 'foleo_page_flags', true ) : null;
    if ( is_string( $flags ) ) {
        $decoded = json_decode( $flags, true );
        $flags   = is_array( $decoded ) ? $decoded : null;
    }
    $has_flags = is_array( $flags ) && ! empty( $flags );

    /**
     * 1) CORE: always on everywhere
     * Add Body.js here since you just created it.
     */
    $core_assets = [
        'Body.css',
        'Foleo_Modules.css',
        'Graphic_Elements.css',
        'Body.js',
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
        'catalyst.foleo.co',
        // 'huronperformance.foleo.co',
    ];

    $lottie_assets = [
        'Lenis_Lottie.css',
        'Lottie_Inject.js',
        'Lottie_Global.js',
    ];

    // Enqueue core everywhere
    foleo_enqueue_asset_files( $core_assets );

    if ( $has_flags ) {
        if ( ! empty( $flags['tabs_enabled'] ) ) {
            foleo_enqueue_asset_files( [ 'Tabs.css', 'Tabs.js' ] );
        }
        if ( ! empty( $flags['tabs_mobile_enabled'] ) ) {
            foleo_enqueue_asset_files( [ 'Tabs_Mobile.css', 'Tabs_Mobile.js' ] );
        }
        if ( ! empty( $flags['lottie_enabled'] ) ) {
            foleo_enqueue_asset_files( $lottie_assets );
        }
        if ( ! empty( $flags['snapScroll_enabled'] ) ) {
            foleo_enqueue_asset_files( [ 'SnapScroll.js' ] );
        }
        if ( ! empty( $flags['dynamicTable_enabled'] ) || ! empty( $flags['videoBug_enabled'] ) ) {
            foleo_enqueue_asset_files( [ 'Foleo_Modules.js' ] );
        }
    } else {
        // Enqueue Tabs only where allowed
        if ( in_array( $host, $tabs_allow_hosts, true ) ) {
            foleo_enqueue_asset_files( $tabs_assets );
        }

        // Enqueue Lottie only where allowed
        if ( in_array( $host, $lottie_allow_hosts, true ) ) {
            foleo_enqueue_asset_files( $lottie_assets );
        }

        // Legacy defaults
        foleo_enqueue_asset_files( [ 'Foleo_Modules.js', 'SnapScroll.js' ] );
    }

}, 100 );
