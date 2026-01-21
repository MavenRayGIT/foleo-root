<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_burger_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Burger",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Burger extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5C6 4.44772 6.44772 4 7 4L17 4C17.5523 4 18 4.44772 18 5C18 5.55229 17.5523 6 17 6L7 6C6.44772 6 6 5.55228 6 5Z" fill="currentColor" />
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3 12C3 11.4477 3.44772 11 4 11L20 11C20.5523 11 21 11.4477 21 12C21 12.5523 20.5523 13 20 13L4 13C3.44772 13 3 12.5523 3 12Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 19C6 18.4477 6.44772 18 7 18L17 18C17.5523 18 18 18.4477 18 19C18 19.5523 17.5523 20 17 20L7 20C6.44772 20 6 19.5523 6 19Z" fill="currentColor" />
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
        return 'Burger';
    }

    static function className()
    {
        return 'dan-burger';
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
        return ['content' => ['tasty_hamburger_animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease'], 'burger' => ['collection' => 'distorted', 'tasty_type' => 'Boring', 'reverse' => false, 'lock_body_scroll_on_click' => true, 'distorted_type' => 'Distorsion v3', 'flipped_type' => 'Flipped', 'disfigured_type' => 'Minus', 'arrows_type' => 'Arrow up', 'general_type' => 'Simple'], 'animation' => ['duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'css_easing' => 'ease']], 'design' => ['tasty_hamburger_style' => ['dimensions' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_color_on_toggle' => null], 'burger_styles' => ['dimensions' => ['breakpoint_base' => ['number' => 36, 'unit' => 'px', 'style' => '36px']], 'stroke_color' => '#000', 'stroke_spacing' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'stroke_height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'stroke_radius' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'rounded' => true, 'stroke_color_on_toggle' => null], 'margin' => null]];
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
        "position",
        "Position",
        [c(
        "position",
        "Position",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'static', 'text' => 'static'], ['text' => 'absolute', 'value' => 'absolute'], ['text' => 'relative', 'value' => 'relative'], ['text' => 'fixed', 'value' => 'fixed']]],
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
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'vh', 'custom']]],
        true,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'vh', 'custom']]],
        true,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'vh', 'custom']]],
        true,
        false,
        [],
      ), c(
        "right",
        "Right",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'vh', 'custom']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     ), c(
        "burger_styles",
        "Burger styles",
        [c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'custom']]],
        true,
        false,
        [],
      ), c(
        "stroke_color",
        "Stroke color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stroke_color_on_toggle",
        "Stroke color on toggle",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stroke_spacing",
        "Stroke spacing",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'custom']], 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'tasty']]]],
        false,
        false,
        [],
      ), c(
        "stroke_height",
        "Stroke height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'custom']]],
        false,
        false,
        [],
      ), c(
        "stroke_radius",
        "Stroke radius",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'vw', 'em', 'rem', 'custom']], 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'tasty']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'disfigured']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'arrows']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'general'], ['path' => 'content.burger.general_type', 'operand' => 'not equals', 'value' => 'Bounce']]]],
        false,
        false,
        [],
      ), c(
        "rounded",
        "Rounded",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'distorted']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'flipped']]]],
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
        "burger",
        "Burger",
        [c(
        "collection",
        "Collection",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'tasty', 'text' => 'Tasty Hamburgers'], ['text' => 'Disfigured', 'value' => 'disfigured'], ['text' => 'Arrows', 'value' => 'arrows'], ['text' => 'Distorted', 'value' => 'distorted'], ['text' => 'Flipped', 'value' => 'flipped'], ['text' => 'General', 'value' => 'general']]],
        false,
        false,
        [],
      ), c(
        "tasty_type",
        "Tasty type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'Slider', 'text' => 'Slider'], ['text' => 'Squeeze', 'value' => 'Squeeze'], ['value' => 'Spin', 'text' => 'Spin'], ['text' => 'Elastic', 'value' => 'Elastic'], ['text' => 'Emphatic', 'value' => 'Emphatic'], ['text' => 'Collapse', 'value' => 'Collapse'], ['text' => 'Vortex', 'value' => 'Vortex'], ['text' => 'Stand', 'value' => 'Stand'], ['text' => 'Spring', 'value' => 'Spring'], ['text' => 'Minus', 'value' => 'Minus'], ['text' => '3DX', 'value' => '3DX'], ['value' => '3DY', 'text' => '3DY'], ['text' => '3DXY', 'value' => '3DXY'], ['text' => 'Boring', 'value' => 'Boring']], 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'tasty']]]],
        false,
        false,
        [],
      ), c(
        "distorted_type",
        "Distorted type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'Distorsion', 'text' => 'Distorsion'], ['text' => 'Distorsion v2', 'value' => 'Distorsion v2'], ['text' => 'Distorsion v3', 'value' => 'Distorsion v3'], ['text' => 'Arrow Distorsion', 'value' => 'Arrow Distorsion'], ['text' => 'Arrow Distorsion v2', 'value' => 'Arrow Distorsion v2'], ['text' => 'Chevron', 'value' => 'Chevron']], 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'distorted']]]],
        false,
        false,
        [],
      ), c(
        "flipped_type",
        "Flipped type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'Flipped', 'text' => 'Flipped'], ['text' => 'Flipped v2', 'value' => 'Flipped v2'], ['text' => 'Flipped v3', 'value' => 'Flipped v3'], ['text' => 'Flipped v4', 'value' => 'Flipped v4'], ['text' => 'Flipped v5', 'value' => 'Flipped v5'], ['text' => 'Flipped title', 'value' => 'Flipped title'], ['text' => 'Flipped arrow', 'value' => 'Flipped arrow'], ['text' => 'Flipped arrow v2', 'value' => 'Flipped arrow v2']], 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'flipped']]]],
        false,
        false,
        [],
      ), c(
        "disfigured_type",
        "Disfigured type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'disfigured']]], 'items' => [['value' => 'Arrow bottom', 'text' => 'Arrow bottom'], ['text' => 'Arrow right', 'value' => 'Arrow right'], ['text' => 'Arrow left', 'value' => 'Arrow left'], ['text' => 'Cross', 'value' => 'Cross'], ['text' => 'Chevron', 'value' => 'Chevron'], ['text' => 'Plus', 'value' => 'Plus'], ['text' => 'Minus', 'value' => 'Minus']]],
        false,
        false,
        [],
      ), c(
        "arrows_type",
        "Arrows type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'arrows']]], 'items' => [['value' => 'Arrow up', 'text' => 'Arrow up'], ['text' => 'Arrow right', 'value' => 'Arrow right'], ['text' => 'Arrow bottom', 'value' => 'Arrow bottom'], ['text' => 'Arrow left', 'value' => 'Arrow left']]],
        false,
        false,
        [],
      ), c(
        "general_type",
        "General type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'general']]], 'items' => [['value' => 'Simple', 'text' => 'Simple'], ['text' => 'Rotate', 'value' => 'Rotate'], ['text' => 'Fade', 'value' => 'Fade'], ['text' => 'Doble collapse', 'value' => 'Doble collapse'], ['text' => 'Triple collapse', 'value' => 'Triple collapse'], ['text' => 'Full collapse', 'value' => 'Full collapse'], ['value' => 'Bounce', 'text' => 'Bounce']]],
        false,
        false,
        [],
      ), c(
        "reverse",
        "Reverse",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'tasty']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'general'], ['path' => 'content.burger.general_type', 'operand' => 'equals', 'value' => 'Simple']], [['path' => 'content.burger.collection', 'operand' => 'equals', 'value' => 'general'], ['path' => 'content.burger.general_type', 'operand' => 'equals', 'value' => 'Rotate']]]],
        false,
        false,
        [],
      ), c(
        "lock_body_scroll_on_click",
        "Lock body scroll on click",
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
        "animation",
        "Animation",
        [c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']]],
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
        return ['0' =>  ['title' => 'Dancepad - Burger','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Burger/dancepad_burger.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_burger();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_burger();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_burger();',
],],

'onCreatedElement' => [['script' => 'dancepad_burger();',
],],

'onMountedElement' => [['script' => 'dancepad_burger();',
],],

'onMovedElement' => [['script' => 'dancepad_burger();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_burger();',
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
        return [['name' => 'data-scroll', 'template' => '{% if content.burger.lock_body_scroll_on_click %}
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
    }

    static function additionalClasses()
    {
        return [['name' => 'hamburger', 'template' => '{% if content.burger.collection == \'tasty\' %}
yes
{% endif %}']];
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
