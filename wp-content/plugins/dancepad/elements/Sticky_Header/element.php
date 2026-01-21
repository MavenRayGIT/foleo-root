<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_sticky_header_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\StickyHeader",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class StickyHeader extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.95192 2.25002H14.0488C15.6473 2.25 16.9138 2.25 17.9231 2.36968C18.9614 2.4928 19.8145 2.75052 20.5456 3.3264C21.0466 3.7211 21.4782 4.20798 21.8233 4.76248C22.3183 5.55782 22.5388 6.47839 22.6454 7.61633C22.6484 7.64841 22.6513 7.68072 22.6541 7.71327C22.6955 8.18825 22.7162 8.42575 22.5676 8.58788C22.419 8.75002 22.1718 8.75002 21.6774 8.75002H2.32341C1.82901 8.75002 1.58181 8.75002 1.43319 8.58788C1.28456 8.42575 1.30525 8.18825 1.34662 7.71327C1.34946 7.68072 1.35238 7.64841 1.35538 7.61633C1.462 6.47839 1.68244 5.55782 2.17746 4.76248C2.52258 4.20798 2.95413 3.7211 3.45519 3.3264C4.18625 2.75052 5.03935 2.4928 6.07765 2.36968C7.08692 2.25 8.35342 2.25 9.95192 2.25002ZM6 4.75002C5.58579 4.75002 5.25 5.0858 5.25 5.50002C5.25 5.91423 5.58579 6.25001 6 6.25001H7C7.41421 6.25001 7.75 5.91423 7.75 5.50002C7.75 5.0858 7.41421 4.75002 7 4.75002H6ZM10 4.75002C9.58579 4.75002 9.25 5.0858 9.25 5.50002C9.25 5.91423 9.58579 6.25001 10 6.25001H11C11.4142 6.25001 11.75 5.91423 11.75 5.50002C11.75 5.0858 11.4142 4.75002 11 4.75002H10Z" fill="currentColor" />
    <path opacity="0.4" d="M2.24634 10.25H21.7537C22.222 10.25 22.4561 10.25 22.6025 10.3963C22.7489 10.5425 22.7492 10.7758 22.7497 11.2422C22.75 11.4739 22.75 11.7127 22.75 11.9589V12.0395C22.75 13.8506 22.75 15.263 22.645 16.3837C22.5384 17.5217 22.3179 18.4422 21.8229 19.2376C21.4778 19.7921 21.0463 20.2789 20.5452 20.6736C19.8141 21.2495 18.961 21.5072 17.9227 21.6304C16.9135 21.7501 15.6469 21.75 14.0485 21.75H9.95145C8.35299 21.75 7.08652 21.7501 6.07727 21.6304C5.03896 21.5072 4.18587 21.2495 3.4548 20.6736C2.95374 20.2789 2.5222 19.7921 2.17708 19.2376C1.68205 18.4422 1.46162 17.5217 1.355 16.3837C1.24999 15.263 1.24999 13.8507 1.25 12.0395V11.959C1.25 11.7128 1.25 11.474 1.25026 11.2422C1.2508 10.7758 1.25106 10.5425 1.39747 10.3963C1.54389 10.25 1.77804 10.25 2.24634 10.25Z" fill="currentColor" />
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
        return 'Sticky Header';
    }

    static function className()
    {
        return 'dan-sticky-header';
    }

    static function category()
    {
        return 'dancepad_menus';
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
        return ['content' => ['settings' => ['enable_offset' => true, 'offset_scrolling' => 100, 'show_when_going_up' => true, 'zindex' => 9999], 'animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'css_easing' => 'ease'], 'nav_scrolling_styles' => ['backdrop_filter' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease', 'offset_scrolling' => 50, 'background' => '#00000082'], 'responsive' => ['animation' => 'From Left', 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'css_easing' => 'ease', 'breakpoint' => ['number' => 767, 'unit' => 'px', 'style' => '767px'], 'breakpoints' => 'breakpoint_tablet_landscape', 'break' => 'breakpoint_tablet_landscape']], 'design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 'fit-content', 'unit' => 'custom', 'style' => 'fit-content']], 'position' => ['top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'left' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'zindex' => 9999]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'Dancepad\Burger', 'defaultProperties' => ['content' => ['tasty_hamburger_animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease'], 'burger' => ['collection' => 'general', 'tasty_type' => 'Emphatic', 'reverse' => false, 'lock_body_scroll_on_click' => true, 'distorted_type' => 'Distorsion v3', 'flipped_type' => 'Flipped', 'disfigured_type' => 'Minus', 'arrows_type' => 'Arrow bottom', 'general_type' => 'Bounce'], 'animation' => ['duration' => ['number' => 200, 'unit' => 'ms', 'style' => '200ms'], 'css_easing' => 'ease']], 'design' => ['tasty_hamburger_style' => ['dimensions' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_color_on_toggle' => null], 'burger_styles' => ['dimensions' => ['number' => 36, 'unit' => 'px', 'style' => '36px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'rounded' => true, 'stroke_color_on_toggle' => null]], 'settings' => ['advanced' => ['classes' => []]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav'], 'settings' => ['advanced' => ['classes' => ['dan-sticky-header__items-wrapper']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottom' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]], 'background' => ['color' => '#000'], 'layout_v2' => ['layout' => 'horizontal', 'h_align' => ['breakpoint_base' => 'center'], 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_gap' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']], 'h_vertical_at' => 'breakpoint_phone_landscape', 'h_alignment_when_vertical' => 'center']]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Home', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#FFF'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Portfolio', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#FFF'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Contact', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#FFF'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]];
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
        "settings",
        "Settings",
        [c(
        "enable_offset",
        "Enable Offset",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "offset_scrolling",
        "Offset scrolling",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.enable_offset', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "show_when_going_up",
        "Show when going up",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.enable_offset', 'operand' => 'is set', 'value' => '']]]],
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
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "nav_scrolling_styles",
        "Nav scrolling styles",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Nav styles can be applied at Nav element.</p><p>The following background and backdrop styles are applied to Nav element when the following offset is reached.</p>']],
        false,
        false,
        [],
      ), c(
        "offset_scrolling",
        "Offset scrolling",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.enable_offset', 'operand' => 'is set', 'value' => '']]]],
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
        "backdrop_filter",
        "Backdrop filter",
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
        "animation",
        "Animation",
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
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.settings.enable_offset', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "responsive",
        "Responsive",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Select a breakpoint to determine at which pixel to display the Burger and hide the Nav element.</p>']],
        false,
        false,
        [],
      ), c(
        "breakpoint",
        "Breakpoint",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'breakpointOptions' => ['multiple' => false], 'unitOptions' => ['types' => ['px']]],
        false,
        false,
        [],
      ), c(
        "animation",
        "Animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'Opacity', 'text' => 'Opacity'], ['text' => 'From Left', 'value' => 'From Left'], ['text' => 'From Right', 'value' => 'From Right']]],
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
        "delay",
        "Delay",
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
        return [
            '0' =>  [
                'title' => 'Dancepad - Sticky Header',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Sticky_Header/dancepad_sticky_header.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' =>  [
                'title' => 'Init Builder', 
                'inlineScripts' => [
                    'dancepad_sticky_header();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_sticky_header();'
                ],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' =>  [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
            ],
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

'onPropertyChange' => [['script' => 'dancepad_sticky_header();',
],],

'onCreatedElement' => [['script' => 'dancepad_sticky_header();',
],],

'onMountedElement' => [['script' => 'dancepad_sticky_header();',
],],

'onMovedElement' => [['script' => 'dancepad_sticky_header();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_sticky_header();',
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
        return [['name' => 'data-enableoffset', 'template' => '{% if content.settings.enable_offset %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-offset', 'template' => '{{ content.settings.offset_scrolling }}'], ['name' => 'data-goupwards', 'template' => '{% if content.settings.show_when_going_up %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-navstyleoffset', 'template' => '{{ content.nav_scrolling_styles.offset_scrolling }}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image']];
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

