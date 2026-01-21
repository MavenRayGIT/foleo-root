<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_glitchy_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Glitchy",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Glitchy extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">    <path opacity="0.4" d="M8.62814 12.6736H8.16918C6.68545 12.6736 5.94358 12.6736 5.62736 12.1844C5.31114 11.6953 5.61244 11.0138 6.21504 9.65082L8.02668 5.55323C8.57457 4.314 8.84852 3.69438 9.37997 3.34719C9.91142 3 10.5859 3 11.935 3H14.0244C15.6632 3 16.4826 3 16.7916 3.53535C17.1007 4.0707 16.6942 4.78588 15.8811 6.21623L14.8092 8.10187C14.405 8.81295 14.2029 9.16849 14.2057 9.45952C14.2094 9.83774 14.4105 10.1862 14.7354 10.377C14.9854 10.5239 15.3927 10.5239 16.2074 10.5239C17.2373 10.5239 17.7523 10.5239 18.0205 10.7022C18.3689 10.9338 18.5513 11.3482 18.4874 11.7632C18.4382 12.0826 18.0918 12.4656 17.399 13.2317L11.8639 19.3523C10.7767 20.5545 10.2331 21.1556 9.86807 20.9654C9.50303 20.7751 9.67833 19.9821 10.0289 18.3962L10.7157 15.2896C10.9826 14.082 11.1161 13.4781 10.7951 13.0759C10.4741 12.6736 9.85877 12.6736 8.62814 12.6736Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />    <path d="M10 20.9998C9.95336 20.9984 9.90956 20.987 9.86807 20.9654C9.50303 20.7751 9.67833 19.9821 10.0289 18.3962L10.7157 15.2896C10.9826 14.082 11.1161 13.4781 10.7951 13.0759C10.4741 12.6736 9.85877 12.6736 8.62814 12.6736H8.16918C6.68545 12.6736 5.94358 12.6736 5.62736 12.1844C5.31114 11.6953 5.61244 11.0138 6.21504 9.65082L8.02668 5.55323C8.57457 4.314 8.84852 3.69438 9.37997 3.34719C9.91142 3 10.5859 3 11.935 3H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>';
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
        return 'Glitchy';
    }

    static function className()
    {
        return 'dan-glitchy';
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
        return ['content' => ['default' => ['glitchy_elements' => [['play_mode' => 'always', 'animation_duration' => ['number' => 1000, 'unit' => 'ms', 'style' => '1000ms'], 'repeat_number' => 15, 'css_easing' => 'ease-in-out', 'glitch_time_start' => 0.4, 'glitch_time_end' => 0.7, 'shake_velocity' => 10, 'x_amplitude' => 0.4, 'y_amplitude' => 0.4, 'layers_number' => 4, 'steps_number' => 10, 'minheight_per_slice' => 0.02, 'maxheight_per_slice' => 0.4, 'final_pulse' => true, 'element' => null]]]]];
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
        return [];
    }

    static function contentControls()
    {
        return [c(
        "default",
        "Default",
        [c(
        "glitchy_elements",
        "Glitchy elements",
        [c(
        "element",
        "Element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true], 'placeholder' => 'className'],
        false,
        false,
        [],
      ), c(
        "play_mode",
        "Play mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'click', 'value' => 'click'], ['text' => 'always', 'value' => 'always']]],
        false,
        false,
        [],
      ), c(
        "animation_duration",
        "Animation duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']]],
        false,
        false,
        [],
      ), c(
        "repeat_number",
        "Repeat number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
      ), c(
        "glitch_time_start",
        "Glitch time start",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "glitch_time_end",
        "Glitch time end",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "shake_velocity",
        "Shake velocity",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "x_amplitude",
        "X amplitude",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "y_amplitude",
        "Y amplitude",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "layers_number",
        "Layers number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "steps_number",
        "Steps number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "minheight_per_slice",
        "minHeight per slice",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "maxheight_per_slice",
        "maxHeight per slice",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "final_pulse",
        "Final pulse",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
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
            '0' =>  [
                'title' => 'Dancepad - Glitchy library',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_powerglitch.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' =>  [
                'title' => 'Dancepad - Glitchy',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Glitchy/dancepad_glitchy.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '2' =>  [
                'title' => 'Init Builder',
                'inlineScripts' => [
                    'dancepad_glitchy();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '3' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_glitchy();'
                ],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
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

'onPropertyChange' => [['script' => 'dancepad_glitchy();',
],],

'onCreatedElement' => [['script' => 'dancepad_glitchy();',
],],

'onMountedElement' => [['script' => 'dancepad_glitchy();',
],],

'onMovedElement' => [['script' => 'dancepad_glitchy();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_glitchy();',
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance']];
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
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}

}
