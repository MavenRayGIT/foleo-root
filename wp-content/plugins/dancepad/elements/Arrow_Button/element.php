<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_arrow_button') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ArrowButton",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ArrowButton extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path fill-rule="evenodd" clip-rule="evenodd" d="M16.4635 1.37373C15.3214 1.24999 13.8818 1.24999 12.0453 1.25H11.9547C10.1182 1.24999 8.67861 1.24999 7.53648 1.37373C6.37094 1.50001 5.42656 1.76232 4.62024 2.34815C4.13209 2.70281 3.70281 3.13209 3.34815 3.62024C2.76232 4.42656 2.50001 5.37094 2.37373 6.53648C2.24999 7.67861 2.24999 9.11822 2.25 10.9548V13.0453C2.24999 14.8818 2.24999 16.3214 2.37373 17.4635C2.50001 18.6291 2.76232 19.5734 3.34815 20.3798C3.70281 20.8679 4.13209 21.2972 4.62024 21.6518C5.42656 22.2377 6.37094 22.5 7.53648 22.6263C8.67859 22.75 10.1182 22.75 11.9547 22.75H12.0453C13.8818 22.75 15.3214 22.75 16.4635 22.6263C17.6291 22.5 18.5734 22.2377 19.3798 21.6518C19.8679 21.2972 20.2972 20.8679 20.6518 20.3798C21.2377 19.5734 21.5 18.6291 21.6263 17.4635C21.75 16.3214 21.75 14.8818 21.75 13.0453V10.9547C21.75 9.11824 21.75 7.67859 21.6263 6.53648C21.5 5.37094 21.2377 4.42656 20.6518 3.62024C20.2972 3.13209 19.8679 2.70281 19.3798 2.34815C18.5734 1.76232 17.6291 1.50001 16.4635 1.37373ZM7 7C7 6.44772 7.44772 6 8 6H16C16.5523 6 17 6.44772 17 7C17 7.55228 16.5523 8 16 8H8C7.44772 8 7 7.55228 7 7ZM9.5 12C9.5 11.4477 9.94772 11 10.5 11H13.5C14.0523 11 14.5 11.4477 14.5 12C14.5 12.5523 14.0523 13 13.5 13H10.5C9.94772 13 9.5 12.5523 9.5 12Z" fill="currentColor" /> </svg>';
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
        return 'Arrow Button';
    }

    static function className()
    {
        return 'dan-arrow-button';
    }

    static function category()
    {
        return 'dancepad_buttons';
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
        return ['content' => ['content' => ['text' => 'Arrow Button', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Button', 'swap_text' => 'Swapped!', 'white_space' => 'wrap', 'include_swap_text' => 'enable'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-button--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.1, 'scale_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.75, 'unit' => 's', 'style' => '0.75s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'rotate_duration' => ['number' => 0.75, 'unit' => 's', 'style' => '0.75s'], 'rotate' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'arrow_animation' => ['scale' => 1.25, 'distance_between_arrows' => ['number' => 300, 'unit' => '%', 'style' => '300%'], 'duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'css_easing' => 'cubic-bezier(0.1, 0, 0.3, 1)'], 'swap_text_animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'css_easing' => 'cubic-bezier(0.1, 0, 0.3, 1)']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottom' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'left' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'right' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]], 'spacing_padding_y' => ['padding_top' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => ['button' => '#E3E3E3', 'mask' => '#000000FF'], 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'button_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'button_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'button_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['background' => '#000', 'type' => 'type2', 'dimensions' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'position' => 'row-reverse', 'rotation' => ['number' => -45, 'unit' => 'deg', 'style' => '-45deg'], 'color' => '#fff', 'weight' => 0.1, 'border_radius' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all'], 'padding' => ['breakpoint_base' => ['left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'label_typography' => ['text_align' => ['breakpoint_base' => 'center'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => null]], 'button_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all']]], 'button_padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'button_gap' => ['gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]]];
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
      "Button Margin",
      "button_margin",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Button Padding",
      "button_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Button Border",
      "button_border",
       ['type' => 'popout']
     ), c(
        "button_background",
        "Button Background",
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
      ), c(
        "button_gap",
        "Button Gap",
        [c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Label Typography",
      "label_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Label Padding",
      "label_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Label Border",
      "label_border",
       ['type' => 'popout']
     ), c(
        "label_background",
        "Label Background",
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
      ), c(
        "arrow_styles",
        "Arrow styles",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [
            ['value' => 'type1', 'text' => 'Arrow 1'], 
            ['text' => 'Arrow 2', 'value' => 'type2'], 
            ['text' => 'Angle', 'value' => 'type3'], 
            ['text' => 'Angles', 'value' => 'type4'],
            ['text' => 'Fancy', 'value' => 'type5']
        ]],
        false,
        false,
        [],
      ), c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        true,
        false,
        [],
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'row', 'text' => 'Left'], ['text' => 'Right', 'value' => 'row-reverse']]],
        false,
        false,
        [],
      ), c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        true,
        false,
        [],
      ), c(
        "weight",
        "Weight",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "rotation",
        "Rotation",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg', 'custom']]],
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
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border",
        "Border",
        [],
        ['type' => 'border_complex', 'layout' => 'vertical'],
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
        "content",
        "Content",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
        false,
        false,
        [],
      ), c(
        "include_swap_text",
        "Include Swap Text",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'enable', 'text' => 'enable'], ['text' => 'disable', 'value' => 'disable']]],
        false,
        false,
        [],
      ), c(
        "swap_text",
        "Swap Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.include_swap_text', 'operand' => 'equals', 'value' => 'enable']]], 'textOptions' => ['multiline' => true]],
        false,
        false,
        [],
      ), c(
        "tag",
        "Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'div', 'text' => 'div'], ['text' => 'button', 'value' => 'button'], ['text' => 'span', 'value' => 'span']]],
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
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "swap_text_animation",
        "Swap Text Animation",
        [c(
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
        "arrow_animation",
        "Arrow Animation",
        [c(
        "distance_between_arrows",
        "Distance between arrows",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
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
        return ["type" => "final",   ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'data-swap', 'template' => '{{ content.content.include_swap_text }}']];
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.content.swap_text']];
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
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}

}
