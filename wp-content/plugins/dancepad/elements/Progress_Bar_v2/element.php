<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_progress_bar_v2_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\ProgressBarV2",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class ProgressBarV2 extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
                <path d="M12.0839 3.25006C12.4647 3.24965 12.7932 3.24931 13.0823 3.32678C13.8588 3.53483 14.4653 4.14132 14.6733 4.91777C14.7508 5.20692 14.7505 5.53544 14.7501 5.91623V18.084C14.7505 18.4648 14.7508 18.7933 14.6733 19.0825C14.4653 19.8589 13.8588 20.4654 13.0823 20.6735C12.7932 20.7509 12.4647 20.7506 12.0839 20.7502C11.7031 20.7506 11.2068 20.7509 10.9177 20.6735C10.1412 20.4654 9.53471 19.8589 9.32666 19.0825C9.24918 18.7933 9.24953 18.4648 9.24994 18.084V5.91623C9.24953 5.53544 9.24918 5.20692 9.32666 4.91777C9.53471 4.14132 10.1412 3.53483 10.9177 3.32678C11.2068 3.24931 11.7031 3.24965 12.0839 3.25006Z" fill="currentColor" />
                <path opacity="0.4" d="M19.0839 3.25006C19.4647 3.24965 19.7932 3.24931 20.0823 3.32678C20.8588 3.53483 21.4653 4.14132 21.6733 4.91777C21.7508 5.20692 21.7505 5.53544 21.7501 5.91623V8.084C21.7505 8.46479 21.7508 8.79331 21.6733 9.08246C21.4653 9.85892 20.8588 10.4654 20.0823 10.6734C19.7932 10.7509 19.2969 10.7506 18.9161 10.7502C18.5353 10.7506 18.2068 10.7509 17.9177 10.6734C17.1412 10.4654 16.5347 9.85892 16.3267 9.08246C16.2492 8.79331 16.2495 8.46479 16.2499 8.084V5.91623C16.2495 5.53544 16.2492 5.20692 16.3267 4.91777C16.5347 4.14132 17.1412 3.53483 17.9177 3.32678C18.2068 3.24931 18.7031 3.24965 19.0839 3.25006Z" fill="currentColor" />
                <path opacity="0.4" d="M5.08388 3.25006C5.46467 3.24965 5.79319 3.24931 6.08234 3.32678C6.85879 3.53483 7.46528 4.14132 7.67333 4.91777C7.7508 5.20692 7.75046 5.53544 7.75005 5.91623V12.084C7.75046 12.4648 7.7508 12.7933 7.67333 13.0825C7.46528 13.8589 6.85879 14.4654 6.08234 14.6734C5.79319 14.7509 5.46468 14.7506 5.08389 14.7502H5.08388C4.70309 14.7506 4.2068 14.7509 3.91765 14.6734C3.14119 14.4654 2.53471 13.8589 2.32666 13.0825C2.24918 12.7933 2.24953 12.4648 2.24994 12.084V5.91623C2.24953 5.53544 2.24918 5.20692 2.32666 4.91777C2.53471 4.14132 3.14119 3.53483 3.91765 3.32678C4.2068 3.24931 4.70308 3.24965 5.08388 3.25006Z" fill="currentColor" />
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
            return 'Progress Bar V2';
        }
    
        static function className()
        {
            return 'dan-progress-bar-v2';
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
            return ['design' => ['position' => ['zindex' => 9999, 'top' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'progress' => ['colors' => [['color' => '#A97CF8'], ['color' => '#F38CB8'], ['color' => '#FDCC92']], 'height' => ['breakpoint_base' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]]], 'content' => ['animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'gsap_easing' => 'expo']]];
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
            return [c(
            "position",
            "Position",
            [c(
            "zindex",
            "zIndex",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "top",
            "Top",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom', 'vh']]],
            true,
            false,
            [],
          ), c(
            "bottom",
            "Bottom",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom', 'vh']]],
            true,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "progress",
            "Progress",
            [c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
            true,
            false,
            [],
          ), c(
            "colors",
            "Colors",
            [c(
            "color",
            "Color",
            [],
            ['type' => 'color', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
            false,
            false,
            [],
          )],
            ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
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
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "gsap_easing",
            "GSAP easing",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
              '0' =>  ['title' => 'Dancepad - Progress Bar v2','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Progress_Bar_v2/dancepad_progress_bar_v2.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_progress_bar_v2();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_progress_bar_v2();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
              '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],]
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
    
    'onPropertyChange' => [['script' => 'dancepad_progress_bar_v2();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_progress_bar_v2();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_progress_bar_v2();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_progress_bar_v2();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_progress_bar_v2();',
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
            return [['name' => 'data-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-gradient-colors', 'template' => '{% for item in design.progress.colors %}
    {{ item.color }}dan11
    {% endfor %}']];
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
