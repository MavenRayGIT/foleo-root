<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_gradiently_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Gradiently",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Gradiently extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path d="M9.25 16C9.25 12.2721 12.2721 9.25 16 9.25C19.7279 9.25 22.75 12.2721 22.75 16C22.75 19.7279 19.7279 22.75 16 22.75C12.2721 22.75 9.25 19.7279 9.25 16Z" fill="currentColor" />
    <path opacity="0.4" d="M5.25 8C5.25 4.27208 8.27208 1.25 12 1.25C15.7279 1.25 18.75 4.27208 18.75 8C18.75 8.06385 18.75 8.09578 18.7446 8.12394C18.7154 8.27516 18.574 8.38066 18.4208 8.36566C18.3922 8.36287 18.3541 8.35157 18.278 8.32899C17.556 8.11492 16.7914 8 16 8C12.6711 8 9.81706 10.0333 8.61206 12.9256C8.46403 13.281 8.39001 13.4586 8.24327 13.4949C8.09654 13.5312 7.96484 13.4223 7.70144 13.2046C6.20411 11.9665 5.25 10.0947 5.25 8Z" fill="currentColor" />
    <path opacity="0.4" d="M8 16.0019C8 15.7858 8.00857 15.5717 8.02538 15.36C8.04047 15.1699 8.04802 15.0749 8.01134 15.0007C7.97467 14.9265 7.89871 14.8775 7.7468 14.7794L7.66512 14.7266C6.3127 13.8533 5.2393 12.5812 4.61215 11.076C4.46416 10.7208 4.39016 10.5432 4.24343 10.5069C4.0967 10.4706 3.965 10.5795 3.70161 10.7972C2.20418 12.0353 1.25 13.9072 1.25 16.0019C1.25 19.7298 4.27208 22.7519 8 22.7519C8.68605 22.7519 9.34819 22.6496 9.97199 22.4593C10.3498 22.3441 10.5387 22.2865 10.5817 22.1254C10.6246 21.9643 10.472 21.8019 10.167 21.477C8.82313 20.0458 8 18.12 8 16.0019Z" fill="currentColor" />
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
        return 'Gradiently';
    }

    static function className()
    {
        return 'dan-gradiently';
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
        return ['design' => ['dimensions' => ['height' => ['number' => 500, 'unit' => 'px', 'style' => '500px'], 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]], 'content' => ['gradiently' => ['colors' => [['color' => '#FF5373'], ['color' => '#FFC858'], ['color' => '#17E7FF'], ['color' => '#6D3BFF']]], 'animation' => ['color_blending' => 6, 'saturation' => 7, 'highlights' => 2, 'shadows' => 0, 'wave_amplitude' => 5, 'wave_frequency_y' => 3, 'wave_frequency_x' => 2, 'vertical_pressure' => 5, 'horizontal_pressure' => 4, 'speed' => 4, 'grain_scale' => 2, 'grain_intensity' => 0.55, 'grain_sparsity' => 0, 'grain_speed' => 0.1]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Gradiently', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]]]]]], 'children' => []]];
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
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "gradiently",
        "Gradiently",
        [c(
        "colors",
        "Colors",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
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
      ), c(
        "animation",
        "Animation",
        [c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "horizontal_pressure",
        "Horizontal pressure",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "vertical_pressure",
        "Vertical pressure",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "wave_frequency_x",
        "Wave frequency X",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "wave_frequency_y",
        "Wave frequency Y",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "wave_amplitude",
        "Wave amplitude",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "shadows",
        "Shadows",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "highlights",
        "Highlights",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "saturation",
        "Saturation",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "color_blending",
        "Color blending",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "grain_scale",
        "Grain scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "grain_intensity",
        "Grain intensity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "grain_sparsity",
        "Grain sparsity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "grain_speed",
        "Grain speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 0.1]],
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
        return ['0' =>  ['title' => 'Dancepad - ThreeJS','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_three.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Dancepad - Gradiently library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_gradiently_library.min.js?ver=' . DANCEPAD_VERSION],],'2' =>  ['title' => 'Dancepad - Gradiently','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Gradiently/dancepad_gradiently.min.js?ver=' . DANCEPAD_VERSION],],'3' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_gradiently();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'4' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_gradiently();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_gradiently();',
],],

'onCreatedElement' => [['script' => 'dancepad_gradiently();',
],],

'onMountedElement' => [['script' => 'dancepad_gradiently();',
],],

'onMovedElement' => [['script' => 'dancepad_gradiently();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_gradiently();',
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
        return [
            ['name' => 'data-flickering', 'template' => '1'],
            ['name' => 'data-speed', 'template' => '{{ content.animation.speed }}'],
            ['name' => 'data-horizontal-pressure', 'template' => '{{ content.animation.horizontal_pressure }}'],
            ['name' => 'data-vertical-pressure', 'template' => '{{ content.animation.vertical_pressure }}'],
            ['name' => 'data-wave-frequency-x', 'template' => '{{ content.animation.wave_frequency_x }}'],
            ['name' => 'data-wave-frequency-y', 'template' => '{{ content.animation.wave_frequency_y }}'],
            ['name' => 'data-wave-amplitude', 'template' => '{{ content.animation.wave_amplitude }}'],
            ['name' => 'data-shadows', 'template' => '{{ content.animation.shadows }}'],
            ['name' => 'data-highlights', 'template' => '{{ content.animation.highlights }}'],
            ['name' => 'data-saturation', 'template' => '{{ content.animation.saturation }}'],
            ['name' => 'data-color-blending', 'template' => '{{ content.animation.color_blending }}'],
            ['name' => 'data-grain-scale', 'template' => '{{ content.animation.grain_scale }}'],
            ['name' => 'data-grain-intensity', 'template' => '{{ content.animation.grain_intensity }}'],
            ['name' => 'data-grain-sparsity', 'template' => '{{ content.animation.grain_sparsity }}'],
            ['name' => 'data-grain-speed', 'template' => '{{ content.animation.grain_speed }}']
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'string', 'path' => 'content.animation.grain_intensity']];
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
