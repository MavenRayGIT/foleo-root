<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_click_and_copy_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ClickAndCopy",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ClickAndCopy extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path d="M7.5 3C7.5 2.0335 8.2835 1.25 9.25 1.25H14.75C15.7165 1.25 16.5 2.0335 16.5 3C16.5 3.9665 15.7165 4.75 14.75 4.75H9.25C8.2835 4.75 7.5 3.9665 7.5 3Z" fill="currentColor" />
    <path opacity="0.4" d="M6.08629 2.8529C6.17409 2.84079 6.25 2.9125 6.25 3.00113C6.25 4.65798 7.59315 6.00113 9.25 6.00113H14.75C16.4069 6.00113 17.75 4.65798 17.75 3.00113C17.75 2.9125 17.8259 2.84079 17.9137 2.8529C18.8138 2.97705 19.5615 3.24236 20.1519 3.83332C20.7537 4.43567 21.0125 5.19403 21.1335 6.09477C21.25 6.96246 21.25 8.06574 21.25 9.43469V16.0503C21.25 17.4193 21.25 18.5226 21.1335 19.3903C21.0125 20.291 20.7537 21.0494 20.1519 21.6517C19.55 22.2542 18.7921 22.5133 17.8918 22.6345C17.0248 22.7512 15.9225 22.7512 14.5549 22.7511L9.44506 22.7511C8.07752 22.7511 6.97517 22.7512 6.10816 22.6345C5.20792 22.5133 4.44999 22.2542 3.84811 21.6517C3.24631 21.0494 2.9875 20.291 2.86651 19.3903C2.74997 18.5226 2.74998 17.4193 2.75 16.0504V9.43465C2.74998 8.06574 2.74997 6.96244 2.86651 6.09477C2.9875 5.19403 3.24631 4.43567 3.84811 3.83332C4.43852 3.24236 5.18618 2.97705 6.08629 2.8529Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25195 11C7.25195 10.5858 7.58774 10.25 8.00195 10.25H16.002C16.4162 10.25 16.752 10.5858 16.752 11C16.752 11.4142 16.4162 11.75 16.002 11.75H8.00195C7.58774 11.75 7.25195 11.4142 7.25195 11ZM7.25195 16C7.25195 15.5858 7.58774 15.25 8.00195 15.25H12.002C12.4162 15.25 12.752 15.5858 12.752 16C12.752 16.4142 12.4162 16.75 12.002 16.75H8.00195C7.58774 16.75 7.25195 16.4142 7.25195 16Z" fill="currentColor" />
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
        return 'Click And Copy';
    }

    static function className()
    {
        return 'dan-click-and-copy';
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
        return ['content' => ['animation' => ['apply_select_on_copy' => true, 'include_tooltip' => true, 'copy_type' => 'text', 'custom_text' => 'Lorem ipsum dolor sit amet', 'content_element' => 'ey'], 'tooltip' => ['arrow' => true, 'inertia' => true, 'animation_type' => 'scale', 'tooltip_placement' => 'auto', 'touch' => true, 'tooltip_copy_state' => 'Copy', 'tooltip_copied_state' => 'Copied!']], 'design' => ['tooltip_styles' => ['touch' => true, 'arrow' => true, 'inertia' => true, 'animation_type' => 'scale', 'tooltip_placement' => 'auto', 'tooltip_copy_state' => 'Copy', 'tooltip_copied_state_' => 'Copied!', 'tooltip_copied_state' => 'Copied!', 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '400']]]]], 'background' => '#1c1c1c', 'arrow_color' => '#1c1c1c', 'padding' => null], 'tooltip' => ['tooltip_copy_state' => 'Copy', 'tooltip_copied_state' => 'Copied'], 'background' => ['color' => ['breakpoint_base' => '#000']], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Icon', 'defaultProperties' => ['content' => ['content' => ['icon' => ['slug' => 'icon-copy.', 'name' => 'icon-copy.', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z"/></svg>', 'iconSetSlug' => 'FontAwesome 6 Free - Regular']]], 'design' => ['icon' => ['color' => '#fff', 'size' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'style' => null]]], 'children' => []]];
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
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
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
        "tooltip_styles",
        "Tooltip styles",
        [c(
        "arrow_color",
        "Arrow color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
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
      "EssentialElements\\typography",
      "Typography",
      "typography",
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
        "animation",
        "Animation",
        [c(
        "copy_type",
        "Copy type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'element', 'text' => 'Element text'], ['text' => 'Custom text', 'value' => 'text']]],
        false,
        false,
        [],
      ), c(
        "content_element",
        "Content element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'className', 'condition' => [[['path' => 'content.animation.copy_type', 'operand' => 'equals', 'value' => 'element']]]],
        false,
        false,
        [],
      ), c(
        "custom_text",
        "Custom text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.copy_type', 'operand' => 'equals', 'value' => 'text']]]],
        false,
        false,
        [],
      ), c(
        "apply_select_on_copy",
        "Apply select on copy",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.copy_type', 'operand' => 'equals', 'value' => 'element']]]],
        false,
        false,
        [],
      ), c(
        "include_tooltip",
        "Include Tooltip",
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
        "tooltip",
        "Tooltip",
        [c(
        "arrow",
        "Arrow",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "inertia",
        "Inertia",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "animation_type",
        "Animation type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'scale', 'text' => 'scale'], ['text' => 'shift-away', 'value' => 'shift-away'], ['text' => 'shift-toward', 'value' => 'shift-toward'], ['text' => 'perspective', 'value' => 'perspective'], ['text' => 'fade', 'value' => 'fade']]],
        false,
        false,
        [],
      ), c(
        "tooltip_placement",
        "Tooltip placement",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'auto', 'text' => 'auto'], ['text' => 'top', 'value' => 'top'], ['text' => 'left', 'value' => 'left'], ['text' => 'bottom', 'value' => 'bottom'], ['text' => 'right', 'value' => 'right']]],
        false,
        false,
        [],
      ), c(
        "touch",
        "Touch",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "tooltip_copy_state",
        "Tooltip copy state",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "tooltip_copied_state",
        "Tooltip copied state",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.animation.include_tooltip', 'operand' => 'is set', 'value' => '']]]],
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
        return ['0' =>  ['title' => 'Dancepad - Click and Copy','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Click_and_Copy/dancepad_click_and_copy.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Dancepad - Popper library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_popper.min.js?ver=' . DANCEPAD_VERSION],],'2' =>  ['title' => 'Dancepad - Tippy library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_tippy.min.js?ver=' . DANCEPAD_VERSION],],'3' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_click_and_copy();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'4' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_click_and_copy();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],'5' =>  ['title' => 'Dancepad - Scale stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_scale.min.css'],],'6' =>  ['title' => 'Dancepad - Shiftaway stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_shiftaway.min.css'],],'7' =>  ['title' => 'Dancepad - Shifttoward stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_shifttoward.min.css'],],'8' =>  ['title' => 'Dancepad - Perspective stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/tippy/dancepad_perspective.min.css'],],];
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

