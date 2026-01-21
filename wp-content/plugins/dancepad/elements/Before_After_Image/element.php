<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_before_after_image_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\BeforeAfterImage",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class BeforeAfterImage extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path d="M3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />     <path opacity="0.4" d="M12 2.5V21.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /> </svg>';
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
        return 'Before/After Image';
    }

    static function className()
    {
        return 'dan-before-after-image';
    }

    static function category()
    {
        return 'dancepad_medias';
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
        return ['content' => ['content' => ['before_image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/4091975/pexels-photo-4091975.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'alt' => 'mountain_before', 'caption' => ''], 'after_image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1553963/pexels-photo-1553963.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'alt' => '', 'caption' => '']], 'distance' => ['show_distance' => 150, 'arrow_type' => 'type1'], 'thumb' => ['thumb_width' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'thumb_height' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'arrow_dimensions' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'arrows_gap' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'arrow_type' => 'type1', 'arrow_color' => '#333333', 'thumb_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#FFF', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#FFF', 'style' => 'solid'], 'left' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#FFF', 'style' => 'solid'], 'right' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#FFF', 'style' => 'solid']]]], 'thumb_background' => '#FFFFFFFF'], 'line_separator' => ['line_width' => ['number' => 3, 'unit' => 'px', 'style' => '3px'], 'line_color' => '#FFF'], 'animation' => ['show_distance' => ['number' => 150, 'unit' => 'px', 'style' => '150px'], 'opacity' => 0.6, 'opacity_duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s']]], 'design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]]];
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
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "before_image",
        "Before Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "after_image",
        "After Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "thumb",
        "Thumb",
        [c(
        "arrow_type",
        "Arrow type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'type1', 'text' => 'Chevron'], ['text' => 'Caret', 'value' => 'type2'], ['text' => 'Angles', 'value' => 'type3'], ['text' => 'Square Caret', 'value' => 'type4'], ['text' => 'Arrows', 'value' => 'type5']]],
        false,
        false,
        [],
      ), c(
        "arrow_color",
        "Arrow color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "arrow_dimensions",
        "Arrow dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "arrows_gap",
        "Arrows gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "thumb_width",
        "Thumb width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "thumb_height",
        "Thumb height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Thumb border",
      "thumb_border",
       ['type' => 'popout']
     ), c(
        "thumb_background",
        "Thumb background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "line_separator",
        "Line separator",
        [c(
        "line_width",
        "Line width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "line_color",
        "Line color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
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
        "show_distance",
        "Show distance",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%'], 'defaultType' => 'px']],
        false,
        false,
        [],
      ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "opacity_duration",
        "Opacity duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
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
          '0' =>  ['title' => 'Dancepad - Before After Image','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Before_After_Image/dancepad_before_after_image.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_before_after_image();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_before_after_image();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_before_after_image();',
],],

'onCreatedElement' => [['script' => 'dancepad_before_after_image();',
],],

'onMountedElement' => [['script' => 'dancepad_before_after_image();',
],],

'onMovedElement' => [['script' => 'dancepad_before_after_image();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_before_after_image();',
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
        return [['name' => 'data-showafter', 'template' => '{{ content.animation.show_distance.style }}'], ['name' => 'data-flickering', 'template' => '1']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'image_url', 'path' => 'content.content.before_image'], ['accepts' => 'image_url', 'path' => 'content.content.after_image']];
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
