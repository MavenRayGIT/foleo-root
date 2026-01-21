<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_cursor_slide_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\CursorSlide",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class CursorSlide extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path d="M16 7C18.357 7 19.5355 7 20.2678 7.73223C21 8.46447 21 9.64298 21 12C21 14.357 21 15.5355 20.2678 16.2678C19.5355 17 18.357 17 16 17H8C5.64298 17 4.46447 17 3.73223 16.2678C3 15.5355 3 14.357 3 12C3 9.64298 3 8.46447 3.73223 7.73223C4.46447 7 5.64298 7 8 7L16 7Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path opacity="0.4" d="M17 2C16.8955 2.54697 16.7107 2.94952 16.3838 3.26777C15.6316 4 14.4211 4 12 4C9.5789 4 8.36835 4 7.61621 3.26777C7.28931 2.94952 7.10449 2.54697 7 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path opacity="0.4" d="M17 22C16.8955 21.453 16.7107 21.0505 16.3838 20.7322C15.6316 20 14.4211 20 12 20C9.5789 20 8.36835 20 7.61621 20.7322C7.28931 21.0505 7.10449 21.453 7 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
            return 'Cursor Slide';
        }
    
        static function className()
        {
            return 'dan-cursor-slide';
        }
    
        static function category()
        {
            return 'dancepad_cursors';
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
            return ['content' => ['animation' => ['speed' => 25, 'grain_dimensions' => 1000, 'grain_opacity' => 0.1, 'slide_css_easing' => 'cubic-bezier(.76,0,.24,1)', 'slide_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'cursor_css_easing' => 'cubic-bezier(.76,0,.24,1)', 'cursor_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'cursor_movement_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'cursor_movement_gsap_easing' => 'power3'], 'content' => ['target' => '']], 'design' => ['colors' => ['background' => 'grey'], 'dimensions' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'size' => ['width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'height' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-cursor-slide__item']]], 'meta' => ['friendlyName' => 'Slide Item']], 'children' => [['slug' => 'EssentialElements\Image', 'defaultProperties' => ['content' => ['content' => ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_1.webp', 'alt' => '', 'caption' => '']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-cursor-slide__item']]], 'meta' => ['friendlyName' => 'Slide Item']], 'children' => [['slug' => 'EssentialElements\Image', 'defaultProperties' => ['content' => ['content' => ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_2.webp', 'alt' => '', 'caption' => '']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-cursor-slide__item']]], 'meta' => ['friendlyName' => 'Slide Item']], 'children' => [['slug' => 'EssentialElements\Image', 'defaultProperties' => ['content' => ['content' => ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_3.webp', 'alt' => '', 'caption' => '']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-cursor-slide__item']]], 'meta' => ['friendlyName' => 'Slide Item']], 'children' => [['slug' => 'EssentialElements\Image', 'defaultProperties' => ['content' => ['content' => ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_4.webp', 'alt' => '', 'caption' => '']]]], 'children' => []]]]];
        }
    
        static function cssTemplate()
        {
            $template = file_get_contents(__DIR__ . '/css.twig');
            return $template;
        }
    
        static function designControls()
        {
            return [getPresetSection(
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
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The number of elements with the target class should be equal to the number of Slide Items.</p>']],
            false,
            false,
            [],
          ), c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The first element targeted will be linked with the first image, the second element targeted will be linked with the second image, and so on.</p>']],
            false,
            false,
            [],
          ), c(
            "target",
            "Target",
            [],
            ['type' => 'text', 'layout' => 'inline', 'placeholder' => '.className'],
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
            "slide_duration",
            "Slide duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "slide_css_easing",
            "Slide CSS easing",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "cursor_duration",
            "Cursor duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "cursor_css_easing",
            "Cursor CSS easing",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "cursor_movement_duration",
            "Cursor movement duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "cursor_movement_gsap_easing",
            "Cursor movement GSAP easing",
            [],
            ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
                '0' =>  [
                    'title' => 'Dancepad - Cursor Slide',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Cursor_Slide/dancepad_cursor_slide.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' =>  [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_cursor_slide();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' =>  [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_cursor_slide();'],
                    'builderCondition' => 'return false;',
                    'frontendCondition' => 'return true;',
                ],
                '3' =>  [
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
    
    'onPropertyChange' => [['script' => 'dancepad_cursor_slide();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_cursor_slide();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_cursor_slide();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_cursor_slide();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_cursor_slide();',
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
            return [['name' => 'data-target', 'template' => '{{ content.content.target }}'], ['name' => 'data-movement-duration', 'template' => '{{ content.animation.cursor_movement_duration.style }}'], ['name' => 'data-movement-ease', 'template' => '{{ content.animation.cursor_movement_gsap_easing }}']];
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
