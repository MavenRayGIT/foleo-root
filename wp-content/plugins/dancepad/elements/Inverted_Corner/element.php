<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_inverted_corner_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\InvertedCorner",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class InvertedCorner extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path d="M7.53781 4.47726C7.82651 4.77428 7.81977 5.24911 7.52274 5.53781C7.37698 5.67949 7.18839 5.75002 7 5.75H6.0003V14.0136C6.0003 15.902 6.0003 16.8463 6.58725 17.4323C7.1742 18.0182 8.11843 18.0167 10.0069 18.0136L18.25 18V17C18.25 16.8116 18.3205 16.623 18.4622 16.4773C18.7509 16.1802 19.2257 16.1735 19.5227 16.4622C19.7161 16.614 20.4174 17.1795 20.6366 17.3652C20.8709 17.5638 21.1197 17.7905 21.3154 18.0202C21.4135 18.1353 21.5134 18.2688 21.5919 18.4155C21.6672 18.5562 21.75 18.7592 21.75 19C21.75 19.2408 21.6672 19.4438 21.5919 19.5845C21.5134 19.7312 21.4135 19.8647 21.3154 19.9798C21.1197 20.2095 20.8709 20.4362 20.6366 20.6348C20.4174 20.8205 19.7161 21.386 19.5227 21.5378C19.2257 21.8265 18.7509 21.8198 18.4622 21.5227C18.3205 21.377 18.25 21.1884 18.25 21V20H10.9315C9.57589 20 8.46098 20 7.5792 19.8851C6.65687 19.7648 5.84 19.5031 5.18283 18.8658C4.52135 18.2244 4.24561 17.42 4.11961 16.5112C4.00022 15.6501 4.00026 14.5638 4.0003 13.2539V5.75H3.00056C2.81198 5.75016 2.62317 5.67963 2.47726 5.53781C2.18023 5.24911 2.17349 4.77428 2.46219 4.47726C2.61398 4.28388 3.17952 3.58255 3.36519 3.36344C3.56379 3.12906 3.79045 2.88028 4.02017 2.68463C4.13534 2.58655 4.26884 2.48655 4.41548 2.40808C4.55617 2.33279 4.75922 2.25 5 2.25C5.24078 2.25 5.44382 2.33279 5.58452 2.40808C5.73116 2.48655 5.86466 2.58655 5.97983 2.68463C6.20954 2.88028 6.43621 3.12906 6.63481 3.36344C6.82051 3.58259 7.386 4.28385 7.53781 4.47726Z" fill="currentColor" />     <path opacity="0.4" d="M10.0069 18.0136C8.11843 18.0167 7.1742 18.0182 6.58725 17.4323C6.0003 16.8463 6.0003 15.902 6.0003 14.0136V11.25C7.36789 11.25 8.52478 11.25 9.39175 11.3665C10.2919 11.4875 11.0497 11.7464 11.6516 12.3484C12.2536 12.9503 12.5125 13.7081 12.6335 14.6083C12.75 15.4752 12.75 16.6324 12.75 18L10.0069 18.0136Z" fill="currentColor" /> </svg>';
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
            return 'Inverted Corner';
        }
    
        static function className()
        {
            return 'dan-inverted-corner';
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
            return ['design' => ['dimensions' => ['width' => ['number' => 400, 'unit' => 'px', 'style' => '400px'], 'height' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'colors' => ['block_content_background' => '#8EFF71', 'mask_background' => '#FFF'], 'corners' => ['radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'position' => 'bottom-right', 'width' => ['number' => 60, 'unit' => 'px', 'style' => '60px'], 'height' => ['number' => 60, 'unit' => 'px', 'style' => '60px'], 'inverted_width' => ['breakpoint_base' => ['number' => 200, 'unit' => 'px', 'style' => '200px']], 'inverted_height' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_position' => 'top-left', 'inverted_radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'inverted_distance' => ['breakpoint_base' => ['number' => 6, 'unit' => 'px', 'style' => '6px']]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'height' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']]], 'corner_2' => ['radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'inverted_radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'inverted_position' => 'top-right', 'inverted_width' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_height' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_distance' => ['breakpoint_base' => ['number' => 6, 'unit' => 'px', 'style' => '6px']]], 'corner_3' => ['radius' => ['breakpoint_base' => ['number' => 100, 'unit' => 'px', 'style' => '100px']], 'inverted_radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'inverted_position' => 'bottom-left', 'inverted_width' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_height' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_distance' => ['breakpoint_base' => ['number' => 6, 'unit' => 'px', 'style' => '6px']]], 'corner_4' => ['inverted_width' => ['breakpoint_base' => ['number' => 200, 'unit' => 'px', 'style' => '200px']], 'inverted_height' => ['breakpoint_base' => ['number' => 60, 'unit' => 'px', 'style' => '60px']], 'inverted_distance' => ['breakpoint_base' => ['number' => 6, 'unit' => 'px', 'style' => '6px']], 'inverted_position' => 'bottom-right', 'radius' => ['breakpoint_base' => ['number' => 100, 'unit' => 'px', 'style' => '100px']], 'inverted_radius' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Block Content'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__content-wrapper']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Great  Heading', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Corner Content'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__content-corner']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Ball'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__ball']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Corner Content'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__content-corner']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Ball'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__ball']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Corner Content'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__content-corner']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Ball'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__ball']]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Corner Content'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__content-corner']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Ball'], 'settings' => ['advanced' => ['classes' => ['dan-inverted-corner__ball']]]], 'children' => []]]]];
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
         ), c(
            "corners",
            "Corner 1",
            [c(
            "radius",
            "Radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_radius",
            "Inverted radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_position",
            "Inverted position",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top-left', 'text' => 'top left'], ['text' => 'top right', 'value' => 'top-right'], ['text' => 'bottom left', 'value' => 'bottom-left'], ['text' => 'bottom right', 'value' => 'bottom-right']]],
            false,
            false,
            [],
          ), c(
            "inverted_width",
            "Inverted width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          ), c(
            "inverted_height",
            "Inverted height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
            true,
            false,
            [],
          ), c(
            "inverted_distance",
            "Inverted distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "corner_2",
            "Corner 2",
            [c(
            "radius",
            "Radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_radius",
            "Inverted radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_position",
            "Inverted position",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top-left', 'text' => 'top left'], ['text' => 'top right', 'value' => 'top-right'], ['text' => 'bottom left', 'value' => 'bottom-left'], ['text' => 'bottom right', 'value' => 'bottom-right']]],
            false,
            false,
            [],
          ), c(
            "inverted_width",
            "Inverted width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          ), c(
            "inverted_height",
            "Inverted height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
            true,
            false,
            [],
          ), c(
            "inverted_distance",
            "Inverted distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "corner_3",
            "Corner 3",
            [c(
            "radius",
            "Radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_radius",
            "Inverted radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_position",
            "Inverted position",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top-left', 'text' => 'top left'], ['text' => 'top right', 'value' => 'top-right'], ['text' => 'bottom left', 'value' => 'bottom-left'], ['text' => 'bottom right', 'value' => 'bottom-right']]],
            false,
            false,
            [],
          ), c(
            "inverted_width",
            "Inverted width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          ), c(
            "inverted_height",
            "Inverted height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
            true,
            false,
            [],
          ), c(
            "inverted_distance",
            "Inverted distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "corner_4",
            "Corner 4",
            [c(
            "radius",
            "Radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_radius",
            "Inverted radius",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
            true,
            false,
            [],
          ), c(
            "inverted_position",
            "Inverted position",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top-left', 'text' => 'top left'], ['text' => 'top right', 'value' => 'top-right'], ['text' => 'bottom left', 'value' => 'bottom-left'], ['text' => 'bottom right', 'value' => 'bottom-right']]],
            false,
            false,
            [],
          ), c(
            "inverted_width",
            "Inverted width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          ), c(
            "inverted_height",
            "Inverted height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
            true,
            false,
            [],
          ), c(
            "inverted_distance",
            "Inverted distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "colors",
            "Colors",
            [c(
            "block_content_background",
            "Block Content Background",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "mask_background",
            "Mask Background",
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
            return [];
        }
    
        static function settingsControls()
        {
            return [];
        }
    
        static function dependencies()
        {
            return [
              '0' =>  ['title' => 'Dancepad - Inverted Corner','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Inverted_Corner/dancepad_inverted_corner.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_inverted_corner();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_inverted_corner();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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
    
    'onPropertyChange' => [['script' => 'dancepad_inverted_corner();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_inverted_corner();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_inverted_corner();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_inverted_corner();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_inverted_corner();',
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
            return [['name' => 'data-corner-position-1', 'template' => '{{ design.corners.inverted_position }}'], ['name' => 'data-corner-position-2', 'template' => '{{ design.corner_2.inverted_position }}'], ['name' => 'data-corner-position-3', 'template' => '{{ design.corner_3.inverted_position }}'], ['name' => 'data-corner-position-4', 'template' => '{{ design.corner_4.inverted_position }}'], ['name' => 'data-flickering', 'template' => '1']];
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
            return [['name' => 'dan-inverted-corner--top-left', 'template' => '{% if design.corners.inverted_position == \'top-left\' %}
            1
            {% endif %}'], ['name' => 'dan-inverted-corner--top-right', 'template' => '{% if design.corners.inverted_position == \'top-right\' %}
            1
            {% endif %}'], ['name' => 'dan-inverted-corner--bottom-left', 'template' => '{% if design.corners.inverted_position == \'bottom-left\' %}
            1
            {% endif %}'], ['name' => 'dan-inverted-corner--bottom-right', 'template' => '{% if design.corners.inverted_position == \'bottom-right\' %}
            1
            {% endif %}']];
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