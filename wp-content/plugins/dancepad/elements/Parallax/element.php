<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_parallax_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Parallax",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Parallax extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path opacity="0.4" d="M9.17331 1.44383C10.0889 1.33103 11.0341 1.25 12 1.25C12.9658 1.25 13.9111 1.33103 14.8266 1.44383C17.626 1.78873 19.7892 4.11005 20.007 6.85181C20.1391 8.51511 20.25 10.2381 20.25 12C20.25 13.7619 20.1391 15.4849 20.007 17.1482C19.7892 19.89 17.626 22.2112 14.8266 22.5562C13.9112 22.6689 12.9658 22.75 12 22.75C11.0341 22.75 10.0888 22.6689 9.17338 22.5562C6.37413 22.2112 4.21064 19.89 3.99296 17.1482C3.86089 15.4849 3.75 13.7618 3.75 12C3.75 10.2382 3.86089 8.51512 3.99296 6.85182C4.21063 4.11003 6.37402 1.78872 9.17331 1.44383Z" fill="currentColor" />     <path d="M9.44754 7.35215C9.1674 7.65727 9.18766 8.13171 9.49278 8.41184C9.63686 8.54413 9.8187 8.60943 10 8.60938H11V10.3906H10C9.8187 10.3906 9.63686 10.4559 9.49278 10.5882C9.18766 10.8683 9.1674 11.3427 9.44754 11.6479L10.4755 12.7675C10.6868 12.9977 10.8934 13.2229 11.0876 13.3843C11.3045 13.5645 11.6032 13.75 12 13.75C12.3968 13.75 12.6955 13.5645 12.9124 13.3843C13.1066 13.2229 13.3132 12.9977 13.5245 12.7675L14.5525 11.6479C14.8326 11.3427 14.8124 10.8683 14.5072 10.5882C14.3631 10.4559 14.1813 10.3906 14 10.3906H13V8.60938H14C14.1813 8.60943 14.3631 8.54413 14.5072 8.41184C14.8124 8.13171 14.8326 7.65727 14.5525 7.35215L13.5245 6.23249L13.5245 6.23248C13.3132 6.00227 13.1066 5.77706 12.9124 5.61573C12.6955 5.4355 12.3968 5.25 12 5.25C11.6032 5.25 11.3045 5.4355 11.0876 5.61573C10.8934 5.77707 10.6868 6.00228 10.4755 6.23249L9.44754 7.35215Z" fill="currentColor" /> </svg>';
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
            return "content.content.tag";
        }
    
        static function name()
        {
            return 'Parallax';
        }
    
        static function className()
        {
            return 'dan-parallax';
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
            return ['content' => ['content' => ['source' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/3824262/pexels-photo-3824262.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => 'liquid_gradient', 'caption' => '']], 'animation' => ['direction' => 'left', 'scale' => 1.2, 'duration' => ['number' => 1.6, 'unit' => 's', 'style' => '1.6s'], 'delay' => ['number' => 1.6, 'unit' => 's', 'style' => '1.6s'], 'gsap_easing' => 'expo', 'orientation' => 'down', 'overflow' => false, 'css_easing' => 'cubic-bezier(0,0,0,1)'], 'scrolltrigger' => ['trigger' => 'this', 'start' => 'top bottom', 'toggleactions' => 'play none none none', 'additional_triggers' => null, 'element' => null]], 'design' => ['dimensions' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'margin' => ['margin' => null], 'size' => ['width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'borders' => ['radius' => ['breakpoint_base' => null]]]];
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
          "EssentialElements\\spacing_margin_all",
          "Margin",
          "margin",
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
          ), c(
            "animation",
            "Animation",
            [c(
            "disable_at_touch_devices",
            "Disable at touch devices",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "orientation",
            "Orientation",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'left', 'text' => 'left'], ['text' => 'right', 'value' => 'right'], ['text' => 'down', 'value' => 'down'], ['text' => 'up', 'value' => 'up']]],
            false,
            false,
            [],
          ), c(
            "scale",
            "Scale",
            [],
            ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']]],
            false,
            false,
            [],
          ), c(
            "overflow",
            "Overflow",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "delay",
            "Delay",
            [],
            ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
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
            return ['0' =>  ['title' => 'Dancepad - Parallax','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Parallax/dancepad_parallax.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_parallax();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_parallax();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_parallax();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_parallax();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_parallax();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_parallax();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_parallax();',
    ],],];
        }
    
        static function nestingRule()
        {
            return ["type" => "final",   ];
        }
    
        static function spacingBars()
        {
            return false;
        }
    
        static function attributes()
        {
            return [
                ['name' => 'data-disable-touch-devices', 'template' => '{{ content.animation.disable_at_touch_device }}'],
                ['name' => 'data-orientation', 'template' => '{{ content.animation.orientation }}'],
                ['name' => 'data-scale', 'template' => '{{ content.animation.scale }}'],
                ['name' => 'data-overflow', 'template' => '{{ content.animation.overflow }}'],
                ['name' => 'data-delay', 'template' => '{{ content.animation.delay.style }}'],
                ['name' => 'data-ease', 'template' => '{{ content.animation.css_easing }}'],
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'image_url', 'path' => 'content.content.source']];
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

