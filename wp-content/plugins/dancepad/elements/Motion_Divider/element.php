<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_motion_divider_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\MotionDivider",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class MotionDivider extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M21.5002 11C22.0525 11 22.5002 11.4477 22.5002 12C22.5002 12.5523 22.0525 13 21.5002 13L12.0001 13L12.0001 11L21.5002 11Z" fill="currentColor" />
    <path d="M1.5 12C1.5 11.4477 1.94772 11 2.5 11L12.0001 11L12.0001 13L2.5 13C1.94772 13 1.5 12.5523 1.5 12Z" fill="currentColor" />
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
        return 'Motion Divider';
    }

    static function className()
    {
        return 'dan-motion-divider';
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
        return ['design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'colors' => ['color' => '#000'], 'type' => ['type' => 'solid'], 'size' => ['height' => ['breakpoint_base' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]], 'content' => ['animation' => ['direction' => 'fromCenter', 'duration' => ['number' => 1.3, 'unit' => 's', 'style' => '1.3s'], 'gsap_easing' => 'expo'], 'scrolltrigger' => ['toggleactions' => 'play none none none', 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'start' => 'top bottom', 'trigger' => 'this', 'end' => 'unset', 'additional_triggers' => null, 'element' => null]]];
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
     ), c(
        "dimensions",
        "Dimensions",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
        false,
        false,
        [],
      ), c(
        "max_width",
        "max Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
        false,
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
        "color",
        "Color",
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
        "type",
        "Type",
        [c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'dotted', 'text' => 'dotted'], ['text' => 'dashed', 'value' => 'dashed'], ['text' => 'solid', 'value' => 'solid'], ['text' => 'double', 'value' => 'double'], ['text' => 'groove', 'value' => 'groove'], ['text' => 'ridge', 'value' => 'ridge'], ['text' => 'inset', 'value' => 'inset'], ['text' => 'outset', 'value' => 'outset']]],
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
        "animation",
        "Animation",
        [c(
        "direction",
        "Direction",
        [],
        ['type' => 'dropdown', 'layout' => 'vertical', 'items' => [['value' => 'fromLeft', 'text' => 'fromLeft'], ['text' => 'fromRight', 'value' => 'fromRight'], ['text' => 'fromCenter', 'value' => 'fromCenter']]],
        false,
        false,
        [],
      ), c(
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
        "scrolltrigger",
        "ScrollTrigger",
        [c(
        "trigger",
        "Trigger",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "end",
        "End",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "delay",
        "Delay",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "scrub",
        "Scrub",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "toggleactions",
        "toggleActions",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "additional_triggers",
        "Additional Triggers",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'Click'], ['text' => 'Hover', 'value' => 'hover']]],
        false,
        false,
        [],
      ), c(
        "element",
        "Element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'click']], [['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'hover']]]],
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
            '0' =>  ['title' => 'Dancepad - Motion Divider','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Motion_Divider/dancepad_motion_divider.min.js?ver=' . DANCEPAD_VERSION],],
            '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_motion_divider();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_motion_divider();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
            '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],]
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

'onPropertyChange' => [['script' => 'dancepad_motion_divider();',
],],

'onCreatedElement' => [['script' => 'dancepad_motion_divider();',
],],

'onMountedElement' => [['script' => 'dancepad_motion_divider();',
],],

'onMovedElement' => [['script' => 'dancepad_motion_divider();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_motion_divider();',
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
        return [['name' => 'data-type', 'template' => '{{ content.animation.direction }}'], ['name' => 'data-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-trigger', 'template' => '{{ content.scrolltrigger.trigger }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-end', 'template' => '{{ content.scrolltrigger.end }}'], ['name' => 'data-delay', 'template' => '{{ content.scrolltrigger.delay.style }}'], ['name' => 'data-scrub', 'template' => '{{ content.scrolltrigger.scrub ? "true" : "false" }}'], ['name' => 'data-toggle-actions', 'template' => '{{ content.scrolltrigger.toggleactions }}'], ['name' => 'data-animation-type', 'template' => '{{ content.scrolltrigger.additional_triggers }}'], ['name' => 'data-trigger-element', 'template' => '{{ content.scrolltrigger.element }}']];
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
