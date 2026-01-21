<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_bubbles_button_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\BubblesButton",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class BubblesButton extends \Breakdance\Elements\Element
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
            return ['section', 'footer', 'header', 'nav', 'aside', 'article', 'main'];
        }
    
        static function tagControlPath()
        {
            return "content.content.tag";
        }
    
        static function name()
        {
            return 'Bubbles Button';
        }
    
        static function className()
        {
            return 'dan-bubbles-button';
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
            return ['content' => ['content' => ['text' => 'Bubbles Button', 'tag' => 'div']], 'design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontWeight' => ['breakpoint_base' => '500'], 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]]], 'colors' => ['inner_background' => '#15bdff', 'outer_background' => '#2f58ed'], 'border_shadow' => ['border_radius' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'box_shadow' => null], 'border' => ['border_radius' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'new_control' => null, 'custom_css' => ['css' => ['breakpoint_base' => '%%SELECTOR%%::before {
      box-shadow: 0 3px 12px 0 #15bdff inset;
    }']], 'box_shadow_inset' => ['css' => ['breakpoint_base' => '%%SELECTOR%%::before {
      box-shadow: 0 3px 12px 0 #15bdff inset;
    }']], 'shadow_color' => '#15bdff', 'shadow_offset' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'shadow_blur' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'borders' => ['shadow' => ['breakpoint_base' => ['shadows' => [['color' => '#00000025', 'x' => '5', 'y' => '20', 'blur' => '75', 'spread' => '0', 'position' => 'outset']], 'style' => '5px 20px 75px 0px #00000025']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 8, 'color' => 'rgba(255, 232, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-zigzag', 'position_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'position_y' => ['number' => -40, 'unit' => 'px', 'style' => '-40px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 12, 'color' => 'rgba(255, 163, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-up-left', 'position_x' => ['number' => 92, 'unit' => 'px', 'style' => '92px'], 'position_y' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 14, 'color' => '#1a23ff']], 'content' => ['animation' => ['type' => 'move-diagonal', 'position_x' => ['number' => -12, 'unit' => 'px', 'style' => '-12px'], 'position_y' => ['number' => -12, 'unit' => 'px', 'style' => '-12px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 14, 'color' => '#1a23ff']], 'content' => ['animation' => ['type' => 'move-right', 'position_x' => ['number' => 80, 'unit' => 'px', 'style' => '80px'], 'position_y' => ['number' => -12, 'unit' => 'px', 'style' => '-12px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 1.2, 'unit' => 's', 'style' => '1.2s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 16, 'color' => '#e21bda']], 'content' => ['animation' => ['type' => 'move-zigzag', 'position_x' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'position_y' => ['number' => -4, 'unit' => 'px', 'style' => '-4px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 16, 'color' => '#e21bda']], 'content' => ['animation' => ['type' => 'move-left', 'position_x' => ['number' => 56, 'unit' => 'px', 'style' => '56px'], 'position_y' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 12, 'color' => 'rgba(255, 163, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-up', 'position_x' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'position_y' => ['number' => 28, 'unit' => 'px', 'style' => '28px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 12, 'color' => 'rgba(255, 163, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-horizontal', 'position_x' => ['number' => 28, 'unit' => 'px', 'style' => '28px'], 'position_y' => ['number' => -4, 'unit' => 'px', 'style' => '-4px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 1.8, 'unit' => 's', 'style' => '1.8s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 8, 'color' => 'rgba(255, 232, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-vertical', 'position_x' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'position_y' => ['number' => -12, 'unit' => 'px', 'style' => '-12px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 8, 'color' => 'rgba(255, 232, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-right-up', 'position_x' => ['number' => 64, 'unit' => 'px', 'style' => '64px'], 'position_y' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 12, 'color' => 'rgba(255, 163, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-straight', 'position_x' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'position_y' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 1.3, 'unit' => 's', 'style' => '1.3s'], 'css_easing' => 'ease-in-out']]], 'children' => []], ['slug' => 'Dancepad\BubblesButtonBubble', 'defaultProperties' => ['design' => ['dimensions' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'color' => '#e21bda', 'blur' => 8], 'style' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'height' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'blur' => 14, 'color' => 'rgba(255, 163, 26, 0.7)']], 'content' => ['animation' => ['type' => 'move-straight', 'position_x' => ['number' => 52, 'unit' => 'px', 'style' => '52px'], 'position_y' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'duration' => ['number' => 7, 'unit' => 's', 'style' => '7s'], 'delay' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'css_easing' => 'ease-in-out']]], 'children' => []]];
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
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
           ['type' => 'popout']
         ), c(
            "colors",
            "Colors",
            [c(
            "inner_background",
            "Inner background",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "outer_background",
            "Outer background",
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
            "border",
            "Border",
            [c(
            "border_radius",
            "Border radius",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "shadow_color",
            "Shadow color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "shadow_blur",
            "Shadow blur",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "shadow_offset",
            "Shadow offset",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
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
            return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.ibackground.layers[].image']];
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