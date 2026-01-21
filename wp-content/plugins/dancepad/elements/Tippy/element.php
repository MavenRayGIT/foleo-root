<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_tippy_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Tippy",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Tippy extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M6.09881 19C4.7987 18.8721 3.82475 18.4816 3.17157 17.8284C2 16.6569 2 14.7712 2 11V10.5C2 6.72876 2 4.84315 3.17157 3.67157C4.34315 2.5 6.22876 2.5 10 2.5H14C17.7712 2.5 19.6569 2.5 20.8284 3.67157C22 4.84315 22 6.72876 22 10.5V11C22 14.7712 22 16.6569 20.8284 17.8284C19.6569 19 17.7712 19 14 19C13.4395 19.0125 12.9931 19.0551 12.5546 19.155C11.3562 19.4309 10.2465 20.0441 9.14987 20.5789C7.58729 21.3408 6.806 21.7218 6.31569 21.3651C5.37769 20.6665 6.29454 18.5019 6.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
    <path d="M14 2.5H10C6.22876 2.5 4.34315 2.5 3.17157 3.67157C2 4.84315 2 6.72876 2 10.5V11C2 14.7712 2 16.6569 3.17157 17.8284C3.82475 18.4816 4.7987 18.8721 6.09881 19M14 19C13.4395 19.0125 12.9931 19.0551 12.5546 19.155C11.3562 19.4309 10.2465 20.0441 9.14987 20.5789C7.58729 21.3408 6.806 21.7218 6.31569 21.3651C5.37769 20.6665 6.29454 18.5019 6.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
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
        return 'Tippy';
    }

    static function className()
    {
        return 'dan-tippy';
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
        return ['content' => ['default' => ['tippy_elements' => [['text' => 'My Tooltip', 'font_size' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'border_radius' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'border_width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'show_duration' => 300, 'hide_duration' => 200, 'show_delay' => 100, 'hide_delay' => 50, 'arrow' => true, 'event' => 'mouseenter', 'animation' => 'scale', 'inertia' => true, 'follow_cursor' => 'false', 'interactive' => true, 'hide_on_click' => true, 'placement' => 'top', 'max_width' => ['number' => 'none', 'unit' => 'custom', 'style' => 'none'], 'zindex' => 9999, 'background' => '#000', 'color' => '#FFF', 'border_color' => 'none', 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottom' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'left' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'right' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]]], 'font_family' => 'gfont-abeezee', 'spacing_padding_y' => ['padding_top' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'padding_top' => ['number' => 7, 'unit' => 'px', 'style' => '7px'], 'padding_bottom' => ['number' => 7, 'unit' => 'px', 'style' => '7px'], 'padding_left' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'padding_right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'element' => null, 'arrow_color' => '#000', 'typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontFamily' => null]]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']], 'border' => null]]]]]];
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
        return [];
    }

    static function contentControls()
    {
        return [c(
        "default",
        "Default",
        [c(
        "tippy_elements",
        "Tippy elements",
        [c(
        "element",
        "Element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className'],
        false,
        false,
        [],
      ), c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "show_duration",
        "Show duration",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_duration",
        "Hide duration",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "arrow",
        "Arrow",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "arrow_color",
        "Arrow color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "show_delay",
        "Show delay",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hide_delay",
        "Hide delay",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'mouseenter', 'text' => 'mouseenter'], ['text' => 'click', 'value' => 'click']]],
        false,
        false,
        [],
      ), c(
        "animation",
        "Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'fade', 'text' => 'fade'], ['text' => 'scale', 'value' => 'scale'], ['text' => 'shift-toward', 'value' => 'shift-toward'], ['text' => 'shift-away', 'value' => 'shift-away'], ['text' => 'perspective', 'value' => 'perspective']]],
        false,
        false,
        [],
      ), c(
        "inertia",
        "Inertia",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "follow_cursor",
        "Follow cursor",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'false', 'text' => 'false'], ['text' => 'true', 'value' => 'true'], ['text' => 'horizontal', 'value' => 'horizontal'], ['text' => 'vertical', 'value' => 'vertical'], ['text' => 'initial', 'value' => 'initial']]],
        false,
        false,
        [],
      ), c(
        "hide_on_click",
        "Hide on click",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "interactive",
        "Interactive",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "max_width",
        "Max width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        false,
        false,
        [],
      ), c(
        "placement",
        "Placement",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top', 'text' => 'top'], ['text' => 'left', 'value' => 'left'], ['text' => 'right', 'value' => 'right'], ['text' => 'bottom', 'value' => 'bottom']]],
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
        "touch",
        "Touch",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
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
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return ['0' =>  ['title' => 'Dancepad - Tippy','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Tippy/dancepad_tippy.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Dancepad - Popper library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_popper.min.js?ver=' . DANCEPAD_VERSION],],'2' =>  ['title' => 'Dancepad - Tippy library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_tippy.min.js?ver=' . DANCEPAD_VERSION],],'3' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_tippy();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'4' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_tippy();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],'5' =>  ['title' => 'Dancepad - Scale stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_scale.min.css'],],'6' =>  ['title' => 'Dancepad - Shiftaway stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_shiftaway.min.css'],],'7' =>  ['title' => 'Dancepad - Shifttoward stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_shifttoward.min.css'],],'8' =>  ['title' => 'Dancepad - Perspective stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_perspective.min.css'],],];
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

'onPropertyChange' => [['script' => 'dancepad_tippy();',
],],

'onCreatedElement' => [['script' => 'dancepad_tippy();',
],],

'onMountedElement' => [['script' => 'dancepad_tippy();',
],],

'onMovedElement' => [['script' => 'dancepad_tippy();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_tippy();',
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.default.tippy_elements[].text']];
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

