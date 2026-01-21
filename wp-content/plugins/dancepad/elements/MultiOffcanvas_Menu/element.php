<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_multi_offcanvas_menu_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\MultiOffcanvasMenu",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class MultiOffcanvasMenu extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 19.5C2 20.8807 3.11929 22 4.5 22C5.88071 22 7 20.8807 7 19.5C7 18.1193 5.88071 17 4.5 17C3.11929 17 2 18.1193 2 19.5Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 19.5C9.5 20.8807 10.6193 22 12 22C13.3807 22 14.5 20.8807 14.5 19.5C14.5 18.1193 13.3807 17 12 17C10.6193 17 9.5 18.1193 9.5 19.5Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 19.5C17 20.8807 18.1193 22 19.5 22C20.8807 22 22 20.8807 22 19.5C22 18.1193 20.8807 17 19.5 17C18.1193 17 17 18.1193 17 19.5Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 4.5C2 5.88071 3.11929 7 4.5 7C5.88071 7 7 5.88071 7 4.5C7 3.11929 5.88071 2 4.5 2C3.11929 2 2 3.11929 2 4.5Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 4.5C9.5 5.88071 10.6193 7 12 7C13.3807 7 14.5 5.88071 14.5 4.5C14.5 3.11929 13.3807 2 12 2C10.6193 2 9.5 3.11929 9.5 4.5Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 4.5C17 5.88071 18.1193 7 19.5 7C20.8807 7 22 5.88071 22 4.5C22 3.11929 20.8807 2 19.5 2C18.1193 2 17 3.11929 17 4.5Z" fill="currentColor" />
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 13.3807 3.11929 14.5 4.5 14.5C5.88071 14.5 7 13.3807 7 12C7 10.6193 5.88071 9.5 4.5 9.5C3.11929 9.5 2 10.6193 2 12Z" fill="currentColor" />
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5C10.6193 9.5 9.5 10.6193 9.5 12Z" fill="currentColor" />
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17 12C17 13.3807 18.1193 14.5 19.5 14.5C20.8807 14.5 22 13.3807 22 12C22 10.6193 20.8807 9.5 19.5 9.5C18.1193 9.5 17 10.6193 17 12Z" fill="currentColor" />
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
        return 'MultiOffcanvas Menu';
    }

    static function className()
    {
        return 'dan-multi-offcanvas-menu';
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
        return ['content' => ['animation' => ['enable_fade' => true, 'duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo', 'from_top' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'from_left' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'type' => 'From right', 'css_easing' => 'cubic-bezier(.33,1,.68,1)'], 'accessibility' => ['close_on_esc' => true], 'settings' => ['custom_toggle' => null, 'lock_body_scrolling' => true, 'content_zindex' => 9999, 'backdrop_zindex' => 9998], 'backdrop' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'background' => '#1D5A8666', 'css_easing' => 'linear'], 'content_styles' => ['background' => '#000', 'width' => ['number' => '50vw', 'unit' => 'custom', 'style' => '50vw'], 'height' => ['number' => '100vh', 'unit' => 'custom', 'style' => '100vh'], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'right' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'top' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]], 'design' => ['content_styles' => ['background' => '#000', 'width' => ['breakpoint_base' => ['number' => 50, 'unit' => 'vw', 'style' => '50vw']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => 'vh', 'style' => '100vh']]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'Dancepad\Burger', 'defaultProperties' => ['content' => ['tasty_hamburger_animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease'], 'burger' => ['collection' => 'tasty', 'tasty_type' => 'Spring', 'reverse' => false, 'lock_body_scroll_on_click' => true, 'distorted_type' => 'Distorsion v2', 'flipped_type' => 'Flipped', 'disfigured_type' => 'Minus', 'arrows_type' => 'Arrow up', 'general_type' => 'Simple'], 'animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease']], 'design' => ['tasty_hamburger_style' => ['dimensions' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_color_on_toggle' => null], 'burger_styles' => ['dimensions' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'rounded' => true, 'stroke_color_on_toggle' => null], 'margin' => ['margin' => ['breakpoint_base' => ['bottom' => null]]], 'position' => ['position' => null, 'zindex' => null]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-multi-offcanvas-menu__items-wrapper']]], 'design' => ['background' => null, 'container' => ['borders' => ['radius' => null], 'width' => null, 'min_height' => null, 'padding' => null], 'layout_v2' => null]], 'children' => [['slug' => 'Dancepad\Burger', 'defaultProperties' => ['content' => ['tasty_hamburger_animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease'], 'burger' => ['collection' => 'tasty', 'tasty_type' => 'Spring', 'reverse' => false, 'lock_body_scroll_on_click' => true, 'distorted_type' => 'Distorsion', 'flipped_type' => 'Flipped', 'disfigured_type' => 'Minus', 'arrows_type' => 'Arrow up', 'general_type' => 'Simple'], 'animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease']], 'design' => ['tasty_hamburger_style' => ['dimensions' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_color_on_toggle' => null], 'burger_styles' => ['dimensions' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'stroke_color' => '#FFF', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'rounded' => true, 'stroke_color_on_toggle' => null], 'margin' => ['margin' => ['breakpoint_base' => ['bottom' => null]]], 'position' => ['position' => 'absolute', 'zindex' => null, 'top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Items'], 'settings' => ['advanced' => ['classes' => ['dan-multi-offcanvas-menu__items']]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center'], 'v_gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'right' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'top' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]]]]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Home', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => ['sub-1']]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Portfolio', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => ['sub-2']]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Contact', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => ['sub-3']]]], 'children' => []]]], ['slug' => 'Dancepad\Suboffcanvas', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['breakpoint_base' => ['number' => 50, 'unit' => 'vw', 'style' => '50vw']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => 'vh', 'style' => '100vh']]], 'background' => ['color' => ['breakpoint_base' => '#4DB9BBFF']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'content' => ['animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'css_easing' => 'cubic-bezier(.33,1,.68,1)'], 'settings' => ['open_toggle' => '.sub-1', 'close_toggle' => '.sub-1']]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Home-1', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Home-2', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Home-3', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]], ['slug' => 'Dancepad\Suboffcanvas', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['breakpoint_base' => ['number' => 50, 'unit' => 'vw', 'style' => '50vw']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => 'vh', 'style' => '100vh']]], 'background' => ['color' => ['breakpoint_base' => '#D84C16FF']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'content' => ['animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'css_easing' => 'cubic-bezier(.33,1,.68,1)'], 'settings' => ['open_toggle' => '.sub-2', 'close_toggle' => '.sub-2']]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Portfolio-1', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Portfolio-2', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Portfolio-3', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]], ['slug' => 'Dancepad\Suboffcanvas', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['breakpoint_base' => ['number' => 50, 'unit' => 'vw', 'style' => '50vw']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => 'vh', 'style' => '100vh']]], 'background' => ['color' => ['breakpoint_base' => '#EF354AFF']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'content' => ['animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'css_easing' => 'cubic-bezier(.33,1,.68,1)'], 'settings' => ['open_toggle' => '.sub-3', 'close_toggle' => '.sub-3']]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Contact-1', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Contact-2', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Contact-3', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]]]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "content_styles",
        "Content styles",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vw']]],
        true,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        true,
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
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function contentControls()
    {
        return [c(
        "settings",
        "Settings",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>All elements with this class will toggle the menu alongside all the Burgers inside the menu.</p>']],
        false,
        false,
        [],
      ), c(
        "custom_toggle",
        "Custom toggle",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => '.className'],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>If true, Custom Toggle will lock body scrolling on click.</p>']],
        false,
        false,
        [],
      ), c(
        "lock_body_scrolling",
        "Lock body scrolling",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "content_zindex",
        "Content zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "backdrop_zindex",
        "Backdrop zIndex",
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
        "accessibility",
        "Accessibility",
        [c(
        "close_on_esc",
        "Close on ESC",
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
        "animation",
        "Animation",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'From left', 'text' => 'From left'], ['text' => 'From right', 'value' => 'From right']]],
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
        "backdrop",
        "Backdrop",
        [c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
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
        return [
            '0' =>  [
                'title' => 'Dancepad - MultiOffcanvas Menu',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/MultiOffcanvas_Menu/dancepad_multioffcanvas_menu.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' =>  [
                'title' => 'Init Builder', 
                'inlineScripts' => [
                    'dancepad_multioffcanvas_menu();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_multioffcanvas_menu();'
                ],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' =>  [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
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

'onPropertyChange' => [['script' => 'dancepad_multioffcanvas_menu();',
],],

'onCreatedElement' => [['script' => 'dancepad_multioffcanvas_menu();',
],],

'onMountedElement' => [['script' => 'dancepad_multioffcanvas_menu();',
],],

'onMovedElement' => [['script' => 'dancepad_multioffcanvas_menu();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_multioffcanvas_menu();',
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
        return [['name' => 'data-type', 'template' => '{% if content.animation.type == \'From left\' %}
fromLeft
{% elseif content.animation.type == \'From right\' %}
fromRight
{% endif %}'], ['name' => 'data-close-on-esc', 'template' => '{% if content.accessibility.close_on_esc %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-customtoggle', 'template' => '{{ content.settings.custom_toggle }}'], ['name' => 'data-customtoggle-lock-body-scrolling', 'template' => '{% if content.settings.lock_body_scrolling %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-classtype', 'template' => '{% if content.animation.type == \'From left\' %}
dan-multi-offcanvas-menu--fromleft
{% elseif content.animation.type == \'From right\' %}
dan-multi-offcanvas-menu--fromright
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'content.content_styles.background.layers[].image']];
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
