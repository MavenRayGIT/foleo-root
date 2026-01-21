<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_image_hotspots_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Hotspot",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Hotspot extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'SquareIcon';
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
        return false;
    }

    static function name()
    {
        return 'Hotspot';
    }

    static function className()
    {
        return 'dan-image-hotspots__hotspot';
    }

    static function category()
    {
        return 'other';
    }

    static function badge()
    {
        return false;
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
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "spacing",
        "Spacing",
        [c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', 'vw', 'vh', 'custom', 'auto', '%']]],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', 'vw', 'vh', 'custom', 'auto', '%']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "dimensions",
        "Dimensions",
        [c(
        "min_width",
        "Min width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
        false,
        [],
      ), c(
        "min_height",
        "Min height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        false,
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
        "colors",
        "Colors",
        [c(
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
      ), c(
        "tooltip",
        "Tooltip",
        [c(
        "arrow",
        "Arrow",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'block', 'text' => 'Enable'], ['text' => 'Disable', 'value' => 'none']]],
        false,
        false,
        [],
      ), c(
        "arrow_color",
        "Arrow color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => [[['path' => 'design.tooltip.arrow', 'operand' => 'equals', 'value' => 'block']]]],
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
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
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
        "content",
        "Content",
        [c(
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
      ), c(
        "pulse",
        "Pulse",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "intensity",
        "Intensity",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
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
        "tooltip",
        "Tooltip",
        [c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'click', 'value' => 'click']]],
        false,
        false,
        [],
      ), c(
        "placement",
        "Placement",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top', 'text' => 'top'], ['text' => 'bottom', 'value' => 'bottom'], ['text' => 'left', 'value' => 'left'], ['text' => 'right', 'value' => 'right']]],
        false,
        false,
        [],
      ), c(
        "vertical_distance",
        "Vertical distance",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']], 'condition' => [[['path' => 'content.tooltip.placement', 'operand' => 'equals', 'value' => 'top']], [['path' => 'content.tooltip.placement', 'operand' => 'equals', 'value' => 'bottom']]]],
        false,
        false,
        [],
      ), c(
        "horizontal_distance",
        "Horizontal distance",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']], 'condition' => [[['path' => 'content.tooltip.placement', 'operand' => 'equals', 'value' => 'left']], [['path' => 'content.tooltip.placement', 'operand' => 'equals', 'value' => 'right']]]],
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
        return false;
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
        return ["type" => "container",  "restrictedToBeADescendantOf" => ['Dancepad\ImageHotspots'], ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'data-arrow', 'template' => '{{ content.tooltip.placement }}'], ['name' => 'data-type', 'template' => '{{ content.tooltip.event }}'], ['name' => 'tabindex', 'template' => '0']];
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
        return [];
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
