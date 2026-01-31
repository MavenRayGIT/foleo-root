<?php
/**
 * Plugin Name: Foleo Page Config Harvester
 * Description: Harvest Breakdance page config JSON on save and store flags for conditional asset loading.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function foleo_page_config_log( $message, array $context = [] ) {}

function foleo_extract_page_config_json( $content ) {
    if ( ! is_string( $content ) || $content === '' ) {
        return null;
    }

    $pattern = '/<script[^>]*type=["\']application\/json["\'][^>]*data-foleo-page-config[^>]*>(.*?)<\/script>/is';
    if ( ! preg_match( $pattern, $content, $matches ) ) {
        $content_unescaped = wp_unslash( $content );
        $content_unescaped = str_replace( [ '<br>', '<br/>', '<br />' ], "\n", $content_unescaped );
        $shortcode_pattern = '/\[foleo_page_config\](.*?)(?:\[\/foleo_page_config\]|\z)/is';
        if ( ! preg_match( $shortcode_pattern, $content_unescaped, $shortcode_matches ) ) {
            return null;
        }
        $json = trim( $shortcode_matches[1] );
        return $json !== '' ? $json : null;
    }

    $json = trim( $matches[1] );
    return $json !== '' ? $json : null;
}

function foleo_extract_page_config_from_breakdance_meta( $post_id ) {
    $raw = get_post_meta( $post_id, '_breakdance_data', true );
    if ( ! $raw ) {
        return null;
    }
    if ( is_array( $raw ) ) {
        $raw = wp_json_encode( $raw );
    }
    if ( ! is_string( $raw ) || $raw === '' ) {
        return null;
    }
    return foleo_extract_page_config_json( $raw );
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

add_action( 'save_post', function ( $post_id, $post, $update ) {
    if ( ! $post ) {
        return;
    }
    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }

    $meta_json = get_post_meta( $post_id, 'foleo_page_config_json', true );
    $json = null;
    if ( is_string( $meta_json ) && trim( $meta_json ) !== '' ) {
        $json = trim( $meta_json );
    }
    if ( $json === null ) {
        $json = foleo_extract_page_config_json( $post->post_content );
    }
    if ( $json === null ) {
        $json = foleo_extract_page_config_from_breakdance_meta( $post_id );
    }
    if ( $json === null ) {
        delete_post_meta( $post_id, 'foleo_page_config_json' );
        delete_post_meta( $post_id, 'foleo_page_flags' );
        delete_post_meta( $post_id, 'foleo_page_config_error' );
        return;
    }

    $data = json_decode( $json, true );
    if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $data ) ) {
        update_post_meta( $post_id, 'foleo_page_config_error', 'Invalid JSON in data-foleo-page-config.' );
        delete_post_meta( $post_id, 'foleo_page_flags' );
        return;
    }

    delete_post_meta( $post_id, 'foleo_page_config_error' );
    update_post_meta( $post_id, 'foleo_page_config_json', $json );
    $flags = foleo_build_page_flags( $data );
    update_post_meta( $post_id, 'foleo_page_flags', $flags );
}, 20, 3 );
