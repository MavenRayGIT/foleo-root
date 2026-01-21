<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_image_hotspots_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\ImageHotspots",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class ImageHotspots extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path d="M21 12V12.5C21 16.9783 21 19.2175 19.6088 20.6088C18.2175 22 15.9783 22 11.5 22C7.02166 22 4.78249 22 3.39124 20.6088C2 19.2175 2 16.9783 2 12.5C2 8.02166 2 5.78249 3.39124 4.39124C4.78249 3 7.02166 3 11.5 3H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />     <path d="M22 5.5C22 7.433 20.433 9 18.5 9C16.567 9 15 7.433 15 5.5C15 3.567 16.567 2 18.5 2C20.433 2 22 3.567 22 5.5Z" stroke="currentColor" stroke-width="1.5" />     <path d="M21 14H16.0743C15.2322 14 14.5706 14.7036 14.1995 15.4472C13.7963 16.2551 12.9889 17 11.5 17C10.0111 17 9.20373 16.2551 8.80054 15.4472C8.42942 14.7036 7.76777 14 6.92566 14H2" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /> </svg>';
        }
    
        static function tag()
        {
            return 'div';
        }
    
        static function tagOptions()
        {
            return ['section', 'footer', 'header', 'nav', 'aside', 'article', 'main'];
        }
    
        static function tagControlPath()
        {
            return false;
        }
    
        static function name()
        {
            return 'Image Hotspots';
        }
    
        static function className()
        {
            return 'dan-image-hotspots';
        }
    
        static function category()
        {
            return 'dancepad_medias';
        }
    
        static function badge()
        {
            return ['backgroundColor' => 'var(--gray500)', 'textColor' => 'var(--white)', 'label' => 'DP'];
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
            return ['design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]]], 'content' => ['content' => ['source' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1616516/pexels-photo-1616516.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => 'plane_landscape', 'caption' => '']]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'Dancepad\Hotspot', 'defaultProperties' => ['design' => ['spacing' => ['top' => ['number' => 20, 'unit' => '%', 'style' => '20%'], 'left' => ['number' => 20, 'unit' => '%', 'style' => '20%']], 'tooltip' => ['include_arrow' => true, 'arrow' => 'block', 'arrow_background' => '#FFF', 'arrow_color' => '#FFF', 'background' => '#FFF', 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'editMode' => 'all']]], 'typography' => ['color' => ['breakpoint_base' => '#EC1C1CFF']]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'colors' => ['background' => '#3C9FE2FF'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'editMode' => 'all']]], 'dimensions' => ['min_width' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'min_height' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]], 'content' => ['pulse' => ['duration' => ['number' => 1.6, 'unit' => 's', 'style' => '1.6s'], 'intensity' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'color' => '#3C9FE2FF'], 'tooltip' => ['event' => 'hover', 'placement' => 'bottom', 'vertical_distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'horizontal_distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Hotspot']], 'meta' => ['friendlyName' => 'Hotspot text'], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => null]]]]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tooltip'], 'settings' => ['advanced' => ['classes' => ['dan-image-hotspots__tooltip']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'A great tooltip']], 'meta' => ['friendlyName' => 'Tooltip text'], 'design' => ['typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]]]]], 'children' => []]]]]], ['slug' => 'Dancepad\Hotspot', 'defaultProperties' => ['design' => ['spacing' => ['top' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'left' => ['number' => 75, 'unit' => '%', 'style' => '75%']], 'tooltip' => ['include_arrow' => true, 'arrow' => 'none', 'arrow_background' => '#FFF', 'arrow_color' => '#FFF', 'background' => '#000', 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'editMode' => 'all']]], 'typography' => ['color' => ['breakpoint_base' => '#EC1C1CFF']]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'colors' => ['background' => '#000'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'editMode' => 'all']]], 'dimensions' => ['min_width' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'min_height' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]], 'content' => ['pulse' => ['duration' => ['number' => 1.6, 'unit' => 's', 'style' => '1.6s'], 'intensity' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'color' => '#000'], 'tooltip' => ['event' => 'hover', 'placement' => 'top', 'vertical_distance' => ['number' => 125, 'unit' => '%', 'style' => '125%'], 'horizontal_distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Hotspot']], 'meta' => ['friendlyName' => 'Hotspot text'], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => null]]]]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tooltip'], 'settings' => ['advanced' => ['classes' => ['dan-image-hotspots__tooltip']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'A great tooltip']], 'meta' => ['friendlyName' => 'Tooltip text'], 'design' => ['typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]], 'color' => ['breakpoint_base' => '#FFF']]]], 'children' => []]]]]]];
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
          "EssentialElements\\spacing_margin_all",
          "Margin",
          "margin",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\spacing_padding_all",
          "Padding",
          "padding",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\size",
          "Size",
          "size",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "source",
            "Source",
            [],
            ['type' => 'wpmedia', 'layout' => 'vertical'],
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
            return ['0' =>  ['title' => 'Dancepad - ImageHotspots','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Image_hotspots/dancepad_image_hotspots.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_image_hotspots();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_image_hotspots();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
        }
    
        static function settings()
        {
            return ['disableAI' => false];
        }
    
        static function addPanelRules()
        {
            return false;
        }
    
        static public function actions()
        {
            return [
    
    'onPropertyChange' => [['script' => 'dancepad_image_hotspots();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_image_hotspots();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_image_hotspots();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_image_hotspots();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_image_hotspots();',
    ],],];
        }
    
        static function nestingRule()
        {
            return ["type" => "container",   ];
        }
    
        static function spacingBars()
        {
            return false;
        }
    
        static function attributes()
        {
            return [
                ['name' => 'data-speed', 'template' => '{{ content.animation.speed }}'], 
                ['name' => 'data-grain-dimensions', 'template' => '{{ content.animation.grain_dimensions }}'],
                ['name' => 'data-flickering', 'template' => '1']
            ];
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'content.content.source']];
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
            return ['content.content.text'];
        }
    
        static function propertyPathsToSsrElementWhenValueChanges()
        {
            return false;
        }
    }
}

