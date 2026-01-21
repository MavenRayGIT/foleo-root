<?php

namespace Dancepad;
use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

class Dancepad_Elements {
  private $enabled_elements = [];

  public function __construct() {
    if (get_option('activate_dancepad') == '1') {
      $this->init();
    }
  }

  public function init() {
    add_action('breakdance_loaded', function () {
      \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'Dancepad',
        'element',
        'Dancepad Elements',
        false
      );

      /*
      \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'Dancepad',
        'macro',
        'Dancepad Macros',
        false,
      );

      \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'Dancepad',
        'preset',
        'Dancepad Presets',
        false,
      */

      // Register categories
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_texts', 'Dancepad - Texts');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_buttons', 'Dancepad - Buttons');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_menus', 'Dancepad - Menus');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_medias', 'Dancepad - Medias');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_cursors', 'Dancepad - Cursors');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_sliders', 'Dancepad - Sliders');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_backgrounds', 'Dancepad - Backgrounds');
      \Breakdance\Elements\ElementCategoriesController::getInstance()->registerCategory('dancepad_cores', 'Dancepad - Cores');
    }, 9);

    // Assets Loading
    add_action('wp_enqueue_scripts', function() {
      if (get_option('dan_qr_code_enable') == 'true') {
        wp_enqueue_script('qr-code-library', 'https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js', array(), '1.0.2', true);
      }

      $cdn_options = [
        DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_splittext.min.js?ver=' . DANCEPAD_VERSION => 'dan_splittext_enable',
      ];

      foreach ($cdn_options as $cdn_name => $option_name) {
        $option_value = get_option($option_name, 'true');
        if ($option_value === 'true') {
          wp_enqueue_script($option_name, $cdn_name, array(), DANCEPAD_VERSION, true);
        }
      }
    }, 11);
  }
}