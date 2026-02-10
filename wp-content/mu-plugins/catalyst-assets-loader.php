<?php
/**
 * Plugin Name: Catalyst Assets Loader
 * Description: Enqueue core assets from /wp-content/assets/_core/ with per-site overrides.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_assets_debug_enabled() {
    return defined( 'FOLEO_DEBUG' ) && FOLEO_DEBUG;
}

function foleo_assets_log( $message ) {
    if ( ! foleo_assets_debug_enabled() ) {
        return;
    }
    error_log( '[foleo-assets] ' . $message );
}

function foleo_sanitize_namespace_slug( $slug ) {
    $slug = strtolower( (string) $slug );
    $slug = preg_replace( '/[^a-z0-9-]+/', '-', $slug );
    $slug = trim( $slug, '-' );
    if ( strlen( $slug ) > 32 ) {
        $slug = substr( $slug, 0, 32 );
        $slug = rtrim( $slug, '-' );
    }
    return $slug !== '' ? $slug : 'catalyst';
}

function foleo_derive_namespace_from_host() {
    $host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
    $slug = '';
    if ( $host !== '' && substr( $host, -9 ) === '.foleo.co' ) {
        $parts = explode( '.', $host );
        if ( ! empty( $parts[0] ) && $parts[0] !== 'www' ) {
            $slug = $parts[0];
        }
    }
    if ( $slug === '' ) {
        $slug = 'site-' . get_current_blog_id();
    }
    return foleo_sanitize_namespace_slug( $slug );
}

function foleo_assets_provision_namespace( $namespace ) {
    if ( $namespace === 'catalyst' ) {
        return true;
    }
    $dest_dir = WP_CONTENT_DIR . '/assets/' . $namespace;

    if ( is_dir( $dest_dir ) ) {
        return true;
    }

    foleo_assets_log( 'Provisioning assets namespace: ' . $namespace );
    if ( ! wp_mkdir_p( $dest_dir ) ) {
        foleo_assets_log( 'Provisioning failed, could not create: ' . $dest_dir );
        return false;
    }

    $nav_path = $dest_dir . '/nav-registry.json';
    if ( ! file_exists( $nav_path ) ) {
        file_put_contents( $nav_path, "{}\n" );
    }

    $brand_path = $dest_dir . '/Brand.css';
    if ( ! file_exists( $brand_path ) ) {
        file_put_contents( $brand_path, "/* Brand overrides */\n" );
    }

    $theme_css_path = $dest_dir . '/Theme.css';
    if ( ! file_exists( $theme_css_path ) ) {
        file_put_contents( $theme_css_path, "/* Theme overrides */\n" );
    }

    $theme_js_path = $dest_dir . '/Theme.js';
    if ( ! file_exists( $theme_js_path ) ) {
        file_put_contents( $theme_js_path, "/* Theme overrides */\n" );
    }

    return true;
}

function foleo_get_assets_namespace( $blog_id = null ) {
    $blog_id = $blog_id ? (int) $blog_id : get_current_blog_id();
    $namespace = get_blog_option( $blog_id, 'foleo_assets_namespace' );
    $namespace = is_string( $namespace ) ? trim( $namespace ) : '';
    if ( $namespace !== '' ) {
        return $namespace;
    }

    $derived = foleo_derive_namespace_from_host();
    if ( $derived === 'catalyst' ) {
        return 'catalyst';
    }

    if ( foleo_assets_provision_namespace( $derived ) ) {
        update_blog_option( $blog_id, 'foleo_assets_namespace', $derived );
        return $derived;
    }

    foleo_assets_log( 'Provisioning failed, falling back to catalyst.' );
    return 'catalyst';
}

function foleo_assets_base_dir( $namespace ) {
    return WP_CONTENT_DIR . '/assets/' . $namespace . '/';
}

function foleo_assets_base_url( $namespace ) {
    return content_url( '/assets/' . $namespace . '/' );
}

function foleo_core_base_dir() {
    return WP_CONTENT_DIR . '/assets/_core/';
}

function foleo_core_base_url() {
    return content_url( '/assets/_core/' );
}

function foleo_current_host() {
    return isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
}

/**
 * Enqueue a list of asset files from /wp-content/assets/{namespace}/
 */
