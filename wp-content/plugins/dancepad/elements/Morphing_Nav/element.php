<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_morphing_nav_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\MorphingNav",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class MorphingNav extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path d="M1.25 12.0312C1.25 9.82211 3.04086 8.03125 5.25 8.03125C7.45914 8.03125 9.25 9.82211 9.25 12.0312C9.25 14.2404 7.45914 16.0312 5.25 16.0312C3.04086 16.0312 1.25 14.2404 1.25 12.0312Z" fill="currentColor" />     <path opacity="0.4" d="M10.75 11.9981C10.75 11.4458 11.1977 10.9981 11.75 10.9981L17.75 10.9981L17.75 9.66797C17.7498 9.52243 17.7495 9.31039 17.7754 9.1299C17.8038 8.93271 17.9119 8.41537 18.4273 8.15257C18.939 7.89172 19.3882 8.11758 19.5564 8.2184C19.7069 8.30862 19.864 8.44005 19.9705 8.52916L19.9971 8.55139C20.4458 8.9256 21.0713 9.46884 21.5923 10.0057C21.8506 10.272 22.1074 10.5612 22.3067 10.845C22.4064 10.9871 22.5074 11.1497 22.5868 11.3252C22.6614 11.4901 22.75 11.7378 22.75 12.0312C22.75 12.3246 22.6614 12.5724 22.5868 12.7373C22.5074 12.9128 22.4065 13.0754 22.3067 13.2174C22.1074 13.5013 21.8506 13.7905 21.5923 14.0567C21.0714 14.5936 20.4458 15.1369 19.9971 15.5111L19.9705 15.5333C19.864 15.6224 19.7069 15.7539 19.5564 15.8441C19.3882 15.9449 18.939 16.1708 18.4274 15.9099C17.9119 15.6471 17.8038 15.1298 17.7754 14.9326C17.7495 14.7521 17.7498 14.5401 17.75 14.3945L17.75 12.9981H11.75C11.1977 12.9981 10.75 12.5504 10.75 11.9981Z" fill="currentColor" /> </svg>';
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
        return 'Morphing Nav';
    }

    static function className()
    {
        return 'dan-morphing-nav';
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
        return ['content' => ['content' => ['event' => 'hover', 'active_item' => 1, 'page_name_as_active_item' => false], 'animation' => ['morphing_transition' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease']], 'design' => ['morphing_div_style' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all']]], 'background' => '#D1C9FF'], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => null, 'flex_direction' => ['breakpoint_base' => 'row']]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'background' => ['color' => ['breakpoint_base' => null]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]], ['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'background' => ['color' => null], 'margin' => ['margin' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]], ['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [getPresetSection(
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
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
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     ), c(
        "morphing_div_style",
        "Morphing Div Style",
        [c(
        "margin",
        "Margin",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        true,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "background",
        "Background",
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
        "content",
        "Content",
        [c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'click', 'value' => 'click']]],
        false,
        false,
        [],
      ), c(
        "page_name_as_active_item",
        "Page name as active item",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "active_item",
        "Active item",
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
        ['type' => 'text', 'layout' => 'vertical', 'unitOptions' => ['types' => ['s']]],
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
        return ['0' =>  ['title' => 'Dancepad - Morphing Nav','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Morphing_Nav/dancepad_morphing_nav.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_morphing_nav();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_morphing_nav();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_morphing_nav();',
],],

'onCreatedElement' => [['script' => 'dancepad_morphing_nav();',
],],

'onMountedElement' => [['script' => 'dancepad_morphing_nav();',
],],

'onMovedElement' => [['script' => 'dancepad_morphing_nav();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_morphing_nav();',
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
        return [['name' => 'data-active-item', 'template' => '{{ content.content.active_item }}'], ['name' => 'data-trigger', 'template' => '{{ content.content.event }}'], ['name' => 'data-morph-bg-preserve', 'template' => '1'], ['name' => 'data-page-name', 'template' => '{% if content.content.page_name_as_active_item %}
1
{% else %}
0
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