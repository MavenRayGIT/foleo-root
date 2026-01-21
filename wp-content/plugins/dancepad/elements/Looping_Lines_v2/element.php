<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_looping_lines_v2_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\LoopingLinesV2",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class LoopingLinesV2 extends \Breakdance\Elements\Element
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
        return 'Looping Lines V2';
    }

    static function className()
    {
        return 'dan-looping-lines-v2';
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
        return ['content' => ['content' => ['items' => [['text' => 'Looping'], ['text' => 'Lines'], ['text' => 'Version 2'], ['text' => '😎😎']], 'prefix' => 'Dancepad', 'gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'lines' => [['text' => 'Looping'], ['text' => 'Lines'], ['text' => 'version 2'], ['text' => '😎😎']]], 'animation' => ['swap_gsap_easing' => 'expo', 'swap_stagger' => 0.02, 'swap_animation_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'box_gsap_easing' => 'back', 'seconds_until_next_line' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'box_animation_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']]], 'design' => ['prefix_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']]], 'fontWeight' => ['breakpoint_base' => '500'], 'fontWeight_hover' => null]]]], 'lines_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']]]]]]], 'box' => ['horizontal_padding' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'vertical_padding' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'background' => ['color' => ['breakpoint_base' => '#b22bf1']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]]]];
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
      "Prefix Typography",
      "prefix_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Lines Typography",
      "lines_typography",
       ['type' => 'popout']
     ), c(
        "box",
        "Box",
        [c(
        "horizontal_padding",
        "Horizontal Padding",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), c(
        "vertical_padding",
        "Vertical Padding",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom'], 'defaultType' => 'px']],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
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
        "lines",
        "Lines",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
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
        "animation",
        "Animation",
        [c(
        "seconds_until_next_line",
        "Seconds until next line",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "box_animation_duration",
        "Box Animation Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "box_gsap_easing",
        "Box GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "swap_animation_duration",
        "Swap Animation Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "swap_stagger",
        "Swap Stagger",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "swap_gsap_easing",
        "Swap GSAP easing",
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
          '0' =>  ['title' => 'Dancepad - Looping Lines v2','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Looping_Lines_v2/dancepad_looping_lines_v2.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_looping_lines_v2();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_looping_lines_v2();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_looping_lines_v2();',
],],

'onCreatedElement' => [['script' => 'dancepad_looping_lines_v2();',
],],

'onMountedElement' => [['script' => 'dancepad_looping_lines_v2();',
],],

'onMovedElement' => [['script' => 'dancepad_looping_lines_v2();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_looping_lines_v2();',
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
        return [['name' => 'data-line-duration', 'template' => '{{ content.animation.seconds_until_next_line.style }}'], ['name' => 'data-box-duration', 'template' => '{{ content.animation.box_animation_duration.style }}'], ['name' => 'data-box-ease', 'template' => '{{ content.animation.box_gsap_easing }}'], ['name' => 'data-letter-duration', 'template' => '{{ content.animation.swap_animation_duration.style }}'], ['name' => 'data-letter-stagger', 'template' => '{{ content.animation.swap_stagger }}'], ['name' => 'data-letter-ease', 'template' => '{{ content.animation.swap_gsap_easing }}'], ['name' => 'data-lines', 'template' => '{% for item in content.content.lines %}
{{ item.text }}dan11
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
        return [['accepts' => 'image_url', 'path' => 'design.box.background.layers[].image']];
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
