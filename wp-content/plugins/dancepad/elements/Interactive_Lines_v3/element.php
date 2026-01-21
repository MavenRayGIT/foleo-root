<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_interactive_lines_v3_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Interactive_Lines_v3",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Interactive_Lines_v3 extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 12.0745L1.5 11.9255C1.49997 9.74957 1.49995 8.01485 1.68282 6.65471C1.87163 5.25033 2.27174 4.09653 3.18413 3.18413C4.09652 2.27174 5.25033 1.87164 6.65471 1.68282C8.01485 1.49996 9.74958 1.49997 11.9256 1.5L12.0744 1.5C14.2504 1.49997 15.9851 1.49996 17.3453 1.68282C18.7497 1.87163 19.9035 2.27174 20.8159 3.18413C21.7283 4.09652 22.1284 5.25033 22.3172 6.65471C22.5 8.01485 22.5 9.74959 22.5 11.9256L22.5 12.0744C22.5 14.2504 22.5 15.9851 22.3172 17.3453C22.1284 18.7497 21.7283 19.9035 20.8159 20.8159C19.9035 21.7283 18.7497 22.1284 17.3453 22.3172C15.9852 22.5 14.2504 22.5 12.0744 22.5L11.9255 22.5C9.74957 22.5 8.01484 22.5 6.65471 22.3172C5.25033 22.1284 4.09652 21.7283 3.18413 20.8159C2.27174 19.9035 1.87163 18.7497 1.68282 17.3453C1.49995 15.9852 1.49997 14.2504 1.5 12.0745ZM3.66499 17.0788C3.82398 18.2614 4.11949 18.9228 4.59835 19.4016C5.0772 19.8805 5.7386 20.176 6.9212 20.335C8.13257 20.4979 9.73256 20.5 12 20.5C14.2674 20.5 15.8674 20.4979 17.0788 20.335C18.2614 20.176 18.9228 19.8805 19.4016 19.4016C19.8805 18.9228 20.176 18.2614 20.335 17.0788C20.4979 15.8674 20.5 14.2674 20.5 12C20.5 9.73256 20.4979 8.13257 20.335 6.9212C20.176 5.7386 19.8805 5.0772 19.4016 4.59835C18.9228 4.11949 18.2614 3.82398 17.0788 3.66498C15.8674 3.50212 14.2674 3.5 12 3.5C9.73255 3.5 8.13257 3.50212 6.9212 3.66499C5.7386 3.82398 5.0772 4.1195 4.59835 4.59835C4.11949 5.0772 3.82398 5.7386 3.66498 6.92121C3.50212 8.13257 3.5 9.73256 3.5 12C3.5 14.2674 3.50212 15.8674 3.66499 17.0788Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 9.99976L2.5 9.99976L2.5 7.99976L21.5 7.99976L21.5 9.99976Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.5 15.9998L2.5 15.9998L2.5 13.9998L21.5 13.9998L21.5 15.9998Z" fill="currentColor" />
            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17 2.5L17 21.5L15 21.5L15 2.5L17 2.5Z" fill="currentColor" />
            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M9 2.49976L9 21.4998L7 21.4998L7 2.49976L9 2.49976Z" fill="currentColor" />
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
            return 'Interactive Lines V3';
        }
    
        static function className()
        {
            return 'dan-interactive-lines-v3';
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
            return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'background' => ['color' => ['breakpoint_base' => '#e3e3e3']], 'lines' => ['width' => ['number' => '0.5vmin', 'unit' => 'custom', 'style' => '0.5vmin'], 'height' => ['number' => '4vmin', 'unit' => 'custom', 'style' => '4vmin'], 'color' => '#6366f1']], 'content' => ['animation' => ['grid_rows' => 12, 'grid_columns' => 12]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => null], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_vertical_align' => ['breakpoint_base' => 'center'], 'v_align' => ['breakpoint_base' => 'center']], 'container' => ['min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Interactive Lines v3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []]]]];
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
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         ), c(
            "lines",
            "Lines",
            [c(
            "width",
            "Width",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "color",
            "Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          )];
        }
    
        static function contentControls()
        {
            return [c(
            "animation",
            "Animation",
            [c(
            "disable_at_the_builder",
            "Disable at the builder",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "grid_rows",
            "Grid rows",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "grid_columns",
            "Grid columns",
            [],
            ['type' => 'number', 'layout' => 'inline'],
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
                    'title' => 'Dancepad - Interactive Lines v3',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Interactive_Lines_v3/dancepad_interactive_lines_v3.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' => [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_interactive_lines_v3();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' => [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_interactive_lines_v3();'],
                    'builderCondition' => 'return false;',
                    'frontendCondition' => 'return true;',
                ],
                '3' => [
                    'title' => 'GSAP',
                    'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
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
    
    'onPropertyChange' => [['script' => 'dancepad_interactive_lines_v3();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_interactive_lines_v3();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_interactive_lines_v3();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_interactive_lines_v3();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_interactive_lines_v3();',
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
            return [['name' => 'data-disable-builder', 'template' => '{% if content.animation.disable_at_the_builder %}
    1
    {% else %}
    0
    {% endif %}'], ['name' => 'data-rows', 'template' => '{{ content.animation.grid_rows }}'], ['name' => 'data-columns', 'template' => '{{ content.animation.grid_columns }}'], ['name' => 'data-flickering', 'template' => '1']];
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
            return [];
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