<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_looping_lines_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\LoopingLines",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class LoopingLines extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path opacity="0.4" d="M3 9L14 9.00008" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />     <path d="M3 15H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />     <path opacity="0.4" d="M3 3H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />     <path d="M18.5 21V9M18.5 21C17.7998 21 16.4915 19.0057 16 18.5M18.5 21C19.2002 21 20.5085 19.0057 21 18.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> </svg>';
        }
    
        static function tag()
        {
            return 'div';
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
            return 'Looping Lines';
        }
    
        static function className()
        {
            return 'dan-looping-lines';
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
            return ['content' => ['content' => ['text' => 'Blur Reveal', 'tag' => 'span', 'link' => null, 'items' => [['text' => 'My First Word'], ['text' => 'My Second Word'], ['text' => 'My Third Word'], ['text' => 'My Fourth Word'], ['text' => 'My Fifth Word']]], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'lines' => ['line_height' => ['number' => 22, 'unit' => 'px', 'style' => '22px'], 'lines_to_show' => 3, 'align' => 'left', 'fade' => true, 'color' => '#FFFFFFFF', 'fade_color' => '#FFFFFFFF', 'prefix' => '', 'gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My first line']]]], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My second line']]]], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My third line']]]], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My fourth line']]]], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My fifth line']]]], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'My sixth line']]]]];
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
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "prefix",
            "Prefix",
            [],
            ['type' => 'text', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "gap",
            "Gap",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "items",
            "Items",
            [c(
            "text",
            "Text",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
            false,
            false,
            [],
          ), c(
            "link",
            "Link",
            [],
            ['type' => 'link', 'layout' => 'vertical'],
            false,
            false,
            [],
          )],
            ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "lines",
            "Lines",
            [c(
            "line_height",
            "Line height",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "lines_to_show",
            "Lines to show",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "align",
            "Align",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'left', 'text' => 'Left'], ['text' => 'Center', 'value' => 'center'], ['text' => 'Right', 'value' => 'right']]],
            false,
            false,
            [],
          ), c(
            "fade",
            "Fade",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "fade_color",
            "Fade color",
            [],
            ['type' => 'color', 'layout' => 'inline', 'condition' => [[['path' => 'content.lines.fade', 'operand' => 'is set', 'value' => '']]]],
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
            return ['0' =>  ['title' => 'Dancepad - Looping Lines','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Looping_Lines/dancepad_looping_lines.min.js?ver=' . DANCEPAD_VERSION],],
            '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_looping_lines();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_looping_lines();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
            '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],]];
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
    
    'onPropertyChange' => [['script' => 'dancepad_looping_lines();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_looping_lines();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_looping_lines();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_looping_lines();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_looping_lines();',
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
            return [['name' => 'data-split', 'template' => '{{ content.animation.split_type }}'], ['name' => 'data-stagger', 'template' => '{{ content.animation.stagger }}'], ['name' => 'data-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-delay', 'template' => '{{ content.animation.delay.style }}'], ['name' => 'data-easing', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-trigger', 'template' => '{{ content.scrolltrigger.trigger }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-end', 'template' => '{{ content.scrolltrigger.end }}'], ['name' => 'data-scrub', 'template' => '{{ content.scrolltrigger.scrub }}'], ['name' => 'data-toggleactions', 'template' => '{{ content.scrolltrigger.toggleactions }}'], ['name' => 'data-additional_triggers', 'template' => '{{ content.scrolltrigger.additional_triggers }}'], ['name' => 'data-element', 'template' => '{{ content.scrolltrigger.element }}'], ['name' => 'data-blur-from', 'template' => '{{ content.animation.blur.style }}']];
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.items[].text']];
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
