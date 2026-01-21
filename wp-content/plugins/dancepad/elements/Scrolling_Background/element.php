<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_scrolling_background_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ScrollingBackground",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScrollingBackground extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M8 6.99997L12 3L16 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M16 17L12 21L8 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
        return 'Scrolling Background';
    }

    static function className()
    {
        return 'dan-scrolling-background';
    }

    static function category()
    {
        return 'dancepad_backgrounds';
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
        return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 400, 'unit' => 'svh', 'style' => '400svh']], 'min_width' => null], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column']]], 'content' => ['scrolling_background' => ['colors' => [['color' => '#ff6b8a'], ['color' => '#ffb347'], ['color' => '#ffe4b5'], ['color' => '#ff8a4d']], 'transition' => 'fade', 'duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'gsap_easing' => 'expo']]];
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
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "scrolling_background",
        "Scrolling Background",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Scrolling Background is a nestable element. You can put any elements inside it and edit its display settings at the Style tab.</p>']],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Scrolling Background Height will be divided by the number of colors, resulting in X pixels. A color switch will happen every those X pixels.</p>']],
        false,
        false,
        [],
      ), c(
        "colors",
        "Colors",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "transition",
        "Transition",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'fade', 'text' => 'fade'], ['text' => 'progressive', 'value' => 'progressive']]],
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
                'title' => 'Dancepad - Scrolling Background',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Scrolling_Background/dancepad_scrolling_background.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_scrolling_background();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_scrolling_background();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%', '%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
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

'onPropertyChange' => [['script' => 'dancepad_scrolling_background();',
],],

'onCreatedElement' => [['script' => 'dancepad_scrolling_background();',
],],

'onMountedElement' => [['script' => 'dancepad_scrolling_background();',
],],

'onMovedElement' => [['script' => 'dancepad_scrolling_background();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_scrolling_background();',
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
        return [['name' => 'data-duration', 'template' => '{{ content.scrolling_background.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ content.scrolling_background.gsap_easing }}'], ['name' => 'data-transition', 'template' => '{{ content.scrolling_background.transition }}'], ['name' => 'data-colors', 'template' => '{% for item in content.scrolling_background.colors %}
{{ item.color }},
{% endfor %}'], ['name' => 'style', 'template' => 'background-color: {{ content.scrolling_background.colors[0].color }};']];
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