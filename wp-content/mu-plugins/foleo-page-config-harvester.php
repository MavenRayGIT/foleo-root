<?php
/**
 * Plugin Name: Foleo Page Config Harvester
 * Description: Harvest Breakdance page config JSON on save and store flags for conditional asset loading.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_bool_flag( $value ) {
    return $value === true || $value === 1 || $value === '1' || $value === 'true';
}

function foleo_read_flag( array $config, $key ) {
    if ( array_key_exists( $key, $config ) ) {
        return foleo_bool_flag( $config[ $key ] );
    }
    if ( isset( $config['flags'] ) && is_array( $config['flags'] ) && array_key_exists( $key, $config['flags'] ) ) {
        return foleo_bool_flag( $config['flags'][ $key ] );
    }
    if ( isset( $config['modules'] ) && is_array( $config['modules'] ) && array_key_exists( $key, $config['modules'] ) ) {
        return foleo_bool_flag( $config['modules'][ $key ] );
    }
    if ( isset( $config['modules'] ) && is_array( $config['modules'] ) ) {
        $module = null;
        switch ( $key ) {
            case 'cfStream_enabled':
                $module = $config['modules']['cfStream'] ?? null;
                break;
            case 'lottie_enabled':
                $module = $config['modules']['lottie'] ?? null;
                break;
            case 'tabs_enabled':
                $module = $config['modules']['tabs'] ?? null;
                break;
            case 'tabs_mobile_enabled':
                $module = $config['modules']['tabs_mobile'] ?? null;
                break;
            case 'dynamicTable_enabled':
                $module = $config['modules']['dynamicTable'] ?? null;
                break;
            case 'videoBug_enabled':
                $module = $config['modules']['videoBug'] ?? null;
                break;
            case 'snapScroll_enabled':
                $module = $config['modules']['snapScroll'] ?? null;
                break;
            case 'vidstack_enabled':
                $module = $config['modules']['vidstack'] ?? null;
                break;
        }
        if ( is_array( $module ) && array_key_exists( 'enabled', $module ) ) {
            return foleo_bool_flag( $module['enabled'] );
        }
    }
    return false;
}

function foleo_read_string( array $config, $key ) {
    if ( array_key_exists( $key, $config ) ) {
        return is_scalar( $config[ $key ] ) ? (string) $config[ $key ] : '';
    }
    if ( isset( $config['flags'] ) && is_array( $config['flags'] ) && array_key_exists( $key, $config['flags'] ) ) {
        return is_scalar( $config['flags'][ $key ] ) ? (string) $config['flags'][ $key ] : '';
    }
    if ( isset( $config['modules'] ) && is_array( $config['modules'] ) && array_key_exists( $key, $config['modules'] ) ) {
        return is_scalar( $config['modules'][ $key ] ) ? (string) $config['modules'][ $key ] : '';
    }
    if ( $key === 'cfStream_mode' && isset( $config['modules']['cfStream'] ) && is_array( $config['modules']['cfStream'] ) ) {
        $mode = $config['modules']['cfStream']['mode'] ?? '';
        return is_scalar( $mode ) ? (string) $mode : '';
    }
    return '';
}

function foleo_build_page_flags( array $config ) {
    $flags = [
        'cfStream_enabled'      => foleo_read_flag( $config, 'cfStream_enabled' ),
        'cfStream_mode'         => foleo_read_string( $config, 'cfStream_mode' ),
        'lottie_enabled'        => foleo_read_flag( $config, 'lottie_enabled' ),
        'tabs_enabled'          => foleo_read_flag( $config, 'tabs_enabled' ),
        'tabs_mobile_enabled'   => foleo_read_flag( $config, 'tabs_mobile_enabled' ),
        'dynamicTable_enabled'  => foleo_read_flag( $config, 'dynamicTable_enabled' ),
        'videoBug_enabled'      => foleo_read_flag( $config, 'videoBug_enabled' ),
        'snapScroll_enabled'    => foleo_read_flag( $config, 'snapScroll_enabled' ),
        'vidstack_enabled'      => foleo_read_flag( $config, 'vidstack_enabled' ),
    ];

    return $flags;
}

/**
 * Config -> flags on save -> conditional enqueue on view.
 */
add_action( 'save_post', function ( $post_id, $post, $update ) {
    if ( ! $post ) {
        return;
    }
    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }

    // Source of truth is the custom field `foleo_page_config_json`.
    $meta_json = get_post_meta( $post_id, 'foleo_page_config_json', true );
    if ( ! is_string( $meta_json ) || trim( $meta_json ) === '' ) {
        delete_post_meta( $post_id, 'foleo_page_config_json' );
        delete_post_meta( $post_id, 'foleo_page_flags' );
        delete_post_meta( $post_id, 'foleo_page_config_error' );
        return;
    }

    $json = trim( $meta_json );
    $data = json_decode( $json, true );
    if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $data ) ) {
        update_post_meta( $post_id, 'foleo_page_config_error', 'Invalid JSON in foleo_page_config_json.' );
        delete_post_meta( $post_id, 'foleo_page_flags' );
        return;
    }

    delete_post_meta( $post_id, 'foleo_page_config_error' );
    update_post_meta( $post_id, 'foleo_page_config_json', $json );
    $flags = foleo_build_page_flags( $data );
    update_post_meta( $post_id, 'foleo_page_flags', $flags );
}, 20, 3 );
