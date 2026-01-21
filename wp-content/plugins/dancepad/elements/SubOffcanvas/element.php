<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_multi_offcanvas_menu_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Suboffcanvas",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Suboffcanvas extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return 'SquareIcon';
        }
    
        static function tag()
        {
            return 'div';
        }
    
        static function tagOptions()
        {
            return [];
        }
    
        static function tagControlPath()
        {
            return false;
        }
    
        static function name()
        {
            return 'SubOffcanvas';
        }
    
        static function className()
        {
            return 'dan-multi-offcanvas-menu__subcanvas';
        }
    
        static function category()
        {
            return 'other';
        }
    
        static function badge()
        {
            return false;
        }
    
        static function slug()
        {
            return __CLASS__;
        }
    
        static function template()
        {
            return file_get_contents(__DIR__ . '/html.twig');
        }
    
        static function defaultCss()
        {
            return file_get_contents(__DIR__ . '/default.css');
        }
    
        static function defaultProperties()
        {
            return false;
        }
    
        static function defaultChildren()
        {
            return false;
        }
    
        static function cssTemplate()
        {
            $template = file_get_contents(__DIR__ . '/css.twig');
            return $template;
        }
    
        static function designControls()
        {
            return [getPresetSection(
          "EssentialElements\\layout",
          "Layout",
          "layout",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\spacing_padding_all",
          "Padding",
          "padding",
           ['type' => 'popout']
         ), c(
            "dimensions",
            "Dimensions",
            [c(
            "width",
            "Width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'custom']]],
            true,
            false,
            [],
          ), c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vh', 'custom']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), getPresetSection(
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "settings",
            "Settings",
            [c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Toggles will Open/Close the Sub OffCanvas. The same class can be used for both opening and closing.</p>']],
            false,
            false,
            [],
          ), c(
            "open_toggle",
            "Open toggle",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'placeholder' => '.className'],
            false,
            false,
            [],
          ), c(
            "close_toggle",
            "Close toggle",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'placeholder' => '.className'],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "animation",
            "Animation",
            [c(
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "css_easing",
            "CSS easing",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          )];
        }
    
        static function settingsControls()
        {
            return [];
        }
    
        static function dependencies()
        {
            return false;
        }
    
        static function settings()
        {
            return false;
        }
    
        static function addPanelRules()
        {
            return false;
        }
    
        static public function actions()
        {
            return false;
        }
    
        static function nestingRule()
        {
            return ["type" => "container",  "restrictedToBeADescendantOf" => ['Dancepad\MultiOffcanvasMenu'], ];
        }
    
        static function spacingBars()
        {
            return false;
        }
    
        static function attributes()
        {
            return [['name' => 'data-opentoggle', 'template' => '{{ content.settings.open_toggle }}'], ['name' => 'data-closetoggle', 'template' => '{{ content.settings.close_toggle }}'], ['name' => 'tabindex', 'template' => '0']];
        }
    
        static function experimental()
        {
            return false;
        }
    
        static function order()
        {
            return 0;
        }
    
        static function dynamicPropertyPaths()
        {
            return [['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
        }
    
        static function additionalClasses()
        {
            return false;
        }
    
        static function projectManagement()
        {
            return false;
        }
    
        static function propertyPathsToWhitelistInFlatProps()
        {
            return false;
        }
    
        static function propertyPathsToSsrElementWhenValueChanges()
        {
            return false;
        }
    }
    
}
