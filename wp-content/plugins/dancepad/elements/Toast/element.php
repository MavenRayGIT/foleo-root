<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_toast_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Toast",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Toast extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.37791 5.9056C3.33323 6.46811 3 7.07765 3 7.5C3 7.86005 3.23292 8.35021 3.97307 8.85054C4.55886 9.24652 5.00891 9.96078 4.92503 10.7996L4.10499 19H12.895L12.075 10.7996C11.9911 9.96078 12.4411 9.24652 13.0269 8.85054C13.7671 8.35021 14 7.86005 14 7.5C14 7.07765 13.6668 6.46811 12.6221 5.9056C11.6182 5.36501 10.1626 5 8.5 5C6.83744 5 5.38185 5.36501 4.37791 5.9056ZM3.42971 4.14465C4.7783 3.41849 6.57271 3 8.5 3C10.4273 3 12.2217 3.41849 13.5703 4.14465C14.8782 4.84889 16 5.98935 16 7.5C16 8.78755 15.1758 9.81204 14.147 10.5075C14.1067 10.5347 14.0828 10.5654 14.0718 10.5863C14.0674 10.5948 14.0658 10.6001 14.0652 10.6025L14.8851 18.801C15.0028 19.9784 14.0783 21 12.895 21H4.10499C2.92174 21 1.99718 19.9784 2.11491 18.801L2.93476 10.6025C2.93422 10.6001 2.9326 10.5948 2.92816 10.5863C2.91722 10.5654 2.89327 10.5347 2.85301 10.5075C1.82421 9.81204 1 8.78755 1 7.5C1 5.98935 2.12184 4.84889 3.42971 4.14465ZM2.93498 10.6042L2.93476 10.6025L2.93498 10.6042ZM14.065 10.6042L14.0652 10.6025L14.065 10.6042Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 4C7.5 3.44772 7.94772 3 8.5 3H15.5C17.4273 3 19.2217 3.41849 20.5703 4.14465C21.8782 4.84889 23 5.98935 23 7.5C23 8.78755 22.1758 9.81204 21.147 10.5075C21.1067 10.5347 21.0828 10.5654 21.0718 10.5863C21.0674 10.5948 21.0658 10.6001 21.0652 10.6025L21.8851 18.801C22.0028 19.9784 21.0783 21 19.895 21H12.895C12.3427 21 11.895 20.5523 11.895 20C11.895 19.4477 12.3427 19 12.895 19L12.075 10.7996C11.9911 9.96078 12.4411 9.24652 13.0269 8.85054C13.7671 8.35021 14 7.86005 14 7.5C14 7.07765 13.6668 6.46811 12.6221 5.9056C11.6182 5.36501 10.1626 5 8.5 5C7.94772 5 7.5 4.55228 7.5 4ZM21.065 10.6042L21.0652 10.6025L21.065 10.6042Z" fill="currentColor" />
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
        return 'Toast';
    }

    static function className()
    {
        return 'dan-toast';
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
        return ['content' => ['team_members' => ['members' => [[]]], 'toasts' => ['toasts' => [['title' => 'Welcome', 'message' => 'Thanks for visiting our site!\'', 'event' => 'pageload', 'show_time' => ['number' => 5, 'unit' => 's', 'style' => '5s'], 'show_time_pageload_' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'trigger_click_' => '.test']]], 'show_toasts_animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'gsap_easing' => 'back'], 'hide_toasts_animation' => ['duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'gsap_easing' => 'expo'], 'expand_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo'], 'collapse_toasts_animation' => ['duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'gsap_easing' => 'expo']], 'design' => ['toasts_container' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'zindex' => 99], 'toasts' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'background' => ['color' => ['breakpoint_base' => '#000']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#272729', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]], 'gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'title_and_message' => ['title_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 17, 'unit' => 'px', 'style' => '17px']], 'fontWeight' => ['breakpoint_base' => '500']]]]], 'message_typography' => ['color' => ['breakpoint_base' => '#6b7280'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]]]], 'close_button' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'right' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'top' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottom' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]]], 'dimensions' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'stroke_color' => '#6b7280', 'stroke_width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#f3f4f6']]]]];
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
        return [c(
        "toasts_container",
        "Toasts Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        false,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vw']]],
        false,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        false,
        false,
        [],
      ), c(
        "right",
        "Right",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vw']]],
        false,
        false,
        [],
      ), c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vw']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "toasts",
        "Toasts",
        [getPresetSection(
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
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "title_and_message",
        "Title and Message",
        [getPresetSection(
      "EssentialElements\\typography",
      "Title Typography",
      "title_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Message Typography",
      "message_typography",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "close_button",
        "Close Button",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw']]],
        false,
        false,
        [],
      ), c(
        "stroke_color",
        "Stroke color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stroke_width",
        "Stroke width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw']]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
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
        "toasts",
        "Toasts",
        [c(
        "toasts",
        "Toasts",
        [c(
        "title",
        "Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "message",
        "Message",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'click'], ['text' => 'pageload', 'value' => 'pageload']]],
        false,
        false,
        [],
      ), c(
        "show_time_pageload_",
        "Show Time (pageload)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "trigger_click_",
        "Trigger (click)",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => '.classname'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "show_toasts_animation",
        "Show Toasts Animation",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "hide_toasts_animation",
        "Hide Toasts Animation",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "expand_toasts_animation",
        "Expand Toasts Animation",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "collapse_toasts_animation",
        "Collapse Toasts Animation",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
          '0' =>  ['title' => 'Dancepad - Toast','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Toast/dancepad_toast.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_toast();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_toast();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
          '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],]
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

'onPropertyChange' => [['script' => 'dancepad_toast();',
],],

'onCreatedElement' => [['script' => 'dancepad_toast();',
],],

'onMountedElement' => [['script' => 'dancepad_toast();',
],],

'onMovedElement' => [['script' => 'dancepad_toast();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_toast();',
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
        return [['name' => 'data-show-duration', 'template' => '{{ content.show_toasts_animation.duration.style }}'], ['name' => 'data-show-ease', 'template' => '{{ content.show_toasts_animation.gsap_easing }}'], ['name' => 'data-hide-duration', 'template' => '{{ content.hide_toasts_animation.duration.style }}'], ['name' => 'data-hide-ease', 'template' => '{{ content.hide_toasts_animation.gsap_easing }}'], ['name' => 'data-expand-duration', 'template' => '{{ content.expand_toasts_animation.duration.style }}'], ['name' => 'data-expand-ease', 'template' => '{{ content.expand_toasts_animation.gsap_easing }}'], ['name' => 'data-collapse-duration', 'template' => '{{ content.collapse_toasts_animation.duration.style }}'], ['name' => 'data-collapse-ease', 'template' => '{{ content.collapse_toasts_animation.gsap_easing }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image']];
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
