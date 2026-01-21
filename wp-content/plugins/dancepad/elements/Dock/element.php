<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_dock_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Dock",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Dock extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.95192 21.7502H14.0488C15.6473 21.7502 16.9138 21.7502 17.9231 21.6305C18.9614 21.5074 19.8145 21.2497 20.5456 20.6738C21.0466 20.2791 21.4782 19.7922 21.8233 19.2377C22.3183 18.4424 22.5388 17.5218 22.6454 16.3839C22.6484 16.3518 22.6513 16.3195 22.6541 16.2869C22.6955 15.812 22.7162 15.5745 22.5676 15.4123C22.419 15.2502 22.1718 15.2502 21.6774 15.2502H2.32341C1.82901 15.2502 1.58181 15.2502 1.43319 15.4123C1.28456 15.5745 1.30525 15.812 1.34662 16.2869C1.34946 16.3195 1.35238 16.3518 1.35538 16.3839C1.462 17.5218 1.68244 18.4424 2.17746 19.2377C2.52258 19.7922 2.95413 20.2791 3.45519 20.6738C4.18625 21.2497 5.03935 21.5074 6.07765 21.6305C7.08692 21.7502 8.35342 21.7502 9.95192 21.7502ZM6 19.2502C5.58579 19.2502 5.25 18.9144 5.25 18.5002C5.25 18.086 5.58579 17.7502 6 17.7502H7C7.41421 17.7502 7.75 18.086 7.75 18.5002C7.75 18.9144 7.41421 19.2502 7 19.2502H6ZM10 19.2502C9.58579 19.2502 9.25 18.9144 9.25 18.5002C9.25 18.086 9.58579 17.7502 10 17.7502H11C11.4142 17.7502 11.75 18.086 11.75 18.5002C11.75 18.9144 11.4142 19.2502 11 19.2502H10Z" fill="currentColor" />
    <path opacity="0.4" d="M2.24634 13.7504H21.7537C22.222 13.7504 22.4561 13.7504 22.6025 13.6041C22.7489 13.4579 22.7492 13.2247 22.7497 12.7582C22.75 12.5265 22.75 12.2877 22.75 12.0415V11.961C22.75 10.1498 22.75 8.73745 22.645 7.6167C22.5384 6.47876 22.3179 5.55818 21.8229 4.76285C21.4778 4.20835 21.0463 3.72147 20.5452 3.32677C19.8141 2.75089 18.961 2.49317 17.9227 2.37005C16.9135 2.25037 15.6469 2.25038 14.0485 2.25039H9.95145C8.35299 2.25038 7.08652 2.25037 6.07727 2.37005C5.03896 2.49317 4.18587 2.75089 3.4548 3.32677C2.95374 3.72147 2.5222 4.20835 2.17708 4.76285C1.68205 5.55818 1.46162 6.47876 1.355 7.6167C1.24999 8.73744 1.24999 10.1498 1.25 11.9609V12.0414C1.25 12.2876 1.25 12.5264 1.25026 12.7582C1.2508 13.2247 1.25106 13.4579 1.39747 13.6041C1.54389 13.7504 1.77804 13.7504 2.24634 13.7504Z" fill="currentColor" />
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
        return 'Dock';
    }

    static function className()
    {
        return 'dan-dock-menu';
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
        return ['design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'align_items' => ['breakpoint_base' => 'flex-end'], 'justify_content' => ['breakpoint_base' => 'center']], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px']]]], 'dimensions' => ['gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'width' => ['number' => 'fit-content', 'unit' => 'custom', 'style' => 'fit-content'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.1)', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.1)', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.1)', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.1)', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all']]], 'items_style' => ['dimensions' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'background' => ['color' => null], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'editMode' => 'all']]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']]], 'tooltip_style' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px']]]], 'top' => ['number' => -28, 'unit' => 'px', 'style' => '-28px'], 'background' => ['color' => ['breakpoint_base' => '#282828']], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.04)', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.04)', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.04)', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => 'rgba(255, 255, 255, 0.04)', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'editMode' => 'all']]], 'typography' => ['color' => ['breakpoint_base' => '#e0e0e0'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]]], 'background' => ['color' => ['breakpoint_base' => '#000']]], 'content' => ['animation' => ['scale' => 2, 'activation_distance' => 120]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Dock item'], 'settings' => ['advanced' => ['classes' => ['dan-dock-menu__item'], 'attributes' => [['name' => 'data-vel-view', 'value' => 'item'], ['name' => 'data-tooltip', 'value' => 'Github']]]], 'design' => ['layout_v2' => null, 'background' => ['color' => '#2E7FDAFF']]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Dock item'], 'settings' => ['advanced' => ['classes' => ['dan-dock-menu__item'], 'attributes' => [['name' => 'data-vel-view', 'value' => 'item'], ['name' => 'data-tooltip', 'value' => 'Twitter']]]], 'design' => ['background' => ['color' => '#333333', 'color_hover' => null]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Dock item'], 'settings' => ['advanced' => ['classes' => ['dan-dock-menu__item'], 'attributes' => [['name' => 'data-vel-view', 'value' => 'item'], ['name' => 'data-tooltip', 'value' => 'Behance']]]], 'design' => ['background' => ['color' => '#DA6B2EFF']]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Dock item'], 'settings' => ['advanced' => ['classes' => ['dan-dock-menu__item'], 'attributes' => [['name' => 'data-vel-view', 'value' => 'item'], ['name' => 'data-tooltip', 'value' => 'Dribble']]]], 'design' => ['background' => ['color' => '#DA2ED0FF']]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Dock item'], 'settings' => ['advanced' => ['classes' => ['dan-dock-menu__item'], 'attributes' => [['name' => 'data-vel-view', 'value' => 'item'], ['name' => 'data-tooltip', 'value' => 'Whatsapp']]]], 'design' => ['background' => ['color' => '#35DA2EFF']]], 'children' => []]];
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
     ), c(
        "dimensions",
        "Dimensions",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
        true,
        false,
        [],
      ), c(
        "max_width",
        "max Width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
        true,
        false,
        [],
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']]],
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
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "items_style",
        "Items style",
        [getPresetSection(
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
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
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "tooltip_style",
        "Tooltip style",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Tooltip content can be edited at the Settings tab of each item, at the Attributes section: data-tooltip</p>']],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
        true,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
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
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "activation_distance",
        "Activation distance",
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
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return [
          '0' =>  ['title' => 'Dancepad - Dock','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Dock/dancepad_dock.min.js?ver=' . DANCEPAD_VERSION],],
        '1' =>  ['title' => 'Dancepad - Veloxi library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_veloxi.min.js?ver=' . DANCEPAD_VERSION],],
        '2' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_dock();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
        '3' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_dock();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_dock();',
],],

'onCreatedElement' => [['script' => 'dancepad_dock();',
],],

'onMountedElement' => [['script' => 'dancepad_dock();',
],],

'onMovedElement' => [['script' => 'dancepad_dock();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_dock();',
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
        return [['name' => 'data-scale', 'template' => '{{ content.animation.scale }}'], ['name' => 'data-activation-distance', 'template' => '{{ content.animation.activation_distance }}'], ['name' => 'data-vel-view', 'template' => 'root'], ['name' => 'data-vel-plugin', 'template' => 'NextBricksDock'], ['name' => 'data-base-size', 'template' => '{{ design.items_style.dimensions.style }}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image']];
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

