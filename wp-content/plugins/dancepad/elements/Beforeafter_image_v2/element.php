<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_beforeafter_image_v2_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\BeforeafterImageV2",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class BeforeafterImageV2 extends \Breakdance\Elements\Element
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
        return ['section', 'footer', 'header', 'nav', 'aside', 'article', 'main'];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Before/After Image V2';
    }

    static function className()
    {
        return 'dan-before-after-image-v2';
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
        return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'block_style' => ['size' => ['width' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'cursor' => 'col-resize'], 'slider' => ['percentage' => 25, 'mode' => 'drag', 'color' => '#e3e3e3', 'width' => ['number' => 1, 'unit' => 'px', 'style' => '1px']], 'hnadlebar' => ['width' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'handlebar' => ['width' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'height' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'topRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomLeft' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'bottomRight' => ['number' => 6, 'unit' => 'px', 'style' => '6px'], 'editMode' => 'all']], 'shadow' => ['breakpoint_base' => ['shadows' => [['color' => '#FFFFFF40', 'x' => '0', 'y' => '-1', 'blur' => '0', 'spread' => '0', 'position' => 'outset']], 'style' => '0px -1px 0px 0px #FFFFFF40']]], 'color' => '#ffffff', 'dots_color' => '#000000', 'dots_size' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'glow' => ['outer_width' => ['number' => 144, 'unit' => 'px', 'style' => '144px'], 'outer_opacity' => 0.5, 'outer_color' => 'rgba(169, 169, 169, 0.5)', 'inner_color' => 'rgb(126, 127, 127)', 'inner_width' => ['number' => 40, 'unit' => 'px', 'style' => '40px']], 'particles_container' => ['width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'mask_color' => '#fff'], 'particles' => ['color' => '#fff', 'duration' => ['number' => 4, 'unit' => 's', 'style' => '4s'], 'css_easing' => 'ease-in-out']]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Before Container'], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__first-image-container']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/14-2-scaled.jpg']], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__first-image']]], 'meta' => ['friendlyName' => 'Before Image']], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Before Content'], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__first-image-content']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Before']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 24, 'unit' => 'px', 'style' => '24px']]]]]]]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'After Container'], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__second-image-container']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/13-scaled.jpg']], 'meta' => ['friendlyName' => 'After Image'], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__second-image']]]], 'children' => []], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'After Content'], 'settings' => ['advanced' => ['classes' => ['dan-before-after-image-v2__second-image-content']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'After']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 24, 'unit' => 'px', 'style' => '24px']]]]]]]], 'children' => []]]]]]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "block_style",
        "Block style",
        [getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), c(
        "cursor",
        "Cursor",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "slider",
        "Slider",
        [c(
        "mode",
        "Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'hover'], ['text' => 'drag', 'value' => 'drag']]],
        false,
        false,
        [],
      ), c(
        "percentage",
        "Percentage",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
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
      ), c(
        "color",
        "Color",
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
        "handlebar",
        "Handlebar",
        [c(
        "width",
        "Width",
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
      ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "dots_color",
        "Dots color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "dots_size",
        "Dots size",
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
        "glow",
        "Glow",
        [c(
        "outer_width",
        "Outer width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "outer_color",
        "Outer color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "outer_opacity",
        "Outer opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "inner_width",
        "Inner width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "inner_color",
        "Inner color",
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
        "particles_container",
        "Particles Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "mask_color",
        "Mask color",
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
        "particles",
        "Particles",
        [c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
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
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "css_easing",
        "CSS Easing",
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

    static function contentControls()
    {
        return [];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return [
            '0' => [
                'title' => 'Dancepad - Before After Image V2',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Beforeafter_image_v2/dancepad_beforeafter_image_v2.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_beforeafter_image_v2();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_beforeafter_image_v2();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
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

'onPropertyChange' => [['script' => 'dancepad_beforeafter_image_v2();',
],],

'onCreatedElement' => [['script' => 'dancepad_beforeafter_image_v2();',
],],

'onMountedElement' => [['script' => 'dancepad_beforeafter_image_v2();',
],],

'onMovedElement' => [['script' => 'dancepad_beforeafter_image_v2();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_beforeafter_image_v2();',
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
        return [['name' => 'data-disable-builder', 'template' => '{% if design.particles.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-slider-mode', 'template' => '{{ design.slider.mode }}'], ['name' => 'data-slider-percentage', 'template' => '{{ design.slider.percentage }}'], ['name' => 'data-flickering', 'template' => '1']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image']];
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