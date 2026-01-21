<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_dropdown_mega_menu_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\DropdownMegaMenu",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class DropdownMegaMenu extends \Breakdance\Elements\Element
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
        return 'Dropdown MegaMenu';
    }

    static function className()
    {
        return 'dan-dropdown-mega-menu';
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
        return ['content' => ['responsive' => ['position' => 'absolute', 'zindex' => 99, 'breakpoint' => ['number' => 767, 'unit' => 'px', 'style' => '767px'], 'top' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'responsive_fade_animation' => ['css_easing' => 'ease', 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s']], 'responsive_transform_animation' => ['scale' => 0.7, 'transform_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'transform_y' => ['number' => -30, 'unit' => 'px', 'style' => '-30px'], 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease']], 'design' => ['layout' => ['display' => null], 'background' => ['color' => ['breakpoint_base' => '#171717']], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'position' => ['zindex' => 9999, 'position' => ['breakpoint_base' => 'relative']]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['css' => ['breakpoint_base' => null], 'classes' => ['dan-dropdown-mega-menu__mobile-wrapper']]], 'meta' => ['friendlyName' => 'Mobile Wrapper']], 'children' => [['slug' => 'Dancepad\Burger', 'defaultProperties' => ['content' => ['tasty_hamburger_animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease'], 'burger' => ['collection' => 'distorted', 'tasty_type' => 'Boring', 'reverse' => false, 'lock_body_scroll_on_click' => true, 'distorted_type' => 'Distorsion v3', 'flipped_type' => 'Flipped', 'disfigured_type' => 'Minus', 'arrows_type' => 'Arrow up', 'general_type' => 'Simple'], 'animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease']], 'design' => ['tasty_hamburger_style' => ['dimensions' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_color_on_toggle' => null], 'burger_styles' => ['dimensions' => ['number' => 36, 'unit' => 'px', 'style' => '36px'], 'stroke_color' => '#fff', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'rounded' => true, 'stroke_color_on_toggle' => null]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-dropdown-mega-menu__dropdowns-wrapper']]], 'meta' => ['friendlyName' => 'Dropdowns Wrapper'], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_at' => 'breakpoint_phone_landscape'], 'background' => ['color' => '#171717'], 'spacing' => ['margin_top' => null], 'container' => ['width' => ['breakpoint_phone_landscape' => ['number' => 'calc(100% - 24px)', 'unit' => 'custom', 'style' => 'calc(100% - 24px)']], 'padding' => ['padding' => ['breakpoint_phone_landscape' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'borders' => ['radius' => ['breakpoint_phone_landscape' => ['all' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'editMode' => 'all']]]]]], 'children' => [['slug' => 'Dancepad\Dropdown', 'defaultProperties' => ['settings' => ['advanced' => ['css' => ['breakpoint_base' => null], 'classes' => ['dan-dropdown-toggle']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Toggle'], 'settings' => ['advanced' => ['classes' => ['dan-dropdown-toggle'], 'css' => ['breakpoint_base' => '%%SELECTOR%% {
  cursor: pointer;
}']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_gap' => ['breakpoint_base' => null]], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]], 'background' => null]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Toggle', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'Dancepad\ArrowIcon', 'defaultProperties' => ['content' => ['content' => ['text' => 'Arrow Icon', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Icon', 'swap_text' => 'Swapped!', 'white_space' => 'wrap'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-icon--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.3, 'scale_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'rotate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'rotate' => ['number' => -90, 'unit' => 'deg', 'style' => '-90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'toggle' => null, 'event' => 'hover', 'enable_scale' => false, 'enable_rotate' => true, 'enable_translate' => false, 'scale_css_easing' => 'ease', 'rotate_css_easing' => 'ease', 'distance_between_arrows' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'translate_css_easing' => 'ease'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'accessibility' => null], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => null]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => null, 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'icon_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'icon_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'icon_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['size_scale_' => 0.3, 'type' => 'type3', 'rotation' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'color' => '#fff'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]], 'dimensions' => ['width' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'height' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'height' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']]]]], 'children' => []]]], ['slug' => 'Dancepad\DropdownElement', 'defaultProperties' => ['content' => ['settings' => ['event' => 'hover', 'open_at_the_builder' => false], 'fade_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease'], 'transform_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease', 'scale' => 0, 'transform_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'transform_y' => ['number' => -30, 'unit' => 'px', 'style' => '-30px']]], 'design' => ['positioning' => ['position' => 'absolute', 'toggled_position' => ['breakpoint_base' => 'absolute', 'breakpoint_phone_landscape' => 'relative'], 'top' => null, 'bottom' => null, 'left' => null, 'right' => null, 'zindex' => 100], 'mask' => ['padding_right' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_left' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_top' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'breakpoint_phone_landscape' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#000', 'breakpoint_phone_landscape' => 'transparent']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'breakpoint_phone_landscape' => ['top' => null, 'bottom' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => null]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]]], ['slug' => 'Dancepad\Dropdown', 'defaultProperties' => ['settings' => ['advanced' => ['css' => ['breakpoint_base' => null], 'classes' => ['dan-dropdown-toggle']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Toggle'], 'settings' => ['advanced' => ['classes' => ['dan-dropdown-toggle'], 'css' => ['breakpoint_base' => '%%SELECTOR%% {
  cursor: pointer;
}']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_gap' => ['breakpoint_base' => null]], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]], 'background' => null]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Toggle', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'Dancepad\ArrowIcon', 'defaultProperties' => ['content' => ['content' => ['text' => 'Arrow Icon', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Icon', 'swap_text' => 'Swapped!', 'white_space' => 'wrap'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-icon--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.3, 'scale_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'rotate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'rotate' => ['number' => -90, 'unit' => 'deg', 'style' => '-90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'toggle' => null, 'event' => 'hover', 'enable_scale' => false, 'enable_rotate' => true, 'enable_translate' => false, 'scale_css_easing' => 'ease', 'rotate_css_easing' => 'ease', 'distance_between_arrows' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'translate_css_easing' => 'ease'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'accessibility' => null], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => null]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => null, 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'icon_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'icon_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'icon_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['size_scale_' => 0.3, 'type' => 'type3', 'rotation' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'color' => '#fff'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]], 'dimensions' => ['width' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'height' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'height' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']]]]], 'children' => []]]], ['slug' => 'Dancepad\DropdownElement', 'defaultProperties' => ['content' => ['settings' => ['event' => 'hover', 'open_at_the_builder' => false], 'fade_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease'], 'transform_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease', 'scale' => 0, 'transform_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'transform_y' => ['number' => -30, 'unit' => 'px', 'style' => '-30px']]], 'design' => ['positioning' => ['position' => 'absolute', 'toggled_position' => ['breakpoint_base' => 'absolute', 'breakpoint_phone_landscape' => 'relative'], 'top' => null, 'bottom' => null, 'left' => null, 'right' => null, 'zindex' => 100], 'mask' => ['padding_right' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_left' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_top' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'breakpoint_phone_landscape' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#000', 'breakpoint_phone_landscape' => 'transparent']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'breakpoint_phone_landscape' => ['top' => null, 'bottom' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => null]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]]], ['slug' => 'Dancepad\Dropdown', 'defaultProperties' => ['settings' => ['advanced' => ['css' => ['breakpoint_base' => null], 'classes' => ['dan-dropdown-toggle']]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Toggle'], 'settings' => ['advanced' => ['classes' => ['dan-dropdown-toggle'], 'css' => ['breakpoint_base' => '%%SELECTOR%% {
  cursor: pointer;
}']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_gap' => ['breakpoint_base' => null]], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]], 'background' => null]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Toggle', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'Dancepad\ArrowIcon', 'defaultProperties' => ['content' => ['content' => ['text' => 'Arrow Icon', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Icon', 'swap_text' => 'Swapped!', 'white_space' => 'wrap'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-icon--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.3, 'scale_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'rotate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'rotate' => ['number' => -90, 'unit' => 'deg', 'style' => '-90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'toggle' => null, 'event' => 'hover', 'enable_scale' => false, 'enable_rotate' => true, 'enable_translate' => false, 'scale_css_easing' => 'ease', 'rotate_css_easing' => 'ease', 'distance_between_arrows' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'translate_css_easing' => 'ease'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'accessibility' => null], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => null]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => null, 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'icon_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'icon_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'icon_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['size_scale_' => 0.3, 'type' => 'type3', 'rotation' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'color' => '#fff'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]], 'dimensions' => ['width' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'height' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'height' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']]]]], 'children' => []]]], ['slug' => 'Dancepad\DropdownElement', 'defaultProperties' => ['content' => ['settings' => ['event' => 'hover', 'open_at_the_builder' => false], 'fade_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease'], 'transform_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease', 'scale' => 0, 'transform_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'transform_y' => ['number' => -30, 'unit' => 'px', 'style' => '-30px']]], 'design' => ['positioning' => ['position' => 'absolute', 'toggled_position' => ['breakpoint_base' => 'absolute', 'breakpoint_phone_landscape' => 'relative'], 'top' => null, 'bottom' => null, 'left' => null, 'right' => null, 'zindex' => 100], 'mask' => ['padding_right' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_left' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_top' => ['number' => 12, 'unit' => 'px', 'style' => '12px', 'breakpoint_phone_landscape' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#000', 'breakpoint_phone_landscape' => 'transparent']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'breakpoint_phone_landscape' => ['bottom' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => null]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]]]]]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "position",
        "Position",
        [c(
        "position",
        "Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'absolute', 'text' => 'absolute'], ['text' => 'relative', 'value' => 'relative'], ['text' => 'sticky', 'value' => 'sticky'], ['text' => 'fixed', 'value' => 'fixed']]],
        true,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'vh', '%', 'custom']]],
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
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "responsive",
        "Responsive",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Select a breakpoint to determine at which pixel to display the Mobile Wrapper and hide the Dropdowns Wrapper.</p>']],
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
        "note_2",
        "Note 2",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The following styles are applied to Dropdowns Wrapper at the selected breakpoint.</p>']],
        false,
        false,
        [],
      ), c(
        "position",
        "Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'absolute', 'text' => 'absolute'], ['text' => 'relative', 'value' => 'relative'], ['text' => 'sticky', 'value' => 'sticky'], ['text' => 'fixed', 'value' => 'fixed']]],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
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
        "responsive_fade_animation",
        "Responsive Fade animation",
        [c(
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
      ), c(
        "responsive_transform_animation",
        "Responsive Transform animation",
        [c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transform_x",
        "Transform X",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "transform_y",
        "Transform Y",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
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
        return ['0' =>  ['title' => 'Dancepad - Dropdown megaMenu','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Dropdown_megaMenu/dancepad_dropdown_megaMenu.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_dropdown_mega_menu();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_dropdown_mega_menu();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_dropdown_mega_menu();',
],],

'onCreatedElement' => [['script' => 'dancepad_dropdown_mega_menu();',
],],

'onMountedElement' => [['script' => 'dancepad_dropdown_mega_menu();',
],],

'onMovedElement' => [['script' => 'dancepad_dropdown_mega_menu();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_dropdown_mega_menu();',
],],];
    }

    static function nestingRule()
    {
        return ["type" => "section",   ];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
