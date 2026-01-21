<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_dropdown_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\DropdownElement",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class DropdownElement extends \Breakdance\Elements\Element
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
        return 'Dropdown Element';
    }

    static function className()
    {
        return 'dan-dropdown';
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
        "positioning",
        "Positioning",
        [c(
        "position",
        "Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'absolute', 'text' => 'absolute'], ['text' => 'relative', 'value' => 'relative'], ['text' => 'sticky', 'value' => 'sticky'], ['text' => 'fixed', 'value' => 'fixed']]],
        true,
        false,
        [],
      ), c(
        "toggled_position",
        "Toggled Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'absolute', 'text' => 'absolute'], ['text' => 'relative', 'value' => 'relative'], ['text' => 'sticky', 'value' => 'sticky'], ['text' => 'fixed', 'value' => 'fixed']]],
        true,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "right",
        "Right",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "mask",
        "Mask",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Mask is for having an additional spacing around the dropdown that will be taked into account to not close the dropdown. Think of it like an outer padding.</p><p>It is specially useful for the hover event, where hovering at this extra space won\'t close the dropdown</p>']],
        false,
        false,
        [],
      ), c(
        "padding_top",
        "Padding top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "padding_bottom",
        "Padding bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "padding_left",
        "Padding left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), c(
        "padding_right",
        "Padding right",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
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
        "settings",
        "Settings",
        [c(
        "open_at_the_builder",
        "Open at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "toggle_selector",
        "Toggle selector",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'classname'],
        false,
        false,
        [],
      ), c(
        "event",
        "Event",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'click'], ['text' => 'hover', 'value' => 'hover']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "accesibility",
        "Accesibility",
        [c(
        "opened_by_default",
        "Opened by default",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.event', 'operand' => 'equals', 'value' => 'click']]]],
        false,
        false,
        [],
      ), c(
        "close_when_clicking_outside",
        "Close when clicking outside",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.settings.event', 'operand' => 'equals', 'value' => 'click']]]],
        false,
        false,
        [],
      ), c(
        "close_when_pressing_esc",
        "Close when pressing ESC",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "fade_animation",
        "Fade animation",
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
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "transform_animation",
        "Transform animation",
        [c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "transform_x",
        "Transform X",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        false,
        false,
        [],
      ), c(
        "transform_y",
        "Transform Y",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
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
        "css_easing",
        "CSS easing",
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
        return ["type" => "container",  "restrictedToBeADescendantOf" => ['Dancepad\Dropdown'], ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'tabindex', 'template' => '0'], ['name' => 'data-toggled', 'template' => '{% if content.settings.event == "click" and content.accesibility.opened_by_default %}1{% endif %}'], ['name' => 'inert', 'template' => '{% if content.settings.event == "click" %}
                    {% if not content.accesibility.opened_by_default %}1{% endif %}
                 {% else %}1{% endif %}'], ['name' => 'data-closeclick', 'template' => '{% if content.settings.event == "click" %}
                    {% if content.accesibility.close_when_clicking_outside %}1{% else %}0{% endif %}
                 {% endif %}'], ['name' => 'data-closeesc', 'template' => '{% if content.accesibility.close_when_pressing_esc %}1{% else %}0{% endif %}'], ['name' => 'data-toggle', 'template' => '{{ content.settings.toggle_selector }}'], ['name' => 'data-trigger', 'template' => '{{ content.settings.event }}'], ['name' => 'data-toggled-builder', 'template' => '{% if content.settings.open_at_the_builder %}
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
        return [['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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

