<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_mask_hover_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\MaskHover",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class MaskHover extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path opacity="0.4" d="M1.25009 5.99985C1.25009 3.37649 3.37674 1.24985 6.00009 1.24985C8.62344 1.24985 10.7501 3.37649 10.7501 5.99985C10.7501 8.6232 8.62344 10.7498 6.00009 10.7498C3.37674 10.7498 1.25009 8.6232 1.25009 5.99985Z" fill="currentColor" />
            <path d="M1.25009 17.9998C1.25009 15.3765 3.37674 13.2498 6.00009 13.2498C8.62344 13.2498 10.7501 15.3765 10.7501 17.9998C10.7501 20.6232 8.62344 22.7498 6.00009 22.7498C3.37674 22.7498 1.25009 20.6232 1.25009 17.9998Z" fill="currentColor" />
            <path opacity="0.4" d="M13.2501 17.9998C13.2501 15.3765 15.3767 13.2498 18.0001 13.2498C20.6234 13.2498 22.7501 15.3765 22.7501 17.9998C22.7501 20.6232 20.6234 22.7498 18.0001 22.7498C15.3767 22.7498 13.2501 20.6232 13.2501 17.9998Z" fill="currentColor" />
            <path d="M14.2501 5.24985H21.2501C21.8024 5.24985 22.2501 5.69756 22.2501 6.24985C22.2501 6.80213 21.8024 7.24985 21.2501 7.24985L14.2501 7.24985C13.6978 7.24985 13.2501 6.80213 13.2501 6.24985C13.2501 5.69756 13.6978 5.24985 14.2501 5.24985Z" fill="currentColor" />
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
            return 'Mask Hover';
        }
    
        static function className()
        {
            return 'dan-mask-hover';
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
            return ['content' => ['animation' => ['type' => 'fromCenter', 'duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'css_easing' => 'cubic-bezier(.165,.84,.44,1)', 'open_mask_at_the_builder' => false]], 'design' => ['colors' => ['mask_color' => '#eb5939'], 'dimensions' => ['height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto'], 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-mask-hover__content']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Mask Content'], 'settings' => ['advanced' => ['classes' => ['dan-mask-hover__content-wrapper']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Mask Heading']]], 'children' => []]]]];
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
            "colors",
            "Colors",
            [c(
            "mask_color",
            "Mask color",
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
            "open_mask_at_the_builder",
            "Open mask at the builder",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "type",
            "Type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'fromTop', 'text' => 'From top'], ['text' => 'From center', 'value' => 'fromCenter'], ['text' => 'From bottom', 'value' => 'fromBottom']]],
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
            return false;
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
            return false;
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
            return [['name' => 'data-openatbuilder', 'template' => '{% if content.animation.open_mask_at_the_builder %}
        1
        {% else %}
        0
        {% endif %}'], ['name' => 'data-type', 'template' => '{{ content.animation.type }}']];
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
