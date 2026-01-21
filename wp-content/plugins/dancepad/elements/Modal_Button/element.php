<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_modal_button_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ModalButton",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ModalButton extends \Breakdance\Elements\Element
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
        return false;
    }

    static function name()
    {
        return 'Modal Button';
    }

    static function className()
    {
        return 'dan-modal-button';
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
        return ['content' => ['content' => ['text' => 'Modal Button', 'tag' => 'span', 'link' => null, 'items' => [['text' => '+123456789'], ['text' => 'great@mydomain.com']]], 'animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'ease', 'new_control' => null, 'translate_items_on_click' => ['number' => 2, 'unit' => 'px', 'style' => '2px']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#000'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.2', 'unit' => 'custom', 'style' => '1.2']]], 'fontWeight' => null, 'fontWeight_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'color' => 'transparent', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'color' => 'transparent', 'style' => 'solid'], 'left' => ['width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'color' => 'transparent', 'style' => 'solid'], 'right' => ['width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'color' => 'transparent', 'style' => 'solid']]]], 'arrow' => ['gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'dimensions' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'arrow_dimensions' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'button_label' => ['gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'arrow_dimensions' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'background' => '#e3e3e3'], 'button' => ['gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'arrow_dimensions' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'background' => '#E3E3E3FF'], 'modal_items' => ['background_on_hover' => '#00000012', 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-a4793b9d-030e-4c93-bd1f-1f05a43fe9e0'], 'border_radius' => ['all' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'topRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomLeft' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'bottomRight' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'editMode' => 'all'], 'margin' => ['breakpoint_base' => ['left' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'right' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'top' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottom' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]], 'padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'modal_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontWeight' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']]]]]], 'color' => ['breakpoint_base' => '#000']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]]]];
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
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "button",
        "Button",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        true,
        false,
        [],
      ), c(
        "arrow_dimensions",
        "Arrow dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "modal_items",
        "Modal Items",
        [c(
        "margin",
        "Margin",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        true,
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
        "background_on_hover",
        "Background on hover",
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
      ), getPresetSection(
      "EssentialElements\\typography",
      "Modal Typography",
      "modal_typography",
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
        ['type' => 'text', 'layout' => 'vertical'],
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
        "animation",
        "Animation",
        [c(
        "translate_items_on_click",
        "Translate items on click",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "css_easing",
        "CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
        return ['0' =>  ['title' => 'Dancepad - Modal Button','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Modal_Button/dancepad_modal_button.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_modal_button();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_modal_button();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_modal_button();',
],],

'onCreatedElement' => [['script' => 'dancepad_modal_button();',
],],

'onMountedElement' => [['script' => 'dancepad_modal_button();',
],],

'onMovedElement' => [['script' => 'dancepad_modal_button();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_modal_button();',
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

