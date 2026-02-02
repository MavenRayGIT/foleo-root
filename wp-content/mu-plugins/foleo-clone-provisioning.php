<?php
/**
 * Plugin Name: Foleo Clone Provisioning
 * Description: Provision per-site asset namespace on multisite creation/clone.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_clone_debug_enabled() {
    return defined( 'FOLEO_DEBUG' ) && FOLEO_DEBUG;
}

function foleo_clone_log( $message ) {
    if ( ! foleo_clone_debug_enabled() ) {
        return;
    }
    error_log( '[foleo-clone] ' . $message );
}

function foleo_clone_get_site_slug( $site ) {
    $domain = '';
    $path   = '';
    if ( $site instanceof WP_Site ) {
        $domain = strtolower( (string) $site->domain );
        $path   = (string) $site->path;
    }

    $slug = '';
    if ( $domain !== '' ) {
        $parts = explode( '.', $domain );
        if ( ! empty( $parts[0] ) && $parts[0] !== 'www' ) {
            $slug = $parts[0];
        }
    }

    if ( $slug === '' && $path !== '' && $path !== '/' ) {
        $trimmed = trim( $path, '/' );
        $segments = $trimmed !== '' ? explode( '/', $trimmed ) : [];
        if ( ! empty( $segments[0] ) ) {
            $slug = $segments[0];
        }
    }

    $slug = sanitize_key( $slug );
    return $slug;
}

function foleo_clone_copy_dir( $src, $dst ) {
    if ( ! is_dir( $src ) ) {
        return false;
    }
    if ( ! is_dir( $dst ) ) {
        wp_mkdir_p( $dst );
    }
    $dir = new DirectoryIterator( $src );
    foreach ( $dir as $item ) {
        if ( $item->isDot() ) {
            continue;
        }
        $src_path = $item->getPathname();
        $dst_path = $dst . '/' . $item->getFilename();
        if ( $item->isDir() ) {
            foleo_clone_copy_dir( $src_path, $dst_path );
        } else {
            copy( $src_path, $dst_path );
        }
    }
    return true;
}

function foleo_clone_provision_site( $blog_id ) {
    $blog_id = (int) $blog_id;
    if ( $blog_id <= 0 ) {
        return;
    }

    $site = get_site( $blog_id );
    if ( ! $site ) {
        return;
    }

    $slug = foleo_clone_get_site_slug( $site );
    if ( $slug === '' ) {
        $slug = 'site-' . $blog_id;
    }

    $dest_dir = WP_CONTENT_DIR . '/assets/' . $slug;
    $source_dir = WP_CONTENT_DIR . '/assets/catalyst';

    if ( is_dir( $dest_dir ) ) {
        foleo_clone_log( 'Assets dir exists, skipping copy: ' . $dest_dir );
    } else {
        foleo_clone_log( 'Provisioning assets to: ' . $dest_dir );
        foleo_clone_copy_dir( $source_dir, $dest_dir );

        $nav_path = $dest_dir . '/nav-registry.json';
        if ( ! file_exists( $nav_path ) ) {
            file_put_contents( $nav_path, "{}\n" );
        }

        $brand_path = $dest_dir . '/Brand.css';
        if ( ! file_exists( $brand_path ) ) {
            file_put_contents( $brand_path, "/* Brand overrides */\n" );
        }
    }

    if ( get_blog_option( $blog_id, 'foleo_assets_namespace' ) === '' ) {
        update_blog_option( $blog_id, 'foleo_assets_namespace', $slug );
    }

    update_blog_option( $blog_id, 'foleo_default_profile', 'standalone' );
    update_blog_option( $blog_id, 'foleo_site_type', 'demo' );
    update_blog_option( $blog_id, 'foleo_created_from', 'catalyst' );

    // Reset integrations only if known option keys already exist.
    $integration_keys = [];
    foreach ( $integration_keys as $key ) {
        $existing = get_blog_option( $blog_id, $key, null );
        if ( null !== $existing ) {
            update_blog_option( $blog_id, $key, '' );
        }
    }
}

add_action( 'wp_initialize_site', function ( $new_site ) {
    if ( empty( $new_site->blog_id ) ) {
        return;
    }
    foleo_clone_provision_site( (int) $new_site->blog_id );
}, 20 );

add_action( 'wpmu_new_blog', function ( $blog_id ) {
    foleo_clone_provision_site( (int) $blog_id );
}, 20, 1 );
