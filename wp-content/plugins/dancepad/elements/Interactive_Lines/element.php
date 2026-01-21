<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_interactive_lines_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Interactive_Lines",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Interactive_Lines extends \Breakdance\Elements\Element
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
            return 'Interactive Lines';
        }
    
        static function className()
        {
            return 'dan-interactive-lines';
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
            return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'background' => ['color' => ['breakpoint_base' => '#000']]], 'content' => ['animation' => ['cell_size' => 28, 'alpha' => 1, 'line_length' => 0.75, 'line_width' => 3, 'animation_speed' => 0.15, 'active_area_size' => 100, 'rotation_threshold' => 0.01, 'spotlight_intensity' => 0.9, 'active_color' => '#FFA500', 'inactive_color' => '#000', 'spotlight' => true]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['css' => ['breakpoint_base' => null], 'classes' => ['dan-interactive-lines__content']]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_vertical_align' => ['breakpoint_base' => 'center'], 'v_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Interactive Lines', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff']]]], 'children' => []]]]];
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
            "animation",
            "Animation",
            [c(
            "spotlight",
            "Spotlight",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "active_color",
            "Active color",
            [],
            ['type' => 'color', 'layout' => 'inline', 'items' => [['value' => 'rainbow', 'text' => 'rainbow'], ['text' => 'custom', 'value' => 'custom']]],
            false,
            false,
            [],
          ), c(
            "inactive_color",
            "Inactive color",
            [],
            ['type' => 'color', 'layout' => 'inline', 'items' => [['value' => 'rainbow', 'text' => 'rainbow'], ['text' => 'custom', 'value' => 'custom']]],
            false,
            false,
            [],
          ), c(
            "cell_size",
            "Cell size",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "alpha",
            "Alpha",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "line_length",
            "Line Length",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "line_width",
            "Line Width",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "animation_speed",
            "Animation Speed",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "active_area_size",
            "Active Area Size",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "rotation_threshold",
            "Rotation Threshold",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "spotlight_intensity",
            "Spotlight Intensity",
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
              '0' =>  ['title' => 'Dancepad - Interactive Lines','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Interactive_Lines/dancepad_interactive_lines.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_interactive_lines();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_interactive_lines();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
              '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],]
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
    
    'onPropertyChange' => [['script' => 'dancepad_interactive_lines();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_interactive_lines();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_interactive_lines();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_interactive_lines();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_interactive_lines();',
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
            return [['name' => 'data-cell', 'template' => '{{ content.animation.cell_size }}'], ['name' => 'data-alpha', 'template' => '{{ content.animation.alpha }}'], ['name' => 'data-line', 'template' => '{{ content.animation.line_length }}'], ['name' => 'data-width', 'template' => '{{ content.animation.line_width }}'], ['name' => 'data-speed', 'template' => '{{ content.animation.animation_speed }}'], ['name' => 'data-size', 'template' => '{{ content.animation.active_area_size }}'], ['name' => 'data-threshold', 'template' => '{{ content.animation.rotation_threshold }}'], ['name' => 'data-intensity', 'template' => '{{ content.animation.spotlight_intensity }}'], ['name' => 'data-spotlight', 'template' => '{% if content.animation.spotlight %}
    true
    {% endif %}']];
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
