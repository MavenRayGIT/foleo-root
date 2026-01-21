<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_layer_button_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\LayerButton",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class LayerButton extends \Breakdance\Elements\Element
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
        return 'Layer Button';
    }

    static function className()
    {
        return 'dan-layer-button';
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
        return ['content' => ['content' => ['text' => 'Layer Button', 'tag' => 'span', 'link' => null, 'top_layer_text' => 'Top Layer', 'bottom_layer_text' => 'Bottom layer', 'layer_text' => 'Layer Button', 'swap_text' => 'Swapped!', 'white_space' => 'wrap', 'enable_first_layer' => true, 'enable_fourth_layer' => true, 'enable_third_layer' => true, 'enable_second_layer' => true, 'first_layer_text' => 'First Layer', 'second_layer_text' => 'Second Layer', 'third_layer_text' => 'Third Layer', 'fourth_layer_text' => 'Fourth Layer'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-layer-button--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.1, 'scale_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.75, 'unit' => 's', 'style' => '0.75s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'rotate_duration' => ['number' => 0.75, 'unit' => 's', 'style' => '0.75s'], 'rotate' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'layer_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'layer_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'layer_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'button_styles' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'padding' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'color' => '#FFF', 'background' => '#e3e3e3', 'text_color' => '#000', 'zindex' => 1, 'border_radius' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']], 'button_hover_styles' => ['zindex' => 1, 'transition_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'slug_cant_start_with_number_3d_translate_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'text_color' => '#FFF', 'background' => '#000'], 'first_layer_styles' => ['padding' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'background' => '#3754F5', 'text_color' => '#080808', 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'slug_cant_start_with_number_3d_translate_from' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'zindex' => 0, 'border_radius' => ['all' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'editMode' => 'all']], 'first_layer_hover_styles' => ['slug_cant_start_with_number_3d_translate_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'text_color' => '#080808', 'background' => '#3754F5', 'zindex' => 0, 'transition_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s']], 'second_layer_styles' => ['border_radius' => ['all' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'editMode' => 'all'], 'zindex' => -1, 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'slug_cant_start_with_number_3d_translate_from' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'padding' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'text_color' => '#080808', 'background' => '#D95FF8'], 'second_layer_hover_styles' => ['slug_cant_start_with_number_3d_translate_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'background' => '#D95FF8', 'text_color' => '#080808', 'zindex' => -1, 'transition_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s']], 'third_layer_styles' => ['zindex' => -2, 'text_color' => '#080808', 'background' => '#3754F5', 'border_radius' => ['all' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'editMode' => 'all'], 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'slug_cant_start_with_number_3d_translate_from' => ['number' => 18, 'unit' => 'px', 'style' => '18px'], 'padding' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]], 'third_layer_hover_styles' => ['zindex' => -2, 'transition_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'slug_cant_start_with_number_3d_translate_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'text_color' => '#080808', 'background' => '#3754F5'], 'fourth_layer_styles' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'slug_cant_start_with_number_3d_translate_from' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'padding' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'text_color' => '#080808', 'background' => '#D95FF8', 'zindex' => -3, 'border_radius' => ['all' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'topRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomLeft' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottomRight' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'editMode' => 'all']], 'fourth_layer_hover_styles' => ['text_color' => '#080808', 'background' => '#D95FF8', 'zindex' => -3, 'transition_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'slug_cant_start_with_number_3d_translate_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottom' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'left' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'right' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]], 'spacing_padding_y' => ['padding_top' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => ['button' => '#E3E3E3', 'mask' => '#000000FF'], 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_layer' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_layer' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'button_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'button_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'layer_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'button_background' => ['background' => '#e3e3e3']]];
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
      "EssentialElements\\typography",
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
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
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
        "white_space",
        "White space",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'wrap', 'text' => 'wrap'], ['text' => 'nowrap', 'value' => 'nowrap']]],
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
      ), c(
        "enable_first_layer",
        "Enable first layer",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_second_layer",
        "Enable second layer",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_third_layer",
        "Enable third layer",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_fourth_layer",
        "Enable fourth layer",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "button_styles",
        "Button styles",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
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
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "button_hover_styles",
        "Button hover styles",
        [c(
        "slug_cant_start_with_number_3d_translate_to",
        "3D Translate to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transition_duration",
        "Transition duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "first_layer_styles",
        "First layer styles",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "slug_cant_start_with_number_3d_translate_from",
        "3D Translate from",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
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
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_first_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "first_layer_hover_styles",
        "First layer hover styles",
        [c(
        "slug_cant_start_with_number_3d_translate_to",
        "3D Translate to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transition_duration",
        "Transition duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_first_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "second_layer_styles",
        "Second layer styles",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "slug_cant_start_with_number_3d_translate_from",
        "3D Translate from",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
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
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_second_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "second_layer_hover_styles",
        "Second layer hover styles",
        [c(
        "slug_cant_start_with_number_3d_translate_to",
        "3D Translate to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transition_duration",
        "Transition duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_second_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "third_layer_styles",
        "Third layer styles",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "slug_cant_start_with_number_3d_translate_from",
        "3D Translate from",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
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
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_third_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "third_layer_hover_styles",
        "Third layer hover styles",
        [c(
        "slug_cant_start_with_number_3d_translate_to",
        "3D Translate to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transition_duration",
        "Transition duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_third_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "fourth_layer_styles",
        "Fourth layer styles",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "slug_cant_start_with_number_3d_translate_from",
        "3D Translate from",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'border_radius', 'layout' => 'vertical'],
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
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_fourth_layer', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "fourth_layer_hover_styles",
        "Fourth layer hover styles",
        [c(
        "slug_cant_start_with_number_3d_translate_to",
        "3D Translate to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "text_color",
        "Text color",
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
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transition_duration",
        "Transition duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_fourth_layer', 'operand' => 'is set', 'value' => '']]]],
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
        return false;
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.text']];
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

