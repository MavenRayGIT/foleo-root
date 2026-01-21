<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_parallax_hover_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ParallaxHover",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ParallaxHover extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M1.5 11.9256V12.0745C1.49998 14.2505 1.49996 15.9852 1.68282 17.3454C1.87164 18.7498 2.27175 19.9036 3.18414 20.816C4.09653 21.7283 5.25033 22.1285 6.65471 22.3173C7.58626 22.4425 8.69353 22.482 9.99792 22.4944C10.4685 22.4989 10.7037 22.5011 10.8519 22.3544C11 22.2077 11 21.971 11 21.4976V11.0001C11 10.5287 11 10.293 10.8536 10.1465C10.7071 10.0001 10.4714 10.0001 10 10.0001H2.49623C2.02855 10.0001 1.79471 10.0001 1.64832 10.1462C1.50193 10.2923 1.50148 10.5251 1.50058 10.9906C1.49999 11.2928 1.5 11.6044 1.5 11.9256ZM22.4994 10.9906C22.4985 10.5251 22.4981 10.2923 22.3517 10.1462C22.2053 10.0001 21.9715 10.0001 21.5038 10.0001H14C13.5286 10.0001 13.2929 10.0001 13.1464 10.1465C13 10.293 13 10.5287 13 11.0001V21.4976C13 21.971 13 22.2077 13.1481 22.3544C13.2963 22.5011 13.5315 22.4989 14.0021 22.4944C15.3065 22.482 16.4137 22.4425 17.3453 22.3173C18.7497 22.1285 19.9035 21.7283 20.8159 20.816C21.7283 19.9036 22.1284 18.7498 22.3172 17.3454C22.5 15.9852 22.5 14.2505 22.5 12.0745V11.9257C22.5 11.6044 22.5 11.2928 22.4994 10.9906Z" fill="currentColor" />     <path fill-rule="evenodd" clip-rule="evenodd" d="M1.64615 6.94651C1.59242 7.42665 1.56556 7.66673 1.71463 7.83341C1.8637 8.00009 2.11513 8.00009 2.61797 8.00009H21.3804C21.8832 8.00009 22.1346 8.00009 22.2837 7.83341C22.4328 7.66673 22.4059 7.42665 22.3522 6.94651C22.3411 6.84742 22.3292 6.75019 22.3163 6.6548C22.1275 5.25043 21.7274 4.09662 20.815 3.18423C19.9026 2.27184 18.7488 1.87173 17.3444 1.68292C15.9843 1.50005 14.2496 1.50007 12.0736 1.50009L11.9247 1.50009C9.74875 1.50007 8.01401 1.50005 6.65387 1.68292C5.24949 1.87173 4.09569 2.27184 3.1833 3.18423C2.27091 4.09662 1.8708 5.25043 1.68198 6.65481C1.66916 6.75019 1.65724 6.84742 1.64615 6.94651Z" fill="currentColor" /> </svg>';
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
        return 'Parallax Hover';
    }

    static function className()
    {
        return 'dan-parallax-hover';
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
        return ['content' => ['settings' => ['offset' => 50, 'duration' => 300], 'animation' => ['offset' => 50, 'duration' => 300, 'always_active' => false], 'rotate' => ['enable_rotate' => true, 'enable_rotate_touch' => true, 'max_x' => 15, 'max_y' => 15], 'stretch' => ['x_axis' => 0, 'y_axis' => 0, 'z_axis' => 0], 'shadow' => ['enable_shadow' => true, 'highlight' => true, 'offset' => 50, 'scale' => 1]], 'design' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#3DB1F6FF']], 'dimensions' => ['max_width' => ['number' => 467, 'unit' => 'px', 'style' => '467px']], 'size' => ['max_width' => ['breakpoint_base' => ['number' => 467, 'unit' => 'px', 'style' => '467px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']], 'width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'Dancepad\ParallaxHoverItem', 'defaultProperties' => ['content' => ['settings' => ['offset' => 5, 'opacity' => 1]], 'design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'bottom' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'left' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'right' => ['number' => 25, 'unit' => 'px', 'style' => '25px']]]], 'background' => ['color' => null]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Parallax Hover', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#FFF'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]];
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
      "EssentialElements\\background",
      "Background",
      "background",
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
        "animation",
        "Animation",
        [c(
        "always_active",
        "Always active",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "offset",
        "Offset",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
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
      ), c(
        "rotate",
        "Rotate",
        [c(
        "enable_rotate",
        "Enable rotate",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_rotate_touch",
        "Enable rotate touch",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "max_x",
        "Max X",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "max_y",
        "Max Y",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "invert_x",
        "Invert X",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "invert_y",
        "Invert Y",
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
        "stretch",
        "Stretch",
        [c(
        "x_axis",
        "X axis",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "y_axis",
        "Y axis",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "z_axis",
        "Z axis",
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
      ), c(
        "shadow",
        "Shadow",
        [c(
        "enable_shadow",
        "Enable shadow",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "offset",
        "Offset",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
      ), c(
        "highlight",
        "Highlight",
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
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return ['0' =>  ['title' => 'Dancepad - Atropos Stylesheet','styles' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_atropos.min.css'],],'1' =>  ['title' => 'Dancepad - Atropos Library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_atropos.min.js?ver=' . DANCEPAD_VERSION],],'2' =>  ['title' => 'Dancepad - Next Parallax Hover','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Parallax_Hover/dancepad_parallax_hover.min.js?ver=' . DANCEPAD_VERSION],],'3' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_parallax_hover();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'4' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_parallax_hover();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_parallax_hover();',
],],

'onCreatedElement' => [['script' => 'dancepad_parallax_hover();',
],],

'onMountedElement' => [['script' => 'dancepad_parallax_hover();',
],],

'onMovedElement' => [['script' => 'dancepad_parallax_hover();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_parallax_hover();',
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
        return [['name' => 'data-offset', 'template' => '{{ content.animation.offset }}'], ['name' => 'data-always-active', 'template' => '{% if content.animation.always_active %}1{% else %}0{% endif %}'], ['name' => 'data-duration', 'template' => '{{ content.animation.duration }}'], ['name' => 'data-rotate', 'template' => '{% if content.rotate.enable_rotate %}1{% else %}0{% endif %}'], ['name' => 'data-rotatetouch', 'template' => '{% if content.rotate.enable_rotate_touch %}1{% else %}0{% endif %}'], ['name' => 'data-rotate-x-max', 'template' => '{{ content.rotate.max_x }}'], ['name' => 'data-rotate-y-max', 'template' => '{{ content.rotate.max_y }}'], ['name' => 'data-rotate-x-invert', 'template' => '{% if content.rotate.invert_x %}1{% else %}0{% endif %}'], ['name' => 'data-rotate-y-invert', 'template' => '{% if content.rotate.invert_y %}1{% else %}0{% endif %}'], ['name' => 'data-stretch-x', 'template' => '{{ content.stretch.x_axis }}'], ['name' => 'data-stretch-y', 'template' => '{{ content.stretch.y_axis }}'], ['name' => 'data-stretch-z', 'template' => '{{ content.stretch.z_axis }}'], ['name' => 'data-shadow', 'template' => '{% if content.shadow.enable_shadow %}1{% else %}0{% endif %}'], ['name' => 'data-shadow-offset', 'template' => '{{ content.shadow.offset }}'], ['name' => 'data-shadow-scale', 'template' => '{{ content.shadow.scale }}'], ['name' => 'data-highlight', 'template' => '{% if content.shadow.highlight %}1{% else %}0{% endif %}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
    }

    static function additionalClasses()
    {
        return [['name' => 'atropos', 'template' => 'yes']];
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
