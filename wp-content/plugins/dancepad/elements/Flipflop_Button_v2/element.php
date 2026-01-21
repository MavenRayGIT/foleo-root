<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_flipflop_button_v2_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\FlipflopButtonV2",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class FlipflopButtonV2 extends \Breakdance\Elements\Element
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
            return 'Flipflop Button V2';
        }
    
        static function className()
        {
            return 'dan-flipflop-button-v2';
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
            return ['content' => ['team_members' => ['members' => [[]]], 'toasts' => ['toasts' => [['title' => 'Welcome', 'message' => 'Thanks for visiting our site!\'', 'event' => 'pageload', 'show_time' => ['number' => 5, 'unit' => 's', 'style' => '5s'], 'show_time_pageload_' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'trigger_click_' => '.test']]], 'show_toasts_animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'gsap_easing' => 'back'], 'hide_toasts_animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'gsap_easing' => 'expo'], 'expand_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo'], 'collapse_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo'], 'content' => ['flip_text' => 'Flip', 'flop_text' => 'Flop'], 'flipflop_animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s']]], 'design' => ['toasts_container' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'zindex' => 99], 'toasts' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'background' => ['color' => ['breakpoint_base' => '#000']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]], 'gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'title_and_message' => ['title_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 17, 'unit' => 'px', 'style' => '17px']], 'fontWeight' => ['breakpoint_base' => '500']]]]], 'message_typography' => ['color' => ['breakpoint_base' => '#6b7280'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]]]], 'close_button' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'right' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'top' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottom' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]]], 'dimensions' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'stroke_color' => '#6b7280', 'stroke_width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#f3f4f6']]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]]], 'flip_typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]]], 'flop_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]]], 'flip_background' => ['color' => ['breakpoint_base' => '#eee']], 'flop_background' => ['color' => ['breakpoint_base' => '#000']], 'flip_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]], 'flop_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]]]];
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
          "EssentialElements\\background",
          "Flip Background",
          "flip_background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\background",
          "Flop Background",
          "flop_background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Flip Border",
          "flip_border",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Flop Border",
          "flop_border",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Flip Typography",
          "flip_typography",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Flop Typography",
          "flop_typography",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "flip_text",
            "Flip Text",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
            false,
            false,
            [],
          ), c(
            "flop_text",
            "Flop Text",
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
          ), c(
            "flipflop_animation",
            "Flipflop Animation",
            [c(
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
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
            return [['name' => 'data-text', 'template' => '{{ content.content.flop_text }}']];
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
            return [['accepts' => 'image_url', 'path' => 'design.blurry_background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.flop_background.layers[].image']];
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