function foleo_enqueue_asset_files( array $files, $namespace = null ) {

    $namespace = $namespace ? $namespace : foleo_get_assets_namespace();
    $base_dir = foleo_assets_base_dir( $namespace );
    $base_url = foleo_assets_base_url( $namespace );

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

function foleo_enqueue_core_files( array $files ) {
    $base_dir = foleo_core_base_dir();
    $base_url = foleo_core_base_url();

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
    $is_compiler = ( get_query_var( 'foleo_compiler' ) === '1' );
    $is_builder = isset( $_GET['breakdance'] ) && $_GET['breakdance'] === 'builder';
    $is_iframe = isset( $_GET['breakdance_iframe'] );
    $is_builder_context = ( $is_compiler || $is_builder || $is_iframe );
    $is_builder_shell = ( $is_builder_context && ! $is_iframe );

    if ( $is_builder_context ) {
        $can_edit = current_user_can( 'edit_posts' );
        $can_controls = current_user_can( 'manage_options' );
        wp_register_script( 'foleo-edit-preview-flags', '', [], null, true );
        wp_enqueue_script( 'foleo-edit-preview-flags' );
        $inline = 'window.FOLEO_EDIT_PREVIEW=' . ( $can_edit ? 'true' : 'false' ) . ';';
        $inline .= 'window.FOLEO_EDIT_PREVIEW_CONTROLS=' . ( $can_controls ? 'true' : 'false' ) . ';';
        $inline .= 'window.FOLEO_DISABLE_SCROLLTRIGGER=true;';
        wp_add_inline_script( 'foleo-edit-preview-flags', $inline, 'before' );
    }

    $namespace = foleo_get_assets_namespace();
    $host = foleo_current_host();
    $post_id = is_singular( 'page' ) ? get_queried_object_id() : 0;
    $active_doc_id = 0;
    if ( isset( $_GET['breakdance_iframe'], $_GET['breakdance_open_document'] ) && is_numeric( $_GET['breakdance_open_document'] ) ) {
        $active_doc_id = (int) $_GET['breakdance_open_document'];
    } elseif ( isset( $_GET['breakdance'] ) && $_GET['breakdance'] === 'builder' && isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) {
        $active_doc_id = (int) $_GET['id'];
    } else {
        $active_doc_id = $post_id;
    }
    // Config -> flags on save -> conditional enqueue on view.
    $flags   = $active_doc_id ? get_post_meta( $active_doc_id, 'foleo_page_flags', true ) : null;
    if ( is_string( $flags ) ) {
        $decoded = json_decode( $flags, true );
        $flags   = is_array( $decoded ) ? $decoded : null;
    }
    $has_flags = is_array( $flags ) && ! empty( $flags );

    if ( ! $is_builder_shell ) {
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

        $chart_assets = [
            'third_party/chartjs/chart.umd.min.js',
            'Charts.css',
            'Charts.js',
        ];

        // Enqueue core everywhere (from _core)
        foleo_enqueue_core_files( $core_assets );

        // Expose namespace for JS consumers (nav registry, etc).
        $body_handle = 'catalyst-body';
        if ( wp_script_is( $body_handle, 'enqueued' ) ) {
            $base_url = foleo_assets_base_url( $namespace );
            $inline = 'window.FOLEO_ASSETS_NAMESPACE=' . wp_json_encode( $namespace ) . ';';
            $inline .= 'window.FOLEO_ASSETS_BASE_URL=' . wp_json_encode( $base_url ) . ';';
            wp_add_inline_script( $body_handle, $inline, 'before' );
        }

        if ( $has_flags ) {
            if ( ! empty( $flags['charts_enabled'] ) ) {
                foleo_enqueue_core_files( $chart_assets );
            }
            if ( ! empty( $flags['tabs_enabled'] ) ) {
                foleo_enqueue_core_files( [ 'Tabs.css', 'Tabs.js' ] );
            }
            if ( ! empty( $flags['tabs_mobile_enabled'] ) ) {
                foleo_enqueue_core_files( [ 'Tabs_Mobile.css', 'Tabs_Mobile.js' ] );
            }
            if ( ! empty( $flags['lottie_enabled'] ) ) {
                foleo_enqueue_core_files( $lottie_assets );
            }
            if ( ! empty( $flags['snapScroll_enabled'] ) ) {
                foleo_enqueue_core_files( [ 'SnapScroll.js' ] );
            }
            if ( ! empty( $flags['dynamicTable_enabled'] ) || ! empty( $flags['videoBug_enabled'] ) ) {
                foleo_enqueue_core_files( [ 'Foleo_Modules.js' ] );
            } else {
                // Ensure dynamic table/video-bug runtime is available when flags are present but unset.
                foleo_enqueue_core_files( [ 'Foleo_Modules.js' ] );
            }
        } else {
            // Enqueue Tabs only where allowed
            if ( in_array( $host, $tabs_allow_hosts, true ) ) {
                foleo_enqueue_core_files( $tabs_assets );
            }

            // Enqueue Lottie only where allowed
            if ( in_array( $host, $lottie_allow_hosts, true ) ) {
                foleo_enqueue_core_files( $lottie_assets );
            }

            // Legacy defaults
            foleo_enqueue_core_files( [ 'Foleo_Modules.js', 'SnapScroll.js' ] );
        }
    } else if ( $is_builder_shell && current_user_can( 'edit_posts' ) ) {
        // Allow editor-only Lottie previews in builder shell without runtime scroll libs.
        foleo_enqueue_core_files( [ 'Lottie_Inject.js', 'Lottie_Global.js' ] );
    }

    // Brand.css: enqueue last if present.
    $brand_path = foleo_assets_base_dir( $namespace ) . 'Brand.css';
    if ( file_exists( $brand_path ) ) {
        $ver = filemtime( $brand_path );
        wp_enqueue_style(
            'catalyst-brand',
            foleo_assets_base_url( $namespace ) . 'Brand.css',
            [],
            $ver
        );
    }

    // Theme.css: enqueue after Brand.css if present.
    $theme_css_path = foleo_assets_base_dir( $namespace ) . 'Theme.css';
    if ( file_exists( $theme_css_path ) ) {
        $ver = filemtime( $theme_css_path );
        wp_enqueue_style(
            'catalyst-theme',
            foleo_assets_base_url( $namespace ) . 'Theme.css',
            [],
            $ver
        );
    }

    // Theme.js: enqueue last in footer if present.
    if ( ! $is_builder_shell ) {
        $theme_js_path = foleo_assets_base_dir( $namespace ) . 'Theme.js';
        if ( file_exists( $theme_js_path ) ) {
            $ver = filemtime( $theme_js_path );
            wp_enqueue_script(
                'catalyst-theme-js',
                foleo_assets_base_url( $namespace ) . 'Theme.js',
                [],
                $ver,
                true
            );
        }
    }

}, 100 );
