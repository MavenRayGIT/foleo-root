<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_highlight_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Highlight",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Highlight extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" d="M20 18V6M6 20H18M18 4H6M4 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M21 2H19C18.4477 2 18 2.44772 18 3V5C18 5.55228 18.4477 6 19 6H21C21.5523 6 22 5.55228 22 5V3C22 2.44772 21.5523 2 21 2Z" stroke="currentColor" stroke-width="1.5" />
        <path d="M5 2H3C2.44772 2 2 2.44772 2 3V5C2 5.55228 2.44772 6 3 6H5C5.55228 6 6 5.55228 6 5V3C6 2.44772 5.55228 2 5 2Z" stroke="currentColor" stroke-width="1.5" />
        <path d="M21 18H19C18.4477 18 18 18.4477 18 19V21C18 21.5523 18.4477 22 19 22H21C21.5523 22 22 21.5523 22 21V19C22 18.4477 21.5523 18 21 18Z" stroke="currentColor" stroke-width="1.5" />
        <path d="M5 18H3C2.44772 18 2 18.4477 2 19V21C2 21.5523 2.44772 22 3 22H5C5.55228 22 6 21.5523 6 21V19C6 18.4477 5.55228 18 5 18Z" stroke="currentColor" stroke-width="1.5" />
        <path opacity="0.4" d="M8.00831 9.76304C7.87958 8.27659 8.73851 8.22606 12.0056 8.02393M12.0056 8.02393C14.9204 8.19237 16.2343 8.19237 16.0093 9.78086M12.0056 8.02393V16M10.6635 16H13.3364" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>';
        }
    
        static function tag()
        {
            return 'span';
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
            return 'Highlight';
        }
    
        static function className()
        {
            return 'dan-highlight';
        }
    
        static function category()
        {
            return 'dancepad_texts';
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
            return ['design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 48, 'unit' => 'px', 'style' => '48px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.2', 'unit' => 'custom', 'style' => '1.2']]]]]]], 'size' => ['height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']], 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]], 'content' => ['content' => ['tag' => 'p']]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Lorem ipsum dolor sit amet, ']], 'settings' => ['advanced' => ['tag' => 'span']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 48, 'unit' => 'px', 'style' => '48px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.2', 'unit' => 'custom', 'style' => '1.2']]]]]]]]], 'children' => []], ['slug' => 'Dancepad\HighlightMark', 'defaultProperties' => ['design' => ['selectors' => ['filter' => ['filters' => [[]]], 'mix_blend_mode' => 'hard-light', 'background' => '#186edf54', 'left' => ['number' => -1, 'unit' => '%', 'style' => '-1%'], 'top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'final_width' => ['number' => 103.5, 'unit' => '%', 'style' => '103.5%'], 'initial_width' => ['number' => 0, 'unit' => '%', 'style' => '0%']], 'selectors_line' => ['color' => '#0386ff', 'width' => ['number' => 2, 'unit' => 'px', 'style' => '2px']], 'selectors_circle' => ['color' => '#0386ff', 'scale' => 1.25], 'animation' => ['delay' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'gsap_easing' => 'expo', 'disable_at_the_builder' => false], 'scrolltrigger' => ['start' => 'top bottom', 'toggleactions' => 'play none none none'], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 48, 'unit' => 'px', 'style' => '48px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.2', 'unit' => 'custom', 'style' => '1.2']]]]]]]], 'content' => ['content' => ['text' => 'Dancepad'], 'animation' => ['duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'delay' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'gsap_easing' => 'expo'], 'scrolltrigger' => ['start' => 'top bottom', 'toggleactions' => 'play none none none']]], 'children' => []], ['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => ' consectetur adipiscing elit, sed do eiusmod tempor']], 'settings' => ['advanced' => ['tag' => 'span']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 48, 'unit' => 'px', 'style' => '48px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.2', 'unit' => 'custom', 'style' => '1.2']]]]]]]]], 'children' => []]];
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
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "tag",
            "Tag",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'h1', 'text' => 'H1'], ['text' => 'H2', 'value' => 'h2'], ['text' => 'H3', 'value' => 'h3'], ['text' => 'H4', 'value' => 'h4'], ['text' => 'H5', 'value' => 'h5'], ['text' => 'H6', 'value' => 'h6'], ['text' => 'p', 'value' => 'p'], ['text' => 'span', 'value' => 'span']]],
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
            return [
                '0' => [
                    'title' => 'Dancepad - Highlight',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Highlight/dancepad_highlight.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' => [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_highlight();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' => [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_highlight();'],
                    'builderCondition' => 'return false;',
                    'frontendCondition' => 'return true;',
                ],
                '3' => [
                    'title' => 'GSAP',
                    'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%', '%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
                ],
            ];
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
    
    'onPropertyChange' => [['script' => 'dancepad_highlight();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_highlight();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_highlight();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_highlight();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_highlight();',
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
            return false;
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
            return [['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.text']];
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