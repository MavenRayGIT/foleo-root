<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_back_to_top_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\BackToTop",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class BackToTop extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path opacity="0.4" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z" fill="currentColor" />     <path d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V11.5H10.838C10.5476 11.5001 10.2403 11.5002 9.99783 11.4712C9.82103 11.45 9.1705 11.3702 8.87038 10.7613C8.57002 10.1519 8.91494 9.60918 9.00859 9.46263C9.13753 9.26085 9.33054 9.02819 9.51315 8.80807L9.54449 8.77029C9.83196 8.42352 10.1743 8.02882 10.5176 7.71482C10.689 7.55802 10.8873 7.39647 11.1026 7.26884C11.3022 7.15052 11.6174 7 12 7C12.3826 7 12.6978 7.15052 12.8974 7.26884C13.1127 7.39647 13.311 7.55802 13.4824 7.71482C13.8257 8.02882 14.168 8.42352 14.4555 8.77028L14.4869 8.80808C14.6695 9.02819 14.8625 9.26085 14.9914 9.46263C15.0851 9.60918 15.43 10.1519 15.1296 10.7613C14.8295 11.3702 14.179 11.45 14.0022 11.4712C13.7597 11.5002 13.4524 11.5001 13.162 11.5H13V16Z" fill="currentColor" /> </svg>';
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
        return 'Back To Top';
    }

    static function className()
    {
        return 'dan-back-to-top';
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
        return ['content' => ['animation' => ['speed' => 10, 'progress_css_easing' => 'linear', 'entrance_distance' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'entrance_speed' => ['number' => 200, 'unit' => 'ms', 'style' => '200ms'], 'entrance_css_easing' => 'linear'], 'back_to_top' => ['gsap_easing' => 'expo', 'scroll_to' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 1000, 'unit' => 'ms', 'style' => '1000ms']]], 'design' => ['spacing' => ['right' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px']], 'dimensions' => ['arrow_dimensions' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'width' => ['number' => 46, 'unit' => 'px', 'style' => '46px'], 'height' => ['number' => 46, 'unit' => 'px', 'style' => '46px']], 'borders' => ['shadow' => ['breakpoint_base' => null], 'radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'topLeft' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'topRight' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'bottomLeft' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'bottomRight' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'editMode' => 'all']]], 'arrow' => ['type' => 'type2'], 'colors' => ['arrow_color' => '#000', 'circle_color' => '#e3e3e3', 'progress_color' => '#E0480FFF', 'path_color' => '#a4a4a4']]];
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
        "arrow",
        "Arrow",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'type1', 'text' => 'Arrow'], ['value' => 'type2', 'text' => 'Angle'], ['text' => 'Angles', 'value' => 'type3']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "spacing",
        "Spacing",
        [c(
        "right",
        "Right",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'custom']]],
        true,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom', 'vh']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "dimensions",
        "Dimensions",
        [c(
        "arrow_dimensions",
        "Arrow dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'custom']]],
        true,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'custom']]],
        true,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom', 'vh']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "colors",
        "Colors",
        [c(
        "arrow_color",
        "Arrow color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "circle_color",
        "Circle color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_color",
        "Path color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_color",
        "Progress color",
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
      )];
    }

    static function contentControls()
    {
        return [c(
        "back_to_top",
        "Back to Top",
        [c(
        "scroll_to",
        "Scroll To",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['custom', 'ms']]],
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
        "animation",
        "Animation",
        [c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_css_easing",
        "Progress CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "entrance_distance",
        "Entrance distance",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        false,
        false,
        [],
      ), c(
        "entrance_speed",
        "Entrance speed",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['custom', 'ms']]],
        false,
        false,
        [],
      ), c(
        "entrance_css_easing",
        "Entrance CSS easing",
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
          '0' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],],
            '1' =>  ['title' => 'Dancepad - Scroll To','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_gsap_scroll_to_top.min.js?ver=' . DANCEPAD_VERSION],],
            '2' =>  ['title' => 'Dancepad - Back to Top','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Back_to_top/dancepad_back_to_top.min.js?ver=' . DANCEPAD_VERSION],],
            '3' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_back_to_top();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '4' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_back_to_top();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_back_to_top();',
],],

'onCreatedElement' => [['script' => 'dancepad_back_to_top();',
],],

'onMountedElement' => [['script' => 'dancepad_back_to_top();',
],],

'onMovedElement' => [['script' => 'dancepad_back_to_top();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_back_to_top();',
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
        return [
            ['name' => 'data-scroll-to-pixel', 'template' => '{{ content.back_to_top.scroll_to.style }}'],
            ['name' => 'data-back-duration', 'template' => '{{ content.back_to_top.duration.style }}'],
            ['name' => 'data-back-easing', 'template' => '{{ content.back_to_top.gsap_easing }}'],
            ['name' => 'data-speed', 'template' => '{{ content.animation.speed }}'],
            ['name' => 'data-ease', 'template' => '{{ content.animation.progress_css_easing }}'],
            ['name' => 'data-entrance-distance', 'template' => '{{ content.animation.entrance_distance.style }}'],
            ['name' => 'data-flickering', 'template' => '1']
        ];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
