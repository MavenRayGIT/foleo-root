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
        'charts_enabled'        => foleo_read_flag( $config, 'charts_enabled' ),
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
    static $bootstrapping = false;
    if ( $bootstrapping ) {
        return;
    }
    if ( ! $post ) {
        return;
    }
    if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }
    if ( $post->post_type !== 'page' ) {
        return;
    }
    $host = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
    if ( $host === 'huronperformance.foleo.co' ) {
        return;
    }

    $existing_config = get_post_meta( $post_id, 'foleo_page_config_json', true );
    $existing_flags = get_post_meta( $post_id, 'foleo_page_flags', true );
    if ( ( ! is_string( $existing_config ) || trim( $existing_config ) === '' ) || empty( $existing_flags ) ) {
        $bootstrapping = true;

        $slug = is_string( $post->post_name ) ? $post->post_name : '';
        $page_key = '';
        if ( in_array( $slug, [ 'cx', 'tofu', 'pitch' ], true ) ) {
            $page_key = $slug;
        }

        $config = [
            'pageKey' => $page_key,
            'flags' => [
                'cfStream_enabled' => false,
                'charts_enabled' => false,
                'lottie_enabled' => false,
                'tabs_enabled' => false,
                'tabs_mobile_enabled' => false,
                'dynamicTable_enabled' => false,
                'videoBug_enabled' => false,
                'snapScroll_enabled' => false,
                'vidstack_enabled' => false,
            ],
            'modules' => [
                'cfStream' => [ 'enabled' => false, 'mode' => '' ],
                'lottie' => [ 'enabled' => false ],
                'tabs' => [ 'enabled' => false ],
                'tabs_mobile' => [ 'enabled' => false ],
                'dynamicTable' => [ 'enabled' => false ],
                'videoBug' => [ 'enabled' => false ],
                'snapScroll' => [ 'enabled' => false ],
                'vidstack' => [ 'enabled' => false ],
            ],
        ];

        if ( ! is_string( $existing_config ) || trim( $existing_config ) === '' ) {
            $json = wp_json_encode( $config );
            update_post_meta( $post_id, 'foleo_page_config_json', $json );
        }

        if ( empty( $existing_flags ) ) {
            $flags = foleo_build_page_flags( $config );
            update_post_meta( $post_id, 'foleo_page_flags', $flags );
        }

        delete_post_meta( $post_id, 'foleo_page_config_error' );
        $bootstrapping = false;
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
