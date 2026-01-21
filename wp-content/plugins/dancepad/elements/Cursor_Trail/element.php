<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_cursor_trail_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\CursorTrail",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class CursorTrail extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" d="M17.8152 9.92816C19.1194 10.4385 20.1708 10.8499 20.8852 11.2435C21.249 11.444 21.5862 11.6715 21.8332 11.9511C22.0975 12.2503 22.2717 12.6266 22.2479 13.0726C22.2239 13.5203 22.0085 13.8764 21.7127 14.1453C21.4362 14.3968 21.0751 14.5873 20.6897 14.7485C19.9327 15.065 18.776 15.3804 17.4143 15.7517C16.9799 15.8702 16.7056 15.9459 16.5009 16.0237C16.3111 16.0959 16.2387 16.1496 16.1941 16.1941C16.1496 16.2387 16.0959 16.3111 16.0237 16.5009C15.9459 16.7056 15.8702 16.9799 15.7517 17.4143C15.3804 18.776 15.065 19.9327 14.7485 20.6897C14.5873 21.0751 14.3968 21.4362 14.1453 21.7127C13.8764 22.0085 13.5203 22.2239 13.0726 22.2479C12.6266 22.2717 12.2503 22.0975 11.9511 21.8332C11.6715 21.5862 11.444 21.249 11.2435 20.8852C10.8499 20.1708 10.4385 19.1194 9.92816 17.8152L8.04524 13.0033C7.51105 11.6382 7.07948 10.5353 6.87972 9.68476C6.68192 8.84252 6.63678 7.94722 7.292 7.292C7.94722 6.63678 8.84252 6.68192 9.68476 6.87972C10.5353 7.07948 11.6382 7.51105 13.0033 8.04524L13.0033 8.04524L17.8152 9.92816Z" fill="currentColor" />
        <path d="M1.75 3.5C1.75 2.5335 2.5335 1.75 3.5 1.75H4.5C5.4665 1.75 6.25 2.5335 6.25 3.5V4.5C6.25 5.4665 5.4665 6.25 4.5 6.25H3.5C2.5335 6.25 1.75 5.4665 1.75 4.5V3.5Z" fill="currentColor" />
        <path d="M12.75 3.5C12.75 2.5335 13.5335 1.75 14.5 1.75H15.5C16.4665 1.75 17.25 2.5335 17.25 3.5V4.5C17.25 5.4665 16.4665 6.25 15.5 6.25H14.5C13.5335 6.25 12.75 5.4665 12.75 4.5V3.5Z" fill="currentColor" />
        <path d="M1.75 14.5C1.75 13.5335 2.5335 12.75 3.5 12.75H4.5C5.4665 12.75 6.25 13.5335 6.25 14.5V15.5C6.25 16.4665 5.4665 17.25 4.5 17.25H3.5C2.5335 17.25 1.75 16.4665 1.75 15.5V14.5Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.75 4C4.75 3.58579 5.08579 3.25 5.5 3.25H13.5C13.9142 3.25 14.25 3.58579 14.25 4C14.25 4.41421 13.9142 4.75 13.5 4.75H5.5C5.08579 4.75 4.75 4.41421 4.75 4ZM4 4.75C4.41421 4.75 4.75 5.08579 4.75 5.5V13.5C4.75 13.9142 4.41421 14.25 4 14.25C3.58579 14.25 3.25 13.9142 3.25 13.5V5.5C3.25 5.08579 3.58579 4.75 4 4.75Z" fill="currentColor" />
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
            return 'Cursor Trail';
        }
    
        static function className()
        {
            return 'dan-cursor-trail';
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
            return ['content' => ['show_animation' => ['gsap_easing' => 'expo', 'duration' => ['number' => 0.9, 'unit' => 's', 'style' => '0.9s']], 'hide_animation' => ['gsap_easing' => 'power1', 'duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'scale' => 0.2, 'delay' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']], 'trail_animation' => ['threshold' => 100, 'lerp_factor' => 0.1, 'type' => 'type-3']]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-cursor-trail__content']]], 'design' => ['container' => ['min_height' => ['breakpoint_base' => ['number' => 700, 'unit' => 'px', 'style' => '700px']]], 'layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Cursor Trail']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Trail Item'], 'settings' => ['advanced' => ['classes' => ['dan-cursor-trail__item']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_1.webp']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Trail Item'], 'settings' => ['advanced' => ['classes' => ['dan-cursor-trail__item']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_2.webp']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Trail Item'], 'settings' => ['advanced' => ['classes' => ['dan-cursor-trail__item']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_3.webp']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Trail Item'], 'settings' => ['advanced' => ['classes' => ['dan-cursor-trail__item']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_4.webp']]], 'children' => []]]]];
        }
    
        static function cssTemplate()
        {
            $template = file_get_contents(__DIR__ . '/css.twig');
            return $template;
        }
    
        static function designControls()
        {
            return [];
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
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>All your content to be affected by the Cursor Trail should be placed inside the Content element.</p>']],
            false,
            false,
            [],
          ), c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The trail effect will use the Trail item elements inside Cursor Trail element. You can remove and duplicate Trail items at pleasure and place any elements at them.</p>']],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "trail_animation",
            "Trail Animation",
            [c(
            "type",
            "Type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'type-1', 'text' => 'type1'], ['value' => 'type-2', 'text' => 'type2'], ['value' => 'type-3', 'text' => 'type3'], ['value' => 'type-4', 'text' => 'type4'], ['value' => 'type-5', 'text' => 'type5']]],
            false,
            false,
            [],
          ), c(
            "threshold",
            "Threshold",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "lerp_factor",
            "Lerp Factor",
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
          ), c(
            "show_animation",
            "Show Animation",
            [c(
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "gsap_easing",
            "GSAP easing",
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
          ), c(
            "hide_animation",
            "Hide Animation",
            [c(
            "scale",
            "Scale",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "delay",
            "Delay",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
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
            "gsap_easing",
            "GSAP easing",
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
              '0' =>  ['title' => 'Dancepad - Cursor Trail','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Cursor_Trail/dancepad_cursor_trail.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_cursor_trail();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_cursor_trail();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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
    
    'onPropertyChange' => [['script' => 'dancepad_cursor_trail();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_cursor_trail();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_cursor_trail();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_cursor_trail();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_cursor_trail();',
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
            return [['name' => 'data-type', 'template' => '{{ content.trail_animation.type }}'], ['name' => 'data-threshold', 'template' => '{{ content.trail_animation.threshold }}'], ['name' => 'data-lerp-factor', 'template' => '{{ content.trail_animation.lerp_factor }}'], ['name' => 'data-show-duration', 'template' => '{{ content.show_animation.duration.style }}'], ['name' => 'data-show-ease', 'template' => '{{ content.show_animation.gsap_easing }}'], ['name' => 'data-scale', 'template' => '{{ content.hide_animation.scale }}'], ['name' => 'data-hide-delay', 'template' => '{{ content.hide_animation.delay.style }}'], ['name' => 'data-hide-duration', 'template' => '{{ content.hide_animation.duration.style }}'], ['name' => 'data-hide-ease', 'template' => '{{ content.hide_animation.gsap_easing }}']];
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

