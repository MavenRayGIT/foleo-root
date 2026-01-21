<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_flipbox_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Flipbox",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Flipbox extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path opacity="0.4" d="M9.05575 2.25C10.6583 2.24998 11.9373 2.24997 12.9404 2.38483C13.9767 2.52415 14.8301 2.81966 15.5052 3.4948C16.1803 4.16994 16.4759 5.02335 16.6152 6.05961C16.75 7.0627 16.75 8.34166 16.75 9.94426V10.0557C16.75 11.6583 16.75 12.9373 16.6152 13.9404C16.4758 14.9767 16.1803 15.8301 15.5052 16.5052C14.8301 17.1803 13.9767 17.4759 12.9404 17.6152C11.9373 17.75 10.6583 17.75 9.05574 17.75H8.94426C7.34166 17.75 6.0627 17.75 5.05961 17.6152C4.02335 17.4759 3.16994 17.1803 2.4948 16.5052C1.81966 15.8301 1.52415 14.9767 1.38483 13.9404C1.24997 12.9373 1.24998 11.6583 1.25 10.0557V10.0557V9.94426V9.94425C1.24998 8.34166 1.24997 7.0627 1.38483 6.05961C1.52415 5.02335 1.81966 4.16994 2.4948 3.4948C3.16994 2.81966 4.02335 2.52415 5.05961 2.38483C6.0627 2.24997 7.34166 2.24998 8.94425 2.25H8.94426H9.05574H9.05575Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3864 11.75C18.3864 11.1977 18.8341 10.75 19.3864 10.75C19.9408 10.75 20.3414 11.0377 20.6082 11.2845C20.8523 11.5103 21.1114 11.8244 21.3756 12.1449C21.3875 12.1593 21.3994 12.1737 21.4113 12.1881L22.5214 13.5338C22.8728 13.9598 22.8124 14.5901 22.3864 14.9415C21.9603 15.293 21.3301 15.2325 20.9786 14.8065L20.3842 14.0859C20.3773 15.3399 20.3488 16.3962 20.231 17.2723C20.0696 18.4725 19.7245 19.483 18.9219 20.2855C18.1193 21.0881 17.1088 21.4333 15.9087 21.5946C14.7527 21.75 13.283 21.75 11.4595 21.75H10.75C10.1977 21.75 9.75 21.3023 9.75 20.75C9.75 20.1977 10.1977 19.75 10.75 19.75H11.3864C13.3002 19.75 14.6351 19.7479 15.6422 19.6125C16.6206 19.4809 17.1387 19.2403 17.5077 18.8713C17.8767 18.5023 18.1173 17.9842 18.2488 17.0058C18.3842 15.9987 18.3864 14.6639 18.3864 12.75V11.75Z" fill="currentColor" />
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
            return 'Flipbox';
        }
    
        static function className()
        {
            return 'dan-flipbox';
        }
    
        static function category()
        {
            return 'dancepad_cores';
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
            return ['design' => ['dimensions' => ['height' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'width' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'front_back_styles' => ['background' => '#FFF', 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'editMode' => 'all']]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'max_width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']]]], 'content' => ['animation' => ['duration' => ['number' => 1.3, 'unit' => 's', 'style' => '1.3s'], 'css_easing' => 'cubic-bezier(0.175, 0.885, 0.32, 1.275)', 'perspective' => ['number' => 800, 'unit' => 'px', 'style' => '800px'], 'event' => 'hover', 'type' => 'horizontal']]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Front'], 'settings' => ['advanced' => ['classes' => ['dan-flipbox__flip', 'dan-flipbox__flip--front'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']], 'background' => ['color' => '#000'], 'container' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'editMode' => 'all']]]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Front Heading', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Back'], 'settings' => ['advanced' => ['classes' => ['dan-flipbox__flip', 'dan-flipbox__flip--back'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']], 'container' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'editMode' => 'all']]]], 'background' => ['color' => 'lightgrey']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Back Heading', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000']]]], 'children' => []]]]];
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
            "animation",
            "Animation",
            [c(
            "type",
            "Type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'horizontal', 'text' => 'horizontal'], ['text' => 'horizontal-reverse', 'value' => 'horizontal-reverse'], ['text' => 'vertical', 'value' => 'vertical'], ['text' => 'vertical-reverse', 'value' => 'vertical-reverse']]],
            false,
            false,
            [],
          ), c(
            "event",
            "Event",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'click', 'value' => 'click']]],
            false,
            false,
            [],
          ), c(
            "perspective",
            "Perspective",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
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
            return ['0' =>  ['title' => 'Dancepad - Flipbox','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Flipbox/dancepad_flipbox.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_flipbox();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_flipbox();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_flipbox();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_flipbox();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_flipbox();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_flipbox();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_flipbox();',
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
                ['name' => 'data-trigger', 'template' => '{{ content.animation.event }}'],
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
