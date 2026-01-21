<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_highlight_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\HighlightMark",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class HighlightMark extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M20 18V6M6 20H18M18 4H6M4 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M21 2H19C18.4477 2 18 2.44772 18 3V5C18 5.55228 18.4477 6 19 6H21C21.5523 6 22 5.55228 22 5V3C22 2.44772 21.5523 2 21 2Z" stroke="currentColor" stroke-width="1.5" />
    <path d="M5 2H3C2.44772 2 2 2.44772 2 3V5C2 5.55228 2.44772 6 3 6H5C5.55228 6 6 5.55228 6 5V3C6 2.44772 5.55228 2 5 2Z" stroke="currentColor" stroke-width="1.5" />
    <path d="M21 18H19C18.4477 18 18 18.4477 18 19V21C18 21.5523 18.4477 22 19 22H21C21.5523 22 22 21.5523 22 21V19C22 18.4477 21.5523 18 21 18Z" stroke="currentColor" stroke-width="1.5" />
    <path d="M5 18H3C2.44772 18 2 18.4477 2 19V21C2 21.5523 2.44772 22 3 22H5C5.55228 22 6 21.5523 6 21V19C6 18.4477 5.55228 18 5 18Z" stroke="currentColor" stroke-width="1.5" />
    <path opacity="0.4" d="M8.00831 9.76304C7.87958 8.27659 8.73851 8.22606 12.0056 8.02393M12.0056 8.02393C14.9204 8.19237 16.2343 8.19237 16.0093 9.78086M12.0056 8.02393V16M10.6635 16H13.3364" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>';
    }

    static function tag()
    {
        return 'mark';
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
        return 'Highlight Mark';
    }

    static function className()
    {
        return 'dan-highlight__mark';
    }

    static function category()
    {
        return 'dancepad_texts';
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
        return false;
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
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Typography",
      "typography",
       ['type' => 'popout']
     ), c(
        "selectors",
        "Selectors",
        [c(
        "initial_width",
        "Initial width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "final_width",
        "Final width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "mix_blend_mode",
        "Mix blend mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'difference', 'text' => 'difference'], ['text' => 'exclusion', 'value' => 'exclusion'], ['text' => 'normal', 'value' => 'normal'], ['text' => 'screen', 'value' => 'screen'], ['text' => 'lighten', 'value' => 'lighten'], ['text' => 'hard-light', 'value' => 'hard-light'], ['text' => 'luminosity', 'value' => 'luminosity'], ['text' => 'plus-lighter', 'value' => 'plus-lighter']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "selectors_line",
        "Selectors Line",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
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
      ), c(
        "selectors_circle",
        "Selectors Circle",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'html'], 'autofocus' => true],
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
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
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
        "delay",
        "Delay",
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
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "scrolltrigger",
        "ScrollTrigger",
        [c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'inline'],
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
      )],
        ['type' => 'section'],
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
        return ["type" => "final",  "restrictedToBeADescendantOf" => ['Dancepad\Highlight'], ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-disable-builder', 'template' => '{% if content.animation.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-delay', 'template' => '{{ content.animation.delay.style }}'], ['name' => 'data-ease', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-toggleActions', 'template' => '{{ content.scrolltrigger.toggleactions }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.selectors.background.layers[].image']];
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