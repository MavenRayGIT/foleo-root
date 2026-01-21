<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_fluids_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Fluids",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Fluids extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M10.9532 2.00004C10.9532 1.44775 11.4009 1.00004 11.9532 1.00004C18.0498 1.00004 23 5.92051 23 12C23 18.0796 18.0498 23 11.9532 23C5.08582 23 1.24036 18.0427 1.01092 13.1787C0.896458 10.7523 1.67961 8.30635 3.4752 6.53076C5.28317 4.74293 8.00969 3.7401 11.572 4.00275C15.4202 4.28647 19.0289 7.86119 19.0289 12C19.0289 14.4648 18.2565 16.384 16.8385 17.6766C15.4364 18.9546 13.5347 19.5 11.4985 19.5C7.44929 19.5 4.97088 16.5644 4.7007 13.6422C4.56523 12.177 4.98208 10.6622 6.09313 9.5521C7.21163 8.43458 8.90429 7.85455 11.0702 8.00236C12.9759 8.13241 15.0161 9.70087 15.0161 12C15.0161 13.1311 14.7166 14.1637 13.9944 14.9157C13.266 15.6741 12.2492 16 11.1211 16C10.5688 16 10.1211 15.5523 10.1211 15C10.1211 14.4478 10.5688 14 11.1211 14C11.8719 14 12.3026 13.7899 12.552 13.5303C12.8075 13.2642 13.0161 12.7968 13.0161 12C13.0161 10.9855 12.0399 10.0732 10.934 9.99772C9.19406 9.87898 8.12102 10.3532 7.50672 10.9669C6.88497 11.5881 6.60193 12.4817 6.69221 13.4581C6.87352 15.4192 8.54917 17.5 11.4985 17.5C13.1986 17.5 14.562 17.0454 15.4911 16.1985C16.4042 15.3661 17.0289 14.0353 17.0289 12C17.0289 8.95918 14.2796 6.2078 11.425 5.99733C8.32474 5.76875 6.20377 6.6453 4.88147 7.95287C3.5468 9.27268 2.91688 11.1381 3.0087 13.0845C3.1918 16.9661 6.23626 21 11.9532 21C16.954 21 21 16.9662 21 12C21 7.03387 16.954 3.00004 11.9532 3.00004C11.4009 3.00004 10.9532 2.55232 10.9532 2.00004Z" fill="currentColor" />
    <path d="M3.47476 6.53043C5.28273 4.7426 8.00925 3.73977 11.5716 4.00241C15.4198 4.28614 19.0284 7.86086 19.0284 11.9997C19.0284 14.4644 18.256 16.3836 16.838 17.6762C15.436 18.9543 13.5342 19.4997 11.498 19.4997C7.44884 19.4997 4.97043 16.564 4.70026 13.6419C4.56479 12.1766 4.98164 10.6618 6.09269 9.55177C7.21119 8.43425 8.90384 7.85422 11.0697 8.00203C12.9755 8.13208 15.0157 9.70054 15.0157 11.9997C15.0157 13.1308 14.7162 14.1634 13.994 14.9153C13.2656 15.6737 12.2488 15.9997 11.1207 15.9997C10.5684 15.9997 10.1207 15.552 10.1207 14.9997C10.1207 14.4474 10.5684 13.9997 11.1207 13.9997C11.8714 13.9997 12.3021 13.7896 12.5515 13.5299C12.8071 13.2638 13.0157 12.7964 13.0157 11.9997C13.0157 10.9852 12.0395 10.0729 10.9336 9.99739C9.19361 9.87865 8.12057 10.3528 7.50628 10.9666C6.88453 11.5878 6.60149 12.4813 6.69176 13.4577C6.87308 15.4188 8.54873 17.4997 11.498 17.4997C13.1981 17.4997 14.5616 17.0451 15.4907 16.1982C16.4038 15.3658 17.0284 14.035 17.0284 12C17.0284 8.95885 14.2791 6.20747 11.4245 5.997C8.32429 5.76842 6.20333 6.64497 4.88103 7.95254L3.4668 6.53831L3.47476 6.53043Z" fill="currentColor" />
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
        return 'Fluids';
    }

    static function className()
    {
        return 'dan-fluids';
    }

    static function category()
    {
        return 'dancepad_backgrounds';
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
        return ['design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'dimensions' => ['height' => ['number' => 600, 'unit' => 'px', 'style' => '600px'], 'width' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'colors' => ['background' => '#000'], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'background' => ['color' => ['breakpoint_base' => '#000']]], 'content' => ['fluids' => ['background' => '#000', 'entrance_animation' => true, 'trigger_on' => 'hover', 'density_diffusion' => 1, 'velocity_diffusion' => 0.2, 'pressure' => 0.8, 'pressure_iterations' => 20], 'bloom' => ['bloom' => true, 'iterations' => 8, 'intensity' => 0.8, 'threshold' => 0.6], 'animation' => ['colorful' => true, 'shading' => true, 'trigger_on' => 'hover', 'entrance_animation' => true, 'splat_force' => 6000, 'splat_radius' => 0.25, 'vorticity' => 30, 'pressure_iterations' => 20, 'pressure' => 0.8, 'velocity_diffusion' => 0.2, 'density_diffusion' => 1], 'sunrays' => ['sunrays' => true, 'weight' => 1]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Fluids', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]]]]]], 'children' => []]];
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
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Background",
      "background",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "animation",
        "Animation",
        [c(
        "trigger_on",
        "Trigger on",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'click'], ['text' => 'hover', 'value' => 'hover']]],
        false,
        false,
        [],
      ), c(
        "entrance_animation",
        "Entrance animation",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "density_diffusion",
        "Density diffusion",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 10, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "velocity_diffusion",
        "Velocity diffusion",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 10, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "pressure",
        "Pressure",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "pressure_iterations",
        "Pressure iterations",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 1, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "vorticity",
        "Vorticity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "splat_radius",
        "Splat radius",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "splat_force",
        "Splat force",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "shading",
        "Shading",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "colorful",
        "Colorful",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "unique_color",
        "Unique Color",
        [],
        ['type' => 'color', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.colorful', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "bloom",
        "Bloom",
        [c(
        "bloom",
        "Bloom",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "iterations",
        "Iterations",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 100, 'step' => 1]],
        false,
        false,
        [],
      ), c(
        "intensity",
        "Intensity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 10, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "threshold",
        "Threshold",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 10, 'step' => 0.1]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "sunrays",
        "Sunrays",
        [c(
        "sunrays",
        "Sunrays",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "weight",
        "Weight",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['step' => 0.1]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "touch",
        "Touch Devices",
        [c(
        "disable_pointer_events",
        "Disable at touch devices",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "disable_entrance_animation_at_touch_devices",
        "Disable Entrance animation at touch devices",
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
        return ['0' =>  ['title' => 'Dancepad - Fluids','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Fluids/dancepad_fluids.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_fluids();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_fluids();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_fluids();',
],],

'onCreatedElement' => [['script' => 'dancepad_fluids();',
],],

'onMountedElement' => [['script' => 'dancepad_fluids();',
],],

'onMovedElement' => [['script' => 'dancepad_fluids();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_fluids();',
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
        return [['name' => 'data-trigger', 'template' => '{{ content.animation.trigger_on }}'], ['name' => 'data-initial-anim', 'template' => '{{ content.animation.entrance_animation }}'], ['name' => 'data-density-diffusion', 'template' => '{{ content.animation.density_diffusion }}'], ['name' => 'data-velocity-diffusion', 'template' => '{{ content.animation.velocity_diffusion }}'], ['name' => 'data-pressure', 'template' => '{{ content.animation.pressure }}'], ['name' => 'data-pressure-iterations', 'template' => '{{ content.animation.pressure_iterations }}'], ['name' => 'data-vorticity', 'template' => '{{ content.animation.vorticity }}'], ['name' => 'data-splat-radius', 'template' => '{{ content.animation.splat_radius }}'], ['name' => 'data-splat-force', 'template' => '{{ content.animation.splat_force }}'], ['name' => 'data-shading', 'template' => '{{ content.animation.shading }}'], ['name' => 'data-colorful', 'template' => '{{ content.animation.colorful }}'], ['name' => 'data-bloom', 'template' => '{{ content.bloom.bloom }}'], ['name' => 'data-bloom-iterations', 'template' => '{{ content.bloom.iterations }}'], ['name' => 'data-bloom-intensity', 'template' => '{{ content.bloom.intensity }}'], ['name' => 'data-bloom-threshold', 'template' => '{{ content.bloom.threshold }}'], ['name' => 'data-sunrays', 'template' => '{{ content.sunrays.sunrays }}'], ['name' => 'data-sunrays-weight', 'template' => '{{ content.sunrays.weight }}'], ['name' => 'data-custom-color', 'template' => '{{ content.animation.unique_color }}'], ['name' => 'data-disable-entrance-touch', 'template' => '{% if content.touch.disable_entrance_animation_at_touch_devices %}
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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
