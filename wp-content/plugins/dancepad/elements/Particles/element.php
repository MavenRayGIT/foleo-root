<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_particles_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Particles",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Particles extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M2.03214 16.9059C2.1633 17.734 2.84751 18.4182 4.21593 19.7866C5.58435 21.1551 6.26856 21.8393 7.09669 21.9704C7.36414 22.0128 7.6366 22.0128 7.90405 21.9704C8.73218 21.8393 9.41639 21.1551 10.7848 19.7866C12.1533 18.4182 12.8375 17.734 12.9686 16.9059C13.011 16.6384 13.011 16.366 12.9686 16.0985C12.916 15.7661 12.7742 15.4568 12.5348 15.1172L8.88539 11.4678C8.54575 11.2284 8.2365 11.0866 7.90405 11.034C7.6366 10.9916 7.36414 10.9916 7.09669 11.034C6.26856 11.1651 5.58435 11.8493 4.21593 13.2178C2.84751 14.5862 2.1633 15.2704 2.03214 16.0985C1.98978 16.366 1.98978 16.6384 2.03214 16.9059Z" fill="currentColor" />
    <path d="M9.54333 14.4582L14.4564 9.54514" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
    <path d="M12.5689 15.1086C13.3086 16.249 13.1112 17.418 12.2567 18.2725L9.26145 21.2678C8.28305 22.2462 6.69674 22.2462 5.71834 21.2678L2.73221 18.2816C1.75381 17.3032 1.75381 15.7169 2.73221 14.7385L5.72742 11.7433C6.42936 11.0413 7.76348 10.636 8.90994 11.4662M15.1087 12.5688C16.2491 13.3085 17.4181 13.1111 18.2726 12.2566L21.2678 9.26136C22.2462 8.28295 22.2462 6.69664 21.2678 5.71823L18.2817 2.73208C17.3033 1.75367 15.717 1.75367 14.7386 2.73208L11.7434 5.72731C11.0414 6.42925 10.6361 7.76338 11.4663 8.90984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
        return 'Particles';
    }

    static function className()
    {
        return 'dan-particles';
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
        return ['content' => ['particles' => ['number' => 120, 'density_value_area' => 800, 'enable_density' => true], 'shape' => ['polygons' => false, 'polygons_sides' => 5, 'image' => false, 'image_width' => 50, 'image_height' => 50, 'circles' => true, 'edges' => false, 'triangles' => false, 'stars' => false, 'url' => 'https://nextbricks.io/wp-content/uploads/2024/11/dancepad-logo.png'], 'particle_style' => ['color' => '#FFF', 'stroke_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'stroke_color' => '#111'], 'opacity' => ['value' => 0.5, 'speed' => 1, 'random' => true, 'enable_animation' => true, 'minimum_opacity' => 0.1, 'sync' => false], 'size' => ['size' => 4, 'random' => true, 'speed' => 40, 'enable_animation' => false, 'minimum_opacity' => 0.1], 'line_linked' => ['distance' => 150, 'enable_line_linked' => false, 'color' => '#FFF', 'opacity' => 0.4, 'width' => 1], 'move' => ['enable_move' => true, 'speed' => 3, 'move_direction' => 'none', 'move_out' => 'out', 'rotate_x' => 600, 'enable_attract' => false, 'rotate_y' => 1200, 'random' => false, 'straight' => false, 'bounce' => false], 'interactivity' => ['resize' => true, 'enable_hover' => true, 'hover_animation' => 'bubble', 'detect_on' => 'canvas', 'enable_click' => true, 'hover_click' => 'push', 'grab_distance' => 400, 'grab_line_linked' => 1, 'bubble_distance' => 400, 'bubble_size' => 4, 'bubble_duration' => 3, 'bubble_opacity' => 1, 'bubble_speed' => 3, 'repulse_distance' => 200, 'repulse_duration' => 0.4, 'push_number' => 4, 'remove_number' => 2, 'click_animation' => 'push']], 'design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 500, 'unit' => 'px', 'style' => '500px']], 'colors' => ['background' => '#111'], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'background' => ['color' => ['breakpoint_base' => '#111']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Particles']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF']]]], 'children' => []]];
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
        "particles",
        "Particles",
        [c(
        "number",
        "Number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_density",
        "Enable density",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "density_value_area",
        "Density value area",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.particles.enable_density', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "particle_style",
        "Particle style",
        [c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stroke_width",
        "Stroke width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
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
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "shape",
        "Shape",
        [c(
        "circles",
        "Circles",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "edges",
        "Edges",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "triangles",
        "Triangles",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "stars",
        "Stars",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "polygons",
        "Polygons",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "polygons_sides",
        "Polygons sides",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.shape.polygons', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "image",
        "Image",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "url",
        "URL",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.shape.image', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "image_width",
        "Image width",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.shape.image', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "image_height",
        "Image height",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.shape.image', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "opacity",
        "Opacity",
        [c(
        "value",
        "Value",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "random",
        "Random",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_animation",
        "Enable animation",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.opacity.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "minimum_opacity",
        "Minimum opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.opacity.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "sync",
        "Sync",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.opacity.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "random",
        "Random",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_animation",
        "Enable animation",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.size.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "minimum_opacity",
        "Minimum opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.size.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "sync",
        "Sync",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.size.enable_animation', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "line_linked",
        "Line linked",
        [c(
        "enable_line_linked",
        "Enable line linked",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "distance",
        "Distance",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.line_linked.enable_line_linked', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => [[['path' => 'content.line_linked.enable_line_linked', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.line_linked.enable_line_linked', 'operand' => 'is set', 'value' => '']]], 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.line_linked.enable_line_linked', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "move",
        "Move",
        [c(
        "enable_move",
        "Enable move",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "move_direction",
        "Move direction",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]], 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'top', 'value' => 'top'], ['text' => 'top-right', 'value' => 'top-right'], ['text' => 'right', 'value' => 'right'], ['text' => 'bottom-right', 'value' => 'bottom-right'], ['text' => 'bottom', 'value' => 'bottom'], ['text' => 'bottom-left', 'value' => 'bottom-left'], ['text' => 'left', 'value' => 'left'], ['text' => 'top-left', 'value' => 'top-left']]],
        false,
        false,
        [],
      ), c(
        "random",
        "Random",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "straight",
        "Straight",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "move_out",
        "Move out",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]], 'items' => [['value' => 'out', 'text' => 'out'], ['text' => 'bounce', 'value' => 'bounce']]],
        false,
        false,
        [],
      ), c(
        "bounce",
        "Bounce",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_attract",
        "Enable attract",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rotate_x",
        "Rotate X",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => ''], ['path' => 'content.move.enable_attract', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rotate_y",
        "Rotate Y",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.move.enable_move', 'operand' => 'is set', 'value' => ''], ['path' => 'content.move.enable_attract', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "interactivity",
        "Interactivity",
        [c(
        "detect_on",
        "Detect on",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'canvas', 'text' => 'canvas'], ['text' => 'window', 'value' => 'window']]],
        false,
        false,
        [],
      ), c(
        "resize",
        "Resize",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_hover",
        "Enable hover",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hover_animation",
        "Hover animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'repulse', 'text' => 'repulse'], ['text' => 'grab', 'value' => 'grab'], ['text' => 'bubble', 'value' => 'bubble']], 'condition' => [[['path' => 'content.interactivity.enable_hover', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_click",
        "Enable click",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "click_animation",
        "Click animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'repulse', 'text' => 'repulse'], ['text' => 'remove', 'value' => 'remove'], ['text' => 'bubble', 'value' => 'bubble'], ['text' => 'push', 'value' => 'push']], 'condition' => [[['path' => 'content.interactivity.enable_click', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Hover and click animations can be edited at the following controls:</p>']],
        false,
        false,
        [],
      ), c(
        "grab_distance",
        "Grab distance",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "grab_line_linked",
        "Grab line linked",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bubble_distance",
        "Bubble distance",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bubble_size",
        "Bubble size",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bubble_duration",
        "Bubble duration",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bubble_opacity",
        "Bubble opacity",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bubble_speed",
        "Bubble speed",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "repulse_distance",
        "Repulse distance",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "repulse_duration",
        "Repulse duration",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "push_number",
        "Push number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "remove_number",
        "Remove number",
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
        return ['0' =>  ['title' => 'Dancepad - Particles library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_particles_library.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Dancepad - Particles','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Particles/dancepad_particles.min.js?ver=' . DANCEPAD_VERSION],],'2' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_particles();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'3' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_particles();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_particles();',
],],

'onCreatedElement' => [['script' => 'dancepad_particles();',
],],

'onMountedElement' => [['script' => 'dancepad_particles();',
],],

'onMovedElement' => [['script' => 'dancepad_particles();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_particles();',
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
        return [['name' => 'data-number', 'template' => '{{ content.particles.number }}'], ['name' => 'data-number-enable-density', 'template' => '{{ content.particles.enable_density }}'], ['name' => 'data-number-density-value-area', 'template' => '{{ content.particles.density_value_area }}'], ['name' => 'data-shape-type', 'template' => '{% set shapeType = [] %}

{% if content.shape.circles %}
    {% set shapeType = shapeType|merge([\'circle\']) %}
{% endif %}

{% if content.shape.edges %}
    {% set shapeType = shapeType|merge([\'edge\']) %}
{% endif %}

{% if content.shape.triangles %}
    {% set shapeType = shapeType|merge([\'triangle\']) %}
{% endif %}

{% if content.shape.polygons %}
    {% set shapeType = shapeType|merge([\'polygon\']) %}
{% endif %}

{% if content.shape.stars %}
    {% set shapeType = shapeType|merge([\'star\']) %}
{% endif %}

{% if content.shape.image %}
    {% set shapeType = shapeType|merge([\'image\']) %}
{% endif %}

{{ shapeType|join(\' \')|json_encode()|raw }}'], ['name' => 'data-shape-stroke-width', 'template' => '{{ content.particle_style.stroke_width.style }}'], ['name' => 'data-shape-polygon-sides', 'template' => '{{ content.shape.polygons_sides }}'], ['name' => 'data-image-url', 'template' => '{{ content.shape.url }}'], ['name' => 'data-image-width', 'template' => '{{ content.shape.image_width }}'], ['name' => 'data-image-height', 'template' => '{{ content.shape.image_height }}'], ['name' => 'data-opacity-value', 'template' => '{{ content.opacity.value }}'], ['name' => 'data-opacity-random', 'template' => '{% if content.opacity.random %}1{% else %}0{% endif %}'], ['name' => 'data-opacity-enable-animation', 'template' => '{% if content.opacity.enable_animation %}1{% else %}0{% endif %}'], ['name' => 'data-opacity-speed', 'template' => '{{ content.opacity.speed }}'], ['name' => 'data-opacity-minimum-opacity', 'template' => '{{ content.opacity.minimum_opacity }}'], ['name' => 'data-opacity-sync', 'template' => '{% if content.opacity.sync %}1{% else %}0{% endif %}'], ['name' => 'data-size-value', 'template' => '{{ content.size.size }}'], ['name' => 'data-size-random', 'template' => '{% if content.size.random %}1{% else %}0{% endif %}'], ['name' => 'data-size-enable-animation', 'template' => '{% if content.size.enable_animation %}1{% else %}0{% endif %}'], ['name' => 'data-size-speed', 'template' => '{{ content.size.speed }}'], ['name' => 'data-size-minimum-opacity', 'template' => '{{ content.size.minimum_opacity }}'], ['name' => 'data-size-sync', 'template' => '{% if content.size.sync %}1{% else %}0{% endif %}'], ['name' => 'data-line-linked-width', 'template' => '{{ content.line_linked.width }}'], ['name' => 'data-line-linked-opacity', 'template' => '{{ content.line_linked.opacity }}'], ['name' => 'data-line-linked-distance', 'template' => '{{ content.line_linked.distance }}'], ['name' => 'data-line-linked-enable-animation', 'template' => '{% if content.line_linked.enable_line_linked %}1{% else %}0{% endif %}'], ['name' => 'data-move-enable', 'template' => '{% if content.move.enable_move %}1{% else %}0{% endif %}'], ['name' => 'data-move-speed', 'template' => '{{ content.move.speed }}'], ['name' => 'data-move-direction', 'template' => '{{ content.move.move_direction }}'], ['name' => 'data-move-random', 'template' => '{% if content.move.random %}1{% else %}0{% endif %}'], ['name' => 'data-move-straight', 'template' => '{% if content.move.straight %}1{% else %}0{% endif %}'], ['name' => 'data-move-bounce', 'template' => '{% if content.move.bounce %}1{% else %}0{% endif %}'], ['name' => 'data-move-enable-attract', 'template' => '{% if content.move.enable_attract %}1{% else %}0{% endif %}'], ['name' => 'data-move-out-mode', 'template' => '{{ content.move.move_out }}'], ['name' => 'data-move-rotate-x', 'template' => '{{ content.move.rotate_x }}'], ['name' => 'data-move-rotate-y', 'template' => '{{ content.move.rotate_y }}'], ['name' => 'data-detect-on', 'template' => '{{ content.interactivity.detect_on }}'], ['name' => 'data-interactivity-hoverMode', 'template' => '{{ content.interactivity.hover_animation }}'], ['name' => 'data-interactivity-clickMode', 'template' => '{{ content.interactivity.click_animation }}'], ['name' => 'data-grab-distance', 'template' => '{{ content.interactivity.grab_distance }}'], ['name' => 'data-grab-line-linked', 'template' => '{{ content.interactivity.grab_line_linked }}'], ['name' => 'data-bubble-distance', 'template' => '{{ content.interactivity.bubble_distance }}'], ['name' => 'data-bubble-size', 'template' => '{{ content.interactivity.bubble_size }}'], ['name' => 'data-bubble-duration', 'template' => '{{ content.interactivity.bubble_duration }}'], ['name' => 'data-bubble-opacity', 'template' => '{{ content.interactivity.bubble_opacity }}'], ['name' => 'data-bubble-speed', 'template' => '{{ content.interactivity.bubble_speed }}'], ['name' => 'data-repulse-distance', 'template' => '{{ content.interactivity.repulse_distance }}'], ['name' => 'data-repulse-duration', 'template' => '{{ content.interactivity.repulse_duration }}'], ['name' => 'data-push-number', 'template' => '{{ content.interactivity.push_number }}'], ['name' => 'data-remove-number', 'template' => '{{ content.interactivity.remove_number }}'], ['name' => 'data-interactivity-resize', 'template' => '{% if content.interactivity.resize %}1{% else %}0{% endif %}'], ['name' => 'data-interactivity-enableHover', 'template' => '{% if content.interactivity.enable_hover %}1{% else %}0{% endif %}'], ['name' => 'data-interactivity-enableClick', 'template' => '{% if content.interactivity.enable_click %}1{% else %}0{% endif %}']];
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
