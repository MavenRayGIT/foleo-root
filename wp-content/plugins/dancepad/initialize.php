<?php

namespace Dancepad;
use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

class Initialize {
	public function __construct() {
        // Initialize the SureCart client
        if ( ! class_exists( 'SureCart\DancepadLicensing\Client' ) ) {
            require_once DANCEPAD_PLUGIN_DIR . '/licensing/src/Client.php';
        }

        $client = new \SureCart\DancepadLicensing\Client( 'dancepad', 'pt_CeTYm1xAAYz6cBsoqAJcALmL', DANCEPAD_FILE);

        // Add the license & front-end settings page.
        $client->settings()->add_page(
            [
            'type'                 => 'submenu',
            'parent_slug'          => 'Dancepad',
            'page_title'           => 'Dancepad',
            'menu_title'           => 'Dancepad',
            'capability'           => 'manage_options',
            'menu_slug'            => 'dancepad',
            'icon_url'             => '',
            'position'             => null,
            'parent_slug'          => 'breakdance',
            ]
        );

        //add_action('plugins_loaded', array($this, 'wp_load_dancepad'));
        add_filter('plugin_action_links_' . DANCEPAD_FILE_NAME, array($this, 'dancepad_settings_link'));

        if (get_option('activate_dancepad') == '1') {
            require_once 'elements.php';
            new Dancepad_Elements();
        }
	}
    
    // Dancepad settings link at plugins
    public static function dancepad_settings_link( $links ) {
        $links[] = '<a href="' . admin_url( 'admin.php?page=dancepad' ) . '">' . __('Settings') . '</a>';
        return $links;
    }
}