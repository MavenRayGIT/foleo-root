<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_arrow_icon_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ArrowIcon",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ArrowIcon extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
      <path d="M16.5 7.5L6 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
      <path d="M8 6.18791C8 6.18791 16.0479 5.50949 17.2692 6.73079C18.4906 7.95209 17.812 16 17.812 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
  </svg>';
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
        return 'Arrow Icon';
    }

    static function className()
    {
        return 'dan-arrow-icon';
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
        return ['content' => ['content' => ['text' => 'Arrow Icon', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Icon', 'swap_text' => 'Swapped!', 'white_space' => 'wrap'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-icon--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.3, 'scale_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'rotate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'rotate' => ['number' => 45, 'unit' => 'deg', 'style' => '45deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'toggle' => '.dan-arrow-icon', 'event' => 'hover', 'enable_scale' => true, 'enable_rotate' => true, 'enable_translate' => true, 'scale_css_easing' => 'ease', 'rotate_css_easing' => 'ease', 'distance_between_arrows' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'translate_css_easing' => 'ease'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'accessibility' => null], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => null]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => ['icon' => '#E3E3E3', 'mask' => '#000000FF', 'background' => '#000'], 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'icon_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'icon_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'icon_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['size_scale_' => 0.5, 'type' => 'type2', 'rotation' => ['number' => -45, 'unit' => 'deg', 'style' => '-45deg'], 'color' => '#FFF'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]], 'dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'height' => ['breakpoint_base' => ['number' => 40, 'unit' => 'px', 'style' => '40px']]]]];
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
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), c(
        "background",
        "Background",
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
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'type1', 'text' => 'Arrow 1'], ['text' => 'Arrow 2', 'value' => 'type2'], ['text' => 'Angle', 'value' => 'type3'], ['text' => 'Angles', 'value' => 'type4'], ['text' => 'Fancy', 'value' => 'type5']]],
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
        "weight",
        "Weight",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "size_scale_",
        "Size (scale)",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg']]],
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
        "animation",
        "Animation",
        [c(
        "toggle",
        "Toggle",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'click', 'value' => 'click']]],
        false,
        false,
        [],
      ), c(
        "enable_scale",
        "Enable Scale",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.enable_scale', 'operand' => 'is set', 'value' => '']]], 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "scale_duration",
        "Scale duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_scale', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "scale_delay",
        "Scale delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_scale', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "scale_css_easing",
        "Scale CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.enable_scale', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_rotate",
        "Enable Rotate",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "rotate",
        "Rotate",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg', 'custom']], 'condition' => [[['path' => 'content.animation.enable_rotate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rotate_duration",
        "Rotate duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_rotate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rotate_delay",
        "Rotate delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_rotate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rotate_css_easing",
        "Rotate CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.enable_rotate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_translate",
        "Enable Translate",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "distance_between_arrows",
        "Distance between arrows",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']], 'condition' => [[['path' => 'content.animation.enable_translate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "translate_duration",
        "Translate duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_translate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "translate_delay",
        "Translate delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']], 'condition' => [[['path' => 'content.animation.enable_translate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "translate_css_easing",
        "Translate CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.enable_translate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "accessibility",
        "Accessibility",
        [c(
        "toggled_by_default",
        "Toggled by default",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "close_when_clicking_outside",
        "Close when clicking outside",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "close_on_esc",
        "Close on ESC",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.event', 'operand' => 'equals', 'value' => 'click']]]],
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
          '0' =>  ['title' => 'Dancepad - Arrow Icon','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Arrow_Icon/dancepad_arrow_icon.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_arrow_icon();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_arrow_icon();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_arrow_icon();',
],],

'onCreatedElement' => [['script' => 'dancepad_arrow_icon();',
],],

'onMountedElement' => [['script' => 'dancepad_arrow_icon();',
],],

'onMovedElement' => [['script' => 'dancepad_arrow_icon();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_arrow_icon();',
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
        return [['name' => 'data-toggle', 'template' => '{{ content.animation.toggle }}'], ['name' => 'data-trigger', 'template' => '{{ content.animation.event }}'], ['name' => 'data-closeesc', 'template' => '{{ content.accessibility.close_on_esc }}'], ['name' => 'data-closeclick', 'template' => '{{ content.accessibility.close_when_clicking_outside }}'], ['name' => 'data-active', 'template' => '{{ content.accessibility.toggled_by_default }}'], ['name' => 'data-enable-scale', 'template' => '{{ content.animation.enable_scale }}'], ['name' => 'data-enable-rotate', 'template' => '{{ content.animation.enable_rotate }}'], ['name' => 'data-enable-transform', 'template' => '{{ content.animation.enable_translate }}']];
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance']];
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

