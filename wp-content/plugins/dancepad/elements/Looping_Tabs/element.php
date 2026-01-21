<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_looping_tabs_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\LoopingTabs",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class LoopingTabs extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" d="M13.0537 3.25C14.1865 3.24998 15.1123 3.24996 15.8431 3.34822C16.6071 3.45093 17.2694 3.67321 17.7981 4.2019C18.3268 4.7306 18.5491 5.39294 18.6518 6.15689C18.75 6.88775 18.75 7.81348 18.75 8.94631V15.0537C18.75 16.1865 18.75 17.1123 18.6518 17.8431C18.5491 18.6071 18.3268 19.2694 17.7981 19.7981C17.2694 20.3268 16.6071 20.5491 15.8431 20.6518C15.1123 20.75 14.1865 20.75 13.0537 20.75H13.0537H10.9463H10.9463C9.81347 20.75 8.88774 20.75 8.15689 20.6518C7.39294 20.5491 6.7306 20.3268 6.2019 19.7981C5.67321 19.2694 5.45093 18.6071 5.34822 17.8431C5.24996 17.1123 5.24998 16.1865 5.25 15.0537V15.0537V8.94631V8.94629C5.24998 7.81346 5.24996 6.88774 5.34822 6.15689C5.45093 5.39294 5.67321 4.7306 6.2019 4.2019C6.7306 3.67321 7.39293 3.45093 8.15689 3.34822C8.88774 3.24996 9.81346 3.24998 10.9463 3.25H10.9463H13.0537H13.0537Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 6.5C1.25 6.08579 1.58579 5.75 2 5.75C3.24264 5.75 4.25 6.75736 4.25 8V16C4.25 17.2426 3.24264 18.25 2 18.25C1.58579 18.25 1.25 17.9142 1.25 17.5C1.25 17.0858 1.58579 16.75 2 16.75C2.41421 16.75 2.75 16.4142 2.75 16V8C2.75 7.58579 2.41421 7.25 2 7.25C1.58579 7.25 1.25 6.91421 1.25 6.5Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.75 8C19.75 6.75736 20.7574 5.75 22 5.75C22.4142 5.75 22.75 6.08579 22.75 6.5C22.75 6.91421 22.4142 7.25 22 7.25C21.5858 7.25 21.25 7.58579 21.25 8V16C21.25 16.4142 21.5858 16.75 22 16.75C22.4142 16.75 22.75 17.0858 22.75 17.5C22.75 17.9142 22.4142 18.25 22 18.25C20.7574 18.25 19.75 17.2426 19.75 16V8Z" fill="currentColor" />
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
        return 'Looping Tabs';
    }

    static function className()
    {
        return 'dan-looping-tabs';
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
        return ['design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 768, 'unit' => 'px', 'style' => '768px']], 'height' => ['breakpoint_base' => ['number' => 360, 'unit' => 'px', 'style' => '360px']]], 'background' => ['color' => ['breakpoint_base' => '#f5f5f5']], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]]], 'progress' => ['mode' => 'horizontal', 'padding_top' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'padding_left' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'padding_right' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'padding_bottom' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'width_horizontal_' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height_horizontal_' => ['number' => 13, 'unit' => 'px', 'style' => '13px'], 'width_vertical_' => ['number' => 14, 'unit' => 'px', 'style' => '14px'], 'height_vertical_' => ['number' => 80, 'unit' => 'px', 'style' => '80px'], 'path_outer_color' => '#ffffff', 'path_inner_color' => '#f5f5f5', 'border' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']], 'border_radius' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'box_shadow' => ['shadows' => [['color' => '#0000001A', 'x' => '0', 'y' => '2', 'blur' => '2', 'spread' => '1', 'position' => 'outset']], 'style' => '0px 2px 2px 1px #0000001A'], 'padding' => ['number' => 3, 'unit' => 'px', 'style' => '3px']], 'progress_animation' => ['duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'gsap_easing' => 'power2']], 'content' => ['settings' => ['active_tab' => 1]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav'], 'settings' => ['advanced' => ['classes' => ['dan-looping-tabs__nav']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'width' => ['breakpoint_base' => ['number' => 30, 'unit' => '%', 'style' => '30%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'background' => ['color' => '#fff']]], 'children' => [['slug' => 'Dancepad\LoopingTabsNavItem', 'defaultProperties' => ['design' => ['background' => ['layers' => ['breakpoint_base' => []], 'color' => ['breakpoint_base' => '#fff']], 'new_section' => ['new_control' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 100%)']], 'gradient' => ['gradient' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 99.48717948717949, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="0.9948717948717949"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 99.48717948717949%)']], 'progress_gradient' => ['progress_gradient' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 100%)'], 'gradient_first_color' => '#ff0000', 'gradient_second_color' => '#ffa500', 'degree' => 90], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'active_styles' => ['background' => ['color' => ['breakpoint_base' => '#f5f5f5']]], 'active' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease-in-out', 'background' => ['color' => ['breakpoint_base' => '#f5f5f5']]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'meta' => ['friendlyName' => 'Nav Item']], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []]]], ['slug' => 'Dancepad\LoopingTabsNavItem', 'defaultProperties' => ['design' => ['background' => ['layers' => ['breakpoint_base' => []], 'color' => ['breakpoint_base' => '#fff']], 'new_section' => ['new_control' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 100%)']], 'gradient' => ['gradient' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 99.48717948717949, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="0.9948717948717949"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 99.48717948717949%)']], 'progress_gradient' => ['progress_gradient' => ['points' => [['left' => 0, 'red' => 0, 'green' => 102, 'blue' => 255, 'alpha' => 1], ['left' => 100, 'red' => 0, 'green' => 204, 'blue' => 255, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#0066ff" offset="0"></stop><stop stop-opacity="1" stop-color="#00ccff" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(0, 102, 255, 1) 0%,rgba(0, 204, 255, 1) 100%)'], 'gradient_first_color' => '#0066ff', 'gradient_second_color' => '#00ccff', 'degree' => 90], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'active_styles' => ['background' => ['color' => ['breakpoint_base' => '#f5f5f5']]], 'active' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease-in-out', 'background' => ['color' => ['breakpoint_base' => '#f5f5f5']]]], 'meta' => ['friendlyName' => 'Nav Item']], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []]]], ['slug' => 'Dancepad\LoopingTabsNavItem', 'defaultProperties' => ['design' => ['background' => ['layers' => ['breakpoint_base' => []], 'color' => ['breakpoint_base' => '#fff']], 'new_section' => ['new_control' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 100%)']], 'gradient' => ['gradient' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 99.48717948717949, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="0.9948717948717949"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 99.48717948717949%)']], 'progress_gradient' => ['progress_gradient' => ['points' => [['left' => 0, 'red' => 0, 'green' => 204, 'blue' => 102, 'alpha' => 1], ['left' => 100, 'red' => 51, 'green' => 255, 'blue' => 153, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#00cc66" offset="0"></stop><stop stop-opacity="1" stop-color="#33ff99" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(0, 204, 102, 1) 0%,rgba(51, 255, 153, 1) 100%)'], 'gradient_first_color' => '#00cc66', 'gradient_second_color' => '#33ff99', 'degree' => 90], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'active_styles' => ['background' => ['color' => ['breakpoint_base' => '#f5f5f5']]], 'active' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease-in-out', 'background' => ['color' => ['breakpoint_base' => '#f5f5f5']]]], 'meta' => ['friendlyName' => 'Nav Item']], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []]]], ['slug' => 'Dancepad\LoopingTabsNavItem', 'defaultProperties' => ['design' => ['background' => ['layers' => ['breakpoint_base' => []], 'color' => ['breakpoint_base' => '#fff']], 'new_section' => ['new_control' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 100%)']], 'gradient' => ['gradient' => ['points' => [['left' => 0, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 99.48717948717949, 'red' => 255, 'green' => 165, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#ff0000" offset="0"></stop><stop stop-opacity="1" stop-color="#ffa500" offset="0.9948717948717949"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(255, 0, 0, 1) 0%,rgba(255, 165, 0, 1) 99.48717948717949%)']], 'progress_gradient' => ['progress_gradient' => ['points' => [['left' => 0, 'red' => 102, 'green' => 0, 'blue' => 204, 'alpha' => 1], ['left' => 100, 'red' => 204, 'green' => 102, 'blue' => 255, 'alpha' => 1]], 'type' => 'linear', 'degree' => 90, 'svgValue' => '<linearGradient x1="0" y1="0.5" x2="1" y2="0.5" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#6600cc" offset="0"></stop><stop stop-opacity="1" stop-color="#cc66ff" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(90deg,rgba(102, 0, 204, 1) 0%,rgba(204, 102, 255, 1) 100%)'], 'background' => ['type' => 'gradient', 'color' => 'red', 'overlay' => ['type' => 'gradient', 'color' => 'blue']], 'new_control' => ['points' => [['left' => 0, 'red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 1], ['left' => 100, 'red' => 255, 'green' => 0, 'blue' => 0, 'alpha' => 1]], 'type' => 'linear', 'degree' => 0, 'svgValue' => '<linearGradient x1="0.5" y1="1" x2="0.5" y2="0" id="%%GRADIENTID%%"><stop stop-opacity="1" stop-color="#000000" offset="0"></stop><stop stop-opacity="1" stop-color="#ff0000" offset="1"></stop></linearGradient>', 'value' => 'linear-gradient(0deg,rgba(0, 0, 0, 1) 0%,rgba(255, 0, 0, 1) 100%)'], 'gradient_first_color' => '#6600cc', 'gradient_second_color' => '#cc66ff', 'degree' => 90], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'layout_v2' => ['layout' => 'vertical', 'v_gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'active_styles' => ['background' => ['color' => ['breakpoint_base' => '#f5f5f5']]], 'active' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease-in-out', 'background' => ['color' => ['breakpoint_base' => '#f5f5f5']]]], 'meta' => ['friendlyName' => 'Nav Item']], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tabs'], 'settings' => ['advanced' => ['classes' => ['dan-looping-tabs__tabs-wrapper']]], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 70, 'unit' => '%', 'style' => '70%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-looping-tabs__tab']]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]]]], 'background' => ['color' => '#f9f9f9']]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/14-1-scaled.jpg']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-looping-tabs__tab']]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]]]], 'background' => ['color' => '#f9f9f9']]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/24-scaled.jpg']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-looping-tabs__tab']]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]]]], 'background' => ['color' => '#f9f9f9']]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/74-scaled.jpg']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-looping-tabs__tab']]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['container' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'min_height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#00000010', 'style' => 'solid']]]]], 'background' => ['color' => '#f9f9f9']]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/83-scaled.jpg']]], 'children' => []]]]]]];
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
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "progress",
        "Progress",
        [c(
        "mode",
        "Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'horizontal', 'text' => 'horizontal'], ['text' => 'vertical', 'value' => 'vertical']]],
        false,
        false,
        [],
      ), c(
        "padding",
        "Padding",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "width_horizontal_",
        "Width (horizontal)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.progress.mode', 'operand' => 'equals', 'value' => 'horizontal']]]],
        false,
        false,
        [],
      ), c(
        "height_horizontal_",
        "Height (horizontal)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.progress.mode', 'operand' => 'equals', 'value' => 'horizontal']]]],
        false,
        false,
        [],
      ), c(
        "width_vertical_",
        "Width (vertical)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.progress.mode', 'operand' => 'equals', 'value' => 'vertical']]]],
        false,
        false,
        [],
      ), c(
        "height_vertical_",
        "Height (vertical)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'design.progress.mode', 'operand' => 'equals', 'value' => 'vertical']]]],
        false,
        false,
        [],
      ), c(
        "path_outer_color",
        "Path Outer Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_inner_color",
        "Path Inner Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
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
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "box_shadow",
        "Box shadow",
        [],
        ['type' => 'shadow', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "progress_animation",
        "Progress Animation",
        [c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
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
        "gsap_easing",
        "GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
        "settings",
        "Settings",
        [c(
        "active_tab",
        "Active Tab",
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
            '0' => [
                'title' => 'Dancepad - Looping Tabs',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Looping_Tabs/dancepad_looping_tabs.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_looping_tabs();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_looping_tabs();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
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

'onPropertyChange' => [['script' => 'dancepad_looping_tabs();',
],],

'onCreatedElement' => [['script' => 'dancepad_looping_tabs();',
],],

'onMountedElement' => [['script' => 'dancepad_looping_tabs();',
],],

'onMovedElement' => [['script' => 'dancepad_looping_tabs();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_looping_tabs();',
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
        return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-disable-builder', 'template' => '{% if design.progress_animation.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-mode', 'template' => '{{ design.progress.mode }}'], ['name' => 'data-active-tab', 'template' => '{{ content.settings.active_tab }}'], ['name' => 'data-loop-duration', 'template' => '{{ design.progress_animation.duration.style }}'], ['name' => 'data-gsap-ease', 'template' => '{{ design.progress_animation.gsap_easing }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
        return ['content.content.text', 'design.layout.horizontal.vertical_at', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display'];
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
} 
}