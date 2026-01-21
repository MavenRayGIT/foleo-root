<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_nudge_button_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\NudgeButton",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class NudgeButton extends \Breakdance\Elements\Element
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
            return 'Nudge Button';
        }
    
        static function className()
        {
            return 'dan-nudge-button';
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
            return ['content' => ['team_members' => ['members' => [[]]], 'toasts' => ['toasts' => [['title' => 'Welcome', 'message' => 'Thanks for visiting our site!\'', 'event' => 'pageload', 'show_time' => ['number' => 5, 'unit' => 's', 'style' => '5s'], 'show_time_pageload_' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'trigger_click_' => '.test']]], 'show_toasts_animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'gsap_easing' => 'back'], 'hide_toasts_animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'gsap_easing' => 'expo'], 'expand_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo'], 'collapse_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo'], 'content' => ['tag' => 'div', 'text' => 'Nudge Button', 'swap_text' => 'Arrow Button v6', 'blurry_text' => 'Blurry Button'], 'animation' => ['css_easing' => 'cubic-bezier(0.76, 0, 0.24, 1)', 'duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'stagger' => ['number' => 0.02, 'unit' => 's', 'style' => '0.02s']], 'arrow_animation' => ['translate_from' => ['breakpoint_base' => ['number' => 3, 'unit' => 'em', 'style' => '3em']], 'translate_duration' => ['number' => 0.85, 'unit' => 's', 'style' => '0.85s'], 'animation_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'css_easing' => 'cubic-bezier(.65, .06, .33, .89)'], 'text_animation' => ['duration' => ['number' => 0.45, 'unit' => 's', 'style' => '0.45s']], 'blur_animation' => ['translate_from' => ['breakpoint_base' => ['number' => 1, 'unit' => 'em', 'style' => '1em']], 'blur' => ['breakpoint_base' => ['number' => 1, 'unit' => 'em', 'style' => '1em']], 'duration' => ['number' => 1.05, 'unit' => 's', 'style' => '1.05s'], 'scale' => ['breakpoint_base' => 0.85]]], 'design' => ['toasts_container' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'zindex' => 99], 'toasts' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'background' => ['color' => ['breakpoint_base' => '#000']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]], 'gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'title_and_message' => ['title_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 17, 'unit' => 'px', 'style' => '17px']], 'fontWeight' => ['breakpoint_base' => '500']]]]], 'message_typography' => ['color' => ['breakpoint_base' => '#6b7280'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]]]], 'close_button' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'right' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'top' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottom' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]]], 'dimensions' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'stroke_color' => '#6b7280', 'stroke_width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#f3f4f6']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'duplicated_arrow_styles' => ['border_radius' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all'], 'color' => '#fff', 'background' => 'rgb(65, 153, 241)', 'padding' => ['breakpoint_base' => ['left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'type' => 'type2'], 'arrow_styles' => ['type' => 'type2', 'color' => '#000', 'background' => 'rgb(65, 153, 241)', 'border_radius' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all'], 'padding' => ['breakpoint_base' => ['left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'dimensions' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'duplicated_arrow_left' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']], 'weight' => ['breakpoint_base' => ['number' => 10, 'unit' => '%', 'style' => '10%']]], 'background' => ['color' => ['breakpoint_base' => '#eee']], 'typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => null, 'advanced' => null, 'fontWeight_hover' => null, 'advanced_hover' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]]], 'gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'layout' => ['gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]], 'blurry_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]], 'color' => ['breakpoint_base' => '#fff']], 'blurry_background' => ['color' => ['breakpoint_base' => '#000']], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'blurry_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'nudge' => ['height' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'background' => ['color' => ['breakpoint_base' => '#b1b1b1']], 'vertical_padding' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'horizontal_padding' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'border_radius' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'Dancepad\TextShimmer', 'defaultProperties' => ['content' => ['content' => ['text' => 'great shimmer', 'tag' => 'span', 'link' => null, 'swapped_text' => '3D Swap Hover'], 'animation' => ['duration' => ['number' => 1.7, 'unit' => 's', 'style' => '1.7s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'lines', 'from' => '1', 'distance_dynamic_meta' => null, 'skew' => ['number' => 0, 'unit' => 'deg', 'style' => '0deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'sine', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side', 'swapped_text' => 'Swap Hover', 'delay_between_shimmers' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'swap' => ['type' => 'Left to Full', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'css_easing' => 'cubic-bezier(0.19, 1, 0.22, 1)', 'color' => '#73fddf', 'from' => '1', 'skew' => ['number' => 0, 'unit' => 'deg', 'style' => '0deg'], 'stagger' => '0.25', 'split_type' => 'lines', 'swapped_text' => 'Swap Hover']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'fontWeight' => ['breakpoint_base' => '500']]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'spacing' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'right' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'left' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]]], 'swap_spacing' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 200, 'unit' => 'px', 'style' => '200px'], 'right' => ['number' => 200, 'unit' => 'px', 'style' => '200px'], 'top' => ['number' => 200, 'unit' => 'px', 'style' => '200px'], 'bottom' => ['number' => 200, 'unit' => 'px', 'style' => '200px']]]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'right' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'margin' => null, 'shimmer' => ['text_color' => ['breakpoint_base' => 'rgba(0, 0, 0, 0.4)'], 'shimmer_color' => ['breakpoint_base' => 'rgba(255, 255, 255, 0.9)'], 'shimmer_size' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]], 'background' => null, 'borders' => null]], 'children' => []]];
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
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Border",
          "border",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
           ['type' => 'popout']
         ), c(
            "nudge",
            "Nudge",
            [c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), getPresetSection(
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         ), c(
            "vertical_padding",
            "Vertical Padding",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "horizontal_padding",
            "Horizontal Padding",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
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
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "css_easing",
            "CSS Easing",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
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
            ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
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
            return ["type" => "container",   ];
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
            return [['accepts' => 'image_url', 'path' => 'design.blurry_background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.nudge.background.layers[].image']];
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
            return ['design.layout.horizontal.vertical_at'];
        }
    
        static function propertyPathsToSsrElementWhenValueChanges()
        {
            return false;
        }
    } 
}