'onPropertyChange' => [['script' => 'dancepad_click_and_copy();',
],],

'onCreatedElement' => [['script' => 'dancepad_click_and_copy();',
],],

'onMountedElement' => [['script' => 'dancepad_click_and_copy();',
],],

'onMovedElement' => [['script' => 'dancepad_click_and_copy();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_click_and_copy();',
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
        return [['name' => 'tabindex', 'template' => '0'], ['name' => 'data-copycontent', 'template' => '{{ content.tooltip.tooltip_copy_state }}'], ['name' => 'data-copiedcontent', 'template' => '{{ content.tooltip.tooltip_copied_state }}'], ['name' => 'data-touch', 'template' => '{% if content.tooltip.touch %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-tippyplacement', 'template' => '{{ content.tooltip.tooltip_placement }}'], ['name' => 'data-tippyanimation', 'template' => '{{ content.tooltip.animation_type }}'], ['name' => 'data-inertia', 'template' => '{% if content.tooltip.inertia %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-arrow', 'template' => '{% if content.tooltip.arrow %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-animation', 'template' => '{% if content.animation.include_tooltip %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-selection', 'template' => '{% if content.animation.apply_select_on_copy %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-type', 'template' => '{{ content.animation.copy_type }}'], ['name' => 'data-textelement', 'template' => '{{ content.animation.content_element }}'], ['name' => 'data-text', 'template' => '{{ content.animation.custom_text }}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'string', 'path' => 'content.tooltip.tooltip_copy_state'], ['accepts' => 'string', 'path' => 'content.tooltip.tooltip_copied_state'], ['accepts' => 'string', 'path' => 'content.animation.custom_text']];
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
