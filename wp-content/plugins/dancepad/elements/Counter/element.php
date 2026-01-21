<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_counter_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Counter",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Counter extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
      <path d="M7 10.0002V3.94897C7 3.37446 7 3.0872 6.76959 3.01571C6.26306 2.85855 5.5 3.99988 5.5 3.99988M7 10.0002H5.5M7 10.0002H8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M9 17.5V15.75C9 14.925 9 14.5126 8.70711 14.2563C8.41421 14 7.94281 14 7 14C6.05719 14 5.58579 14 5.29289 14.2563C5 14.5126 5 14.925 5 15.75C5 16.575 5 16.9874 5.29289 17.2437C5.58579 17.5 6.05719 17.5 7 17.5H9ZM9 17.5V18.375C9 19.6124 9 20.2312 8.56066 20.6156C8.12132 21 7.41421 21 6 21H5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      <path opacity="0.4" d="M16.5 20V4M16.5 20C15.7998 20 14.4915 18.0057 14 17.5M16.5 20C17.2002 20 18.5085 18.0057 19 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  </svg>';
    }

    static function tag()
    {
        return 'span';
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
        return 'Counter';
    }

    static function className()
    {
        return 'dan-counter';
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
        return ['content' => ['content' => ['text' => 'Counter', 'tag' => 'span', 'link' => null, 'start_from' => 0, 'end_to' => 1252.5, 'thousands_separator' => '.', 'decimals_separator' => ',', 'end_at' => 1252.5], 'animation' => ['duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.1, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'unfold' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'intensity' => 600, 'direction' => 'left', 'easing' => '--dan-counter-expo'], 'scrolltrigger' => ['additional_triggers' => 'click', 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none', 'scrub' => false, 'element' => '.dan-counter']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'spacing' => ['margin' => null], 'thousands_typography' => null, 'decimals_typography' => ['color' => null, 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]], 'color_hover' => null], 'separators_typography' => null, 'general_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'fontFamily' => null, 'fontWeight' => null, 'fontWeight_hover' => null, 'advanced' => null, 'fontFamily_hover' => null, 'advanced_hover' => null]]], 'color' => null, 'color_hover' => null]]];
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
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "General Typography",
      "general_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Thousands Typography",
      "thousands_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Decimals Typography",
      "decimals_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Separators Typography",
      "separators_typography",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "tag",
        "Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'h1', 'text' => 'H1'], ['text' => 'H2', 'value' => 'h2'], ['text' => 'H3', 'value' => 'h3'], ['text' => 'H4', 'value' => 'h4'], ['text' => 'H5', 'value' => 'h5'], ['text' => 'H6', 'value' => 'h6'], ['text' => 'p', 'value' => 'p'], ['text' => 'span', 'value' => 'span']]],
        false,
        false,
        [],
      ), c(
        "start_from",
        "Start from",
        [],
        ['type' => 'number', 'layout' => 'inline', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
        false,
        false,
        [],
      ), c(
        "end_at",
        "End at",
        [],
        ['type' => 'number', 'layout' => 'inline', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
        false,
        false,
        [],
      ), c(
        "thousands_separator",
        "Thousands Separator",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "decimals_separator",
        "Decimals Separator",
        [],
        ['type' => 'text', 'layout' => 'inline'],
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
        "delay",
        "Delay",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "easing",
        "Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => '--dan-counter-basic', 'text' => 'basic'], ['text' => 'back', 'value' => '--dan-counter-back'], ['text' => 'expo', 'value' => '--dan-counter-expo'], ['text' => 'sine', 'value' => '--dan-counter-sine'], ['text' => 'power', 'value' => '--dan-counter-power'], ['text' => 'circ', 'value' => '--dan-counter-circ'], ['text' => 'bounce', 'value' => '--dan-counter-bounce'], ['text' => 'elastic', 'value' => '--dan-counter-elastic']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "scrolltrigger",
        "ScrollTrigger",
        [c(
        "trigger",
        "Trigger",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "additional_triggers",
        "Additional Triggers",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'Click'], ['text' => 'Hover', 'value' => 'mouseover']]],
        false,
        false,
        [],
      ), c(
        "element",
        "Element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'click']], [['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'hover']]]],
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
            '0' =>  ['title' => 'Dancepad - Counter','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Counter/dancepad_counter.min.js?ver=' . DANCEPAD_VERSION],],
            '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_counter();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_counter();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_counter();',
],],

'onCreatedElement' => [['script' => 'dancepad_counter();',
],],

'onMountedElement' => [['script' => 'dancepad_counter();',
],],

'onMovedElement' => [['script' => 'dancepad_counter();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_counter();',
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
        return [['name' => 'data-delay', 'template' => '{{ content.animation.delay.style }}'], ['name' => 'data-trigger', 'template' => '{{ content.scrolltrigger.trigger }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-event-selector', 'template' => '{{ content.scrolltrigger.element }}'], ['name' => 'data-event', 'template' => '{{ content.scrolltrigger.additional_triggers }}'], ['name' => 'data-decimal-separator', 'template' => '{{ content.content.decimals_separator }}'], ['name' => 'data-thousands-separator', 'template' => '{{ content.content.thousands_separator }}'], ['name' => 'data-start-number', 'template' => '{{ content.content.start_from }}'], ['name' => 'data-end-number', 'template' => '{{ content.content.end_at }}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.start_from'], ['accepts' => 'string', 'path' => 'content.content.end_at']];
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
