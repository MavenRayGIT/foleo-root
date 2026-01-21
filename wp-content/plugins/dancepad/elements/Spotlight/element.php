<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_spotlight_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Spotlight",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Spotlight extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path opacity="0.4" d="M8.62814 12.6736H8.16918C6.68545 12.6736 5.94358 12.6736 5.62736 12.1844C5.31114 11.6953 5.61244 11.0138 6.21504 9.65082L8.02668 5.55323C8.57457 4.314 8.84852 3.69438 9.37997 3.34719C9.91142 3 10.5859 3 11.935 3H14.0244C15.6632 3 16.4826 3 16.7916 3.53535C17.1007 4.0707 16.6942 4.78588 15.8811 6.21623L14.8092 8.10187C14.405 8.81295 14.2029 9.16849 14.2057 9.45952C14.2094 9.83774 14.4105 10.1862 14.7354 10.377C14.9854 10.5239 15.3927 10.5239 16.2074 10.5239C17.2373 10.5239 17.7523 10.5239 18.0205 10.7022C18.3689 10.9338 18.5513 11.3482 18.4874 11.7632C18.4382 12.0826 18.0918 12.4656 17.399 13.2317L11.8639 19.3523C10.7767 20.5545 10.2331 21.1556 9.86807 20.9654C9.50303 20.7751 9.67833 19.9821 10.0289 18.3962L10.7157 15.2896C10.9826 14.082 11.1161 13.4781 10.7951 13.0759C10.4741 12.6736 9.85877 12.6736 8.62814 12.6736Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
            <path d="M10 20.9998C9.95336 20.9984 9.90956 20.987 9.86807 20.9654C9.50303 20.7751 9.67833 19.9821 10.0289 18.3962L10.7157 15.2896C10.9826 14.082 11.1161 13.4781 10.7951 13.0759C10.4741 12.6736 9.85877 12.6736 8.62814 12.6736H8.16918C6.68545 12.6736 5.94358 12.6736 5.62736 12.1844C5.31114 11.6953 5.61244 11.0138 6.21504 9.65082L8.02668 5.55323C8.57457 4.314 8.84852 3.69438 9.37997 3.34719C9.91142 3 10.5859 3 11.935 3H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>';
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
            return 'Spotlight';
        }
    
        static function className()
        {
            return 'dan-spotlight';
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
            return ['content' => ['animation' => ['speed' => ['number' => 60, 'unit' => 's', 'style' => '60s'], 'grain_dimensions' => 1000, 'grain_opacity' => 0.1, 'opacity' => 0.5, 'palette' => 'rainbow', 'css_easing' => 'linear', 'spotlight_height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'mode' => 'light', 'colors' => [['color' => '#DA352EFF']]]], 'design' => ['colors' => ['background' => null], 'dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 600, 'unit' => 'px', 'style' => '600px']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Spotlight', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]]]]]], 'children' => []]];
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
         ),getPresetSection(
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
            "animation",
            "Animation",
            [c(
            "mode",
            "Mode",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'light', 'text' => 'light'], ['text' => 'dark', 'value' => 'dark']]],
            false,
            false,
            [],
          ), c(
            "palette",
            "Palette",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'rainbow', 'text' => 'rainbow'], ['text' => 'custom', 'value' => 'custom']]],
            false,
            false,
            [],
          ), c(
            "colors",
            "Colors",
            [c(
            "color",
            "Color",
            [],
            ['type' => 'color', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
            false,
            false,
            [],
          )],
            ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => ''], 'condition' => [[['path' => 'content.animation.palette', 'operand' => 'equals', 'value' => 'custom']]]],
            false,
            false,
            [],
          ), c(
            "opacity",
            "Opacity",
            [],
            ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
            false,
            false,
            [],
          ), c(
            "spotlight_height",
            "Spotlight height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            false,
            false,
            [],
          ), c(
            "speed",
            "Speed",
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
            return ['0' =>  ['title' => 'Dancepad - Spotlight','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Spotlight/dancepad_spotlight.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_spotlight();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_spotlight();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_spotlight();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_spotlight();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_spotlight();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_spotlight();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_spotlight();',
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
                ['name' => 'data-gradient-colors', 'template' => '{% for item in content.animation.colors %}{{ item.color }}next11{% endfor %}'], 
                ['name' => 'data-mode', 'template' => '{{ content.animation.mode }}'], 
                ['name' => 'data-palette', 'template' => '{{ content.animation.palette }}'],
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
