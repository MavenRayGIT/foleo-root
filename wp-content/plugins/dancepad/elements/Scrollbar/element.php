<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_scrollbar_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Scrollbar",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Scrollbar extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M21.7474 3.33565C22.1143 3.74843 22.0771 4.3805 21.6644 4.74742L3.66436 20.7474C3.25158 21.1143 2.6195 21.0772 2.25259 20.6644C1.88567 20.2516 1.92285 19.6195 2.33563 19.2526L20.3356 3.2526C20.7484 2.88568 21.3805 2.92286 21.7474 3.33565Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7474 11.3356C13.1143 11.7484 13.0771 12.3805 12.6644 12.7474L3.66436 20.7474C3.25158 21.1143 2.6195 21.0772 2.25259 20.6644C1.88567 20.2516 1.92285 19.6195 2.33563 19.2526L11.3356 11.2526C11.7484 10.8857 12.3805 10.9229 12.7474 11.3356Z" fill="currentColor" />
</svg>';
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
        return 'Scrollbar';
    }

    static function className()
    {
        return 'dan-scrollbar';
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
        return ['content' => ['settings' => ['target' => 'body', 'overflowy' => 'scroll', 'overflowx' => 'hidden', 'visibility' => 'auto', 'autohide' => 'never', 'autohide_delay' => 500]], 'design' => ['thumb' => ['border_radius' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'color' => 'rgba(0,0,0,0.44)', 'hover_color' => 'rgba(0,0,0,0.55)', 'active_color' => 'rgba(0,0,0,0.66)'], 'track' => ['size' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'horizontal_padding' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'border_radius' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'vertical_padding' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#00000', 'hover_color' => '#00000', 'active_color' => '#00000']]];
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
        return [c(
        "thumb",
        "Thumb",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hover_color",
        "Hover color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "active_color",
        "Active color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
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
        "track",
        "Track",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "horizontal_padding",
        "Horizontal padding",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "vertical_padding",
        "Vertical padding",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
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
      ), c(
        "hover_color",
        "Hover color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "active_color",
        "Active color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
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
      )];
    }

    static function contentControls()
    {
        return [c(
        "settings",
        "Settings",
        [c(
        "target",
        "Target",
        [],
        ['type' => 'text', 'layout' => 'inline', 'textOptions' => ['format' => 'plain']],
        false,
        false,
        [],
      ), c(
        "overflowy",
        "OverflowY",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'scroll', 'text' => 'scroll'], ['text' => 'hidden', 'value' => 'hidden']]],
        false,
        false,
        [],
      ), c(
        "overflowx",
        "OverflowX",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'scroll', 'text' => 'scroll'], ['text' => 'hidden', 'value' => 'hidden']]],
        false,
        false,
        [],
      ), c(
        "visibility",
        "Visibility",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'auto', 'text' => 'auto'], ['text' => 'hidden', 'value' => 'hidden']]],
        false,
        false,
        [],
      ), c(
        "autohide",
        "Autohide",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'never', 'text' => 'never'], ['text' => 'scroll', 'value' => 'scroll'], ['text' => 'leave', 'value' => 'leave'], ['text' => 'move', 'value' => 'move']]],
        false,
        false,
        [],
      ), c(
        "autohide_delay",
        "Autohide delay",
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
            '0' =>  [
                'title' => 'Dancepad - OverlayScrollbars stylesheet',
                'styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_overlayscrollbars.min.css'],
            ],
            '1' =>  [
                'title' => 'Dancepad - OverlayScrollbars library', 
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_overlayscrollbars.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '2' =>  [
                'title' => 'Dancepad - Scrollbar',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Scrollbar/dancepad_scrollbar.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '3' =>  [
                'title' => 'Init Builder',
                'inlineScripts' => [
                    'dancepad_scrollbar();'
                ],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '4' =>  [
                'title' => 'Init Front',
                'inlineScripts' => [
                    'dancepad_scrollbar();'
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

'onPropertyChange' => [['script' => 'dancepad_scrollbar();',
],],

'onCreatedElement' => [['script' => 'dancepad_scrollbar();',
],],

'onMountedElement' => [['script' => 'dancepad_scrollbar();',
],],

'onMovedElement' => [['script' => 'dancepad_scrollbar();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_scrollbar();',
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
        return [['name' => 'data-target', 'template' => '{{ content.settings.target }}'], ['name' => 'data-tracksize', 'template' => '{{ design.track.size.style }}'], ['name' => 'data-thumbborderradius', 'template' => '{{ design.thumb.border_radius.style }}'], ['name' => 'data-trackborderradius', 'template' => '{{ design.track.border_radius.style }}'], ['name' => 'data-trackmargintopbottom', 'template' => '{{ design.track.vertical_padding.style }}'], ['name' => 'data-trackmarginright', 'template' => '{{ design.track.horizontal_padding.style }}'], ['name' => 'data-overflowy', 'template' => '{{ content.settings.overflowy }}'], ['name' => 'data-overflowx', 'template' => '{{ content.settings.overflowx }}'], ['name' => 'data-visibility', 'template' => '{{ content.settings.visibility }}'], ['name' => 'data-autohide', 'template' => '{{ content.settings.autohide }}'], ['name' => 'data-autohidedelay', 'template' => '{{ content.settings.autohide_delay }}']];
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
