<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_tiles_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Tiles",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Tiles extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M2.50204 12.9996C2.02869 12.9996 1.79202 12.9996 1.64529 13.1477C1.49856 13.2959 1.5008 13.5311 1.50528 14.0017C1.51771 15.3061 1.55716 16.4133 1.68241 17.3449C1.87122 18.7493 2.27133 19.9031 3.18372 20.8154C4.09611 21.7278 5.24992 22.1279 6.6543 22.3168C7.58585 22.442 8.69311 22.4815 9.9975 22.4939C10.468 22.4984 10.7033 22.5006 10.8514 22.3539C10.9996 22.2071 10.9996 21.9705 10.9996 21.4971V13.9996C10.9996 13.5282 10.9996 13.2925 10.8531 13.146C10.7067 12.9996 10.471 12.9996 9.99958 12.9996H2.50204ZM22.4939 9.99751C22.4984 10.468 22.5006 10.7033 22.3539 10.8515C22.2071 10.9996 21.9705 10.9996 21.4971 10.9996H13.9996C13.5282 10.9996 13.2925 10.9996 13.146 10.8531C12.9996 10.7067 12.9996 10.471 12.9996 9.99959V2.50204C12.9996 2.02869 12.9996 1.79202 13.1477 1.64529C13.2959 1.49856 13.5311 1.5008 14.0017 1.50528C15.3061 1.51771 16.4133 1.55716 17.3449 1.68241C18.7493 1.87122 19.9031 2.27133 20.8154 3.18372C21.7278 4.09611 22.1279 5.24992 22.3168 6.6543C22.442 7.58585 22.4815 8.69311 22.4939 9.99751Z" fill="currentColor" />     <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9996 2.50204C10.9996 2.02869 10.9996 1.79202 10.8514 1.64529C10.7033 1.49856 10.468 1.5008 9.9975 1.50528C8.69311 1.51771 7.58585 1.55716 6.65429 1.68241C5.24992 1.87122 4.09611 2.27133 3.18372 3.18372C2.27133 4.09611 1.87122 5.24992 1.68241 6.6543C1.55716 7.58585 1.51771 8.69311 1.50528 9.99751C1.5008 10.468 1.49856 10.7033 1.64529 10.8515C1.79202 10.9996 2.02869 10.9996 2.50204 10.9996H9.99958C10.471 10.9996 10.7067 10.9996 10.8531 10.8531C10.9996 10.7067 10.9996 10.471 10.9996 9.99959V2.50204ZM12.9996 21.4971C12.9996 21.9705 12.9996 22.2071 13.1477 22.3539C13.2959 22.5006 13.5311 22.4984 14.0017 22.4939C15.3061 22.4815 16.4133 22.442 17.3449 22.3168C18.7493 22.1279 19.9031 21.7278 20.8154 20.8154C21.7278 19.9031 22.1279 18.7493 22.3168 17.3449C22.442 16.4133 22.4815 15.3061 22.4939 14.0017C22.4984 13.5311 22.5006 13.2959 22.3539 13.1477C22.2071 12.9996 21.9705 12.9996 21.4971 12.9996H13.9996C13.5282 12.9996 13.2925 12.9996 13.146 13.146C12.9996 13.2925 12.9996 13.5282 12.9996 13.9996V21.4971Z" fill="currentColor" /> </svg>';
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
            return 'Tiles';
        }
    
        static function className()
        {
            return 'dan-tiles';
        }
    
        static function category()
        {
            return 'dancepad_backgrounds';
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
            return ['content' => ['tiles' => ['css_easing' => 'ease-in-out', 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'leave_color' => 'rgba(129, 129, 129, 1)', 'enter_color' => 'rgba(236, 236, 236, 1)', 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 0.5, 'unit' => 'px', 'style' => '0.5px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 0.5, 'unit' => 'px', 'style' => '0.5px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'left' => ['width' => ['number' => 0.5, 'unit' => 'px', 'style' => '0.5px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'right' => ['width' => ['number' => 0.5, 'unit' => 'px', 'style' => '0.5px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid']]]], 'dimensions' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'offset' => ['number' => 2, 'unit' => 'px', 'style' => '2px']]], 'design' => ['borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(229, 229, 229, 1)', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'editMode' => 'all']]], 'dimensions' => ['offset' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'width' => ['number' => 400, 'unit' => 'px', 'style' => '400px'], 'height' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'colors' => ['background' => '#FFF'], 'background' => ['color' => ['breakpoint_base' => '#FFF']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tiles', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]]]]]], 'children' => []]];
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
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\size",
          "Size",
          "size",
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
            "tiles",
            "Tiles",
            [c(
            "offset",
            "Offset",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'custom']]],
            false,
            false,
            [],
          ), c(
            "dimensions",
            "Dimensions",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            false,
            false,
            [],
          ), getPresetSection(
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         ), c(
            "enter_color",
            "Enter color",
            [],
            ['type' => 'color', 'layout' => 'inline', 'items' => [['value' => 'rainbow', 'text' => 'rainbow'], ['text' => 'custom', 'value' => 'custom']]],
            false,
            false,
            [],
          ), c(
            "leave_color",
            "Leave color",
            [],
            ['type' => 'color', 'layout' => 'inline', 'items' => [['value' => 'rainbow', 'text' => 'rainbow'], ['text' => 'custom', 'value' => 'custom']]],
            false,
            false,
            [],
          ), c(
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
            return ['0' =>  ['title' => 'Dancepad - Tiles','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Tiles/dancepad_tiles.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_tiles();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_tiles();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_tiles();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_tiles();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_tiles();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_tiles();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_tiles();',
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
            return [['name' => 'data-square-dimensions', 'template' => '{{ content.tiles.dimensions.style }}']];
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
