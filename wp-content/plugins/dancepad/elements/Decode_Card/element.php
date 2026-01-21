<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_decode_card_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\DecodeCard",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class DecodeCard extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M11.9255 1.5H12.0745C14.2504 1.49998 15.9852 1.49996 17.3453 1.68282C18.7497 1.87164 19.9035 2.27175 20.8159 3.18414C21.7283 4.09653 22.1284 5.25033 22.3172 6.65471C22.5 8.01485 22.5 9.74959 22.5 11.9256V12.0744C22.5 14.2504 22.5 15.9851 22.3172 17.3453C22.1284 18.7497 21.7283 19.9035 20.8159 20.8159C19.9035 21.7283 18.7497 22.1284 17.3453 22.3172C15.9851 22.5 14.2504 22.5 12.0744 22.5H11.9256C9.74959 22.5 8.01485 22.5 6.65471 22.3172C5.25033 22.1284 4.09653 21.7283 3.18414 20.8159C2.27175 19.9035 1.87164 18.7497 1.68282 17.3453C1.49996 15.9852 1.49998 14.2504 1.5 12.0745V11.9255C1.49998 9.74957 1.49996 8.01485 1.68282 6.65471C1.87164 5.25033 2.27175 4.09653 3.18414 3.18414C4.09653 2.27175 5.25033 1.87164 6.65471 1.68282C8.01485 1.49996 9.74957 1.49998 11.9255 1.5ZM6.92121 3.66499C5.7386 3.82399 5.0772 4.1195 4.59835 4.59835C4.1195 5.0772 3.82399 5.7386 3.66499 6.92121C3.50212 8.13258 3.5 9.73256 3.5 12C3.5 14.2674 3.50212 15.8674 3.66499 17.0788C3.82399 18.2614 4.1195 18.9228 4.59835 19.4017C5.0772 19.8805 5.7386 20.176 6.92121 20.335C8.13258 20.4979 9.73256 20.5 12 20.5C14.2674 20.5 15.8674 20.4979 17.0788 20.335C18.2614 20.176 18.9228 19.8805 19.4017 19.4017C19.8805 18.9228 20.176 18.2614 20.335 17.0788C20.4979 15.8674 20.5 14.2674 20.5 12C20.5 9.73256 20.4979 8.13258 20.335 6.92121C20.176 5.7386 19.8805 5.0772 19.4017 4.59835C18.9228 4.1195 18.2614 3.82399 17.0788 3.66499C15.8674 3.50212 14.2674 3.5 12 3.5C9.73256 3.5 8.13258 3.50212 6.92121 3.66499Z" fill="currentColor" />
    <path d="M12.0745 1.5C14.2504 1.49998 15.9852 1.49996 17.3453 1.68282C18.7497 1.87164 19.9035 2.27175 20.8159 3.18414C21.7283 4.09653 22.1284 5.25033 22.3172 6.65471C22.5 8.01485 22.5 9.74959 22.5 11.9256V12H20.5C20.5 9.73256 20.4979 8.13258 20.335 6.92121C20.176 5.7386 19.8805 5.0772 19.4017 4.59835C18.9228 4.1195 18.2614 3.82399 17.0788 3.66499C15.8674 3.50212 14.2674 3.5 12 3.5C9.73256 3.5 8.13258 3.50212 6.92121 3.66499C5.7386 3.82399 5.0772 4.1195 4.59835 4.59835C4.1195 5.0772 3.82399 5.7386 3.66499 6.92121C3.50212 8.13258 3.5 9.73256 3.5 12H1.5V11.9255V11.9255C1.49998 9.74957 1.49996 8.01484 1.68282 6.65471C1.87164 5.25033 2.27175 4.09653 3.18414 3.18414C4.09653 2.27175 5.25033 1.87164 6.65471 1.68282C8.01484 1.49996 9.74957 1.49998 11.9255 1.5H11.9255H12.0745H12.0745Z" fill="currentColor" />
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
        return 'Decode Card';
    }

    static function className()
    {
        return 'dan-decode-card';
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
        return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'height' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']]], 'colors' => ['background' => '#000'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'editMode' => 'all']]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'content' => ['decode_settings' => ['css_easing' => 'ease', 'duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'backdrop_blur' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'gradient_left' => '#00ff00', 'gradient_right' => '#ff0000', 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'fontWeight' => ['breakpoint_base' => '700'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']]]]]]]], 'content_mask' => ['size' => ['number' => 150, 'unit' => 'px', 'style' => '150px'], 'radius' => ['number' => 9999, 'unit' => 'px', 'style' => '9999px'], 'blur' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'color' => '#000', 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '700']]]]]], 'animation' => ['characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 'text_length' => 2500, 'gradient_size' => 250, 'include_characters' => true]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content Mask'], 'settings' => ['advanced' => ['classes' => ['dan-decode-card__hover-container']]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_vertical_align' => ['breakpoint_base' => 'center'], 'v_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Decode']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff']]]], 'children' => []]]]];
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
      "EssentialElements\\borders",
      "Borders",
      "borders",
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
        "background",
        "Background",
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
        "decode_settings",
        "Decode Settings",
        [getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "gradient_left",
        "Gradient Left",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "gradient_right",
        "Gradient Right",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "backdrop_blur",
        "Backdrop Blur",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
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
      ), c(
        "content_mask",
        "Content Mask",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
      ), c(
        "radius",
        "Radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
        false,
        false,
        [],
      ), c(
        "blur",
        "Blur",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "animation",
        "Animation",
        [c(
        "include_characters",
        "Include Characters",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "characters",
        "Characters",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.include_characters', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "text_length",
        "Text Length",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.include_characters', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "gradient_size",
        "Gradient Size",
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
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return [
          '0' =>  ['title' => 'Dancepad - Decode Card','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Decode_Card/dancepad_decode_card.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_decode_card();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_decode_card();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_decode_card();',
],],

'onCreatedElement' => [['script' => 'dancepad_decode_card();',
],],

'onMountedElement' => [['script' => 'dancepad_decode_card();',
],],

'onMovedElement' => [['script' => 'dancepad_decode_card();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_decode_card();',
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
        return [['name' => 'data-characters', 'template' => '{{ content.animation.characters }}'], ['name' => 'data-text-length', 'template' => '{{ content.animation.text_length }}'], ['name' => 'data-gradient-size', 'template' => '{{ content.animation.gradient_size }}'], ['name' => 'data-include-characters', 'template' => '{% if content.animation.include_characters %}
1
{% else %}
0
{% endif %}']];
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
