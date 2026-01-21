<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_interactive_divider_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\InteractiveDivider",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class InteractiveDivider extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 11.4477 2.44772 11 3 11L20 11C20.5523 11 21 11.4477 21 12C21 12.5523 20.5523 13 20 13L3 13C2.44772 13 2 12.5523 2 12Z" fill="currentColor" />
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
            return 'Interactive Divider';
        }
    
        static function className()
        {
            return 'dan-interactive-divider';
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
            return ['content' => ['animation' => ['drag_distance' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'drop_distance' => ['number' => 500, 'unit' => 'px', 'style' => '500px'], 'bend_intensity' => 100]], 'design' => ['colors' => ['color' => '#000'], 'dimensions' => ['height' => ['breakpoint_base' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]], 'size' => ['height' => null, 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]]];
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
         ), c(
            "dimensions",
            "Dimensions",
            [c(
            "width",
            "Width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            true,
            false,
            [],
          ), c(
            "max_width",
            "max Width",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
            false,
            false,
            [],
          ), c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
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
            "drag_distance",
            "Drag distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
            false,
            false,
            [],
          ), c(
            "drop_distance",
            "Drop distance",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
            false,
            false,
            [],
          ), c(
            "bend_intensity",
            "Bend intensity",
            [],
            ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
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
            return ['0' =>  ['title' => 'Dancepad - Interactive Divider','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Interactive_Divider/dancepad_interactive_divider.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_interactive_divider();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_interactive_divider();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_interactive_divider();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_interactive_divider();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_interactive_divider();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_interactive_divider();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_interactive_divider();',
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
            return [['name' => 'data-bend-intensity', 'template' => '{{ content.animation.bend_intensity }}']];
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
