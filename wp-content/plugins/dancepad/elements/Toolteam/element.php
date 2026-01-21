<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_toolteam_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Toolteam",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Toolteam extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
                <path opacity="0.4" d="M6.09881 19C4.7987 18.8721 3.82475 18.4816 3.17157 17.8284C2 16.6569 2 14.7712 2 11V10.5C2 6.72876 2 4.84315 3.17157 3.67157C4.34315 2.5 6.22876 2.5 10 2.5H14C17.7712 2.5 19.6569 2.5 20.8284 3.67157C22 4.84315 22 6.72876 22 10.5V11C22 14.7712 22 16.6569 20.8284 17.8284C19.6569 19 17.7712 19 14 19C13.4395 19.0125 12.9931 19.0551 12.5546 19.155C11.3562 19.4309 10.2465 20.0441 9.14987 20.5789C7.58729 21.3408 6.806 21.7218 6.31569 21.3651C5.37769 20.6665 6.29454 18.5019 6.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <path d="M14 2.5H10C6.22876 2.5 4.34315 2.5 3.17157 3.67157C2 4.84315 2 6.72876 2 10.5V11C2 14.7712 2 16.6569 3.17157 17.8284C3.82475 18.4816 4.7987 18.8721 6.09881 19M14 19C13.4395 19.0125 12.9931 19.0551 12.5546 19.155C11.3562 19.4309 10.2465 20.0441 9.14987 20.5789C7.58729 21.3408 6.806 21.7218 6.31569 21.3651C5.37769 20.6665 6.29454 18.5019 6.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
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
        return 'Toolteam';
    }

    static function className()
    {
        return 'dan-toolteam';
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
        return ['content' => ['team_members' => ['members' => [['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://i.pravatar.cc/150?img=13', 'alt' => '', 'caption' => ''], 'name' => 'Alex Chen', 'role' => 'Software Engineer', 'image_alt_text' => 'Alex Chen']]], 'tooltip_animation' => ['scale_from' => 0.7, 'scale_duration' => ['number' => 0.1, 'unit' => 's', 'style' => '0.1s'], 'scale_css_easing' => 'ease', 'fade_duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'fade_css_easing' => 'ease-in-out']], 'design' => ['name_role' => ['name_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '700']]]]], 'role_typography' => ['color' => ['breakpoint_base' => '#999'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]]], 'arrow' => ['bottom_offset' => ['number' => -4, 'unit' => 'px', 'style' => '-4px'], 'dimensions' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'color' => '#333333'], 'tooltip' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#333333']], 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]]], 'gap' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'top' => ['number' => -64, 'unit' => 'px', 'style' => '-64px'], 'padding' => ['top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]], 'avatar' => ['borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#333333', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#333333', 'style' => 'solid'], 'left' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#333333', 'style' => 'solid'], 'right' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#333333', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'editMode' => 'all']]], 'dimensions' => ['number' => 56, 'unit' => 'px', 'style' => '56px']], 'gap' => ['horizontal_gap' => ['number' => -12, 'unit' => 'px', 'style' => '-12px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 'fit-content', 'unit' => 'custom', 'style' => 'fit-content']]]]];
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
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), c(
        "gap",
        "Gap",
        [c(
        "horizontal_gap",
        "Horizontal Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
      ), c(
        "vertical_gap",
        "Vertical Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "avatar",
        "Avatar",
        [c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
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
        "tooltip",
        "Tooltip",
        [c(
        "padding",
        "Padding",
        [],
        ['type' => 'spacing_complex', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        false,
        false,
        [],
      ), c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
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
      ), c(
        "arrow",
        "Arrow",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
        false,
        false,
        [],
      ), c(
        "bottom_offset",
        "Bottom Offset",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "name_role",
        "Name & Role",
        [getPresetSection(
      "EssentialElements\\typography",
      "Name Typography",
      "name_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Role Typography",
      "role_typography",
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
        "team_members",
        "Team Members",
        [c(
        "members",
        "Members",
        [c(
        "name",
        "Name",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "role",
        "Role",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "tooltip_animation",
        "Tooltip Animation",
        [c(
        "fade_duration",
        "Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "fade_css_easing",
        "Fade CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "scale_from",
        "Scale from",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "scale_duration",
        "Scale Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "scale_css_easing",
        "Scale CSS easing",
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
        return [
          '0' =>  ['title' => 'Dancepad - Toolteam','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Toolteam/dancepad_toolteam.min.js?ver=' . DANCEPAD_VERSION],],
          '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_toolteam();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
          '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_toolteam();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_toolteam();',
],],

'onCreatedElement' => [['script' => 'dancepad_toolteam();',
],],

'onMountedElement' => [['script' => 'dancepad_toolteam();',
],],

'onMovedElement' => [['script' => 'dancepad_toolteam();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_toolteam();',
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
        return [['accepts' => 'image_url', 'path' => 'design.tooltip.background.layers[].image']];
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
