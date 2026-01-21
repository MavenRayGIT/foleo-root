<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_physics_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Physics",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Physics extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M5.8364 4.01748C5.02464 3.93999 4.58201 4.12288 4.35215 4.35274C4.03954 4.66536 3.82523 5.38784 4.18841 6.75478C4.45978 7.77617 5.01708 8.98947 5.84113 10.2917C6.4772 9.5044 7.18284 8.71859 7.95044 7.95098C9.08281 6.81861 10.2548 5.82108 11.4127 4.98282C13.259 3.64626 15.1074 2.68733 16.7305 2.25607C18.2964 1.84002 19.966 1.84429 21.0603 2.93854C22.1545 4.0328 22.1588 5.70242 21.7428 7.26834C21.3572 8.71961 20.5498 10.3509 19.4278 11.9998C20.5497 13.6486 21.3571 15.2799 21.7427 16.7311C22.1587 18.297 22.1544 19.9666 21.0602 21.0609C20.247 21.8741 19.105 22.0811 17.9717 21.9729C16.8318 21.8641 15.5546 21.429 14.2471 20.7664C13.7544 20.5167 13.5575 19.915 13.8071 19.4223C14.0568 18.9297 14.6585 18.7327 15.1511 18.9824C16.3283 19.5789 17.3566 19.9051 18.1618 19.9819C18.9735 20.0594 19.4161 19.8765 19.646 19.6467C19.9586 19.334 20.1729 18.6116 19.8097 17.2447C19.5384 16.2233 18.9811 15.01 18.1571 13.7078C17.521 14.4951 16.8154 15.2809 16.0479 16.0484C14.9155 17.1808 13.7435 18.1784 12.5855 19.0167C10.7393 20.3532 8.89092 21.3121 7.26777 21.7434C5.70187 22.1594 4.03227 22.1551 2.93803 21.0609C1.84379 19.9666 1.83951 18.297 2.25555 16.7311C2.64112 15.2799 3.44851 13.6486 4.57047 11.9998C3.44847 10.3509 2.64106 8.71961 2.25547 7.26834C1.83942 5.70241 1.84368 4.03279 2.93793 2.93853C3.75114 2.12532 4.89315 1.91834 6.02647 2.02654C7.16635 2.13536 8.44358 2.57046 9.75114 3.23308C10.2438 3.48273 10.4408 4.08447 10.1911 4.57711C9.94147 5.06975 9.33972 5.26673 8.84708 5.01708C7.66985 4.42051 6.64158 4.09435 5.8364 4.01748ZM5.84114 13.7078C5.01713 15.01 4.45985 16.2233 4.18849 17.2447C3.82532 18.6116 4.03963 19.3341 4.35224 19.6467C4.66485 19.9593 5.38731 20.1736 6.75422 19.8104C7.77558 19.5391 8.98885 18.9818 10.291 18.1577C9.50376 17.5217 8.71795 16.816 7.95035 16.0484C7.18279 15.2809 6.47719 14.4951 5.84114 13.7078ZM11.9991 16.9583C12.8781 16.2804 13.7662 15.5017 14.6337 14.6342C15.5011 13.7668 16.2798 12.8787 16.9576 11.9998C16.2797 11.1208 15.5011 10.2327 14.6336 9.36518C13.7661 8.49771 12.8781 7.71909 11.9991 7.04123C11.1201 7.71909 10.2321 8.49771 9.36466 9.36519C8.49715 10.2327 7.71851 11.1208 7.04063 11.9998C7.71848 12.8787 8.4971 13.7668 9.36457 14.6342C10.2321 15.5017 11.1201 16.2804 11.9991 16.9583ZM13.7072 5.84173C14.4944 6.47778 15.2802 7.18339 16.0478 7.95097C16.8154 8.71858 17.521 9.50439 18.1571 10.2917C18.9812 8.98947 19.5385 7.77617 19.8098 6.75478C20.173 5.38785 19.9587 4.66537 19.6461 4.35275C19.3335 4.04014 18.611 3.82583 17.2441 4.18901C16.2227 4.46038 15.0094 5.01768 13.7072 5.84173Z" fill="currentColor" />
    <circle cx="12" cy="12" r="2" fill="currentColor" />
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
        return 'Physics';
    }

    static function className()
    {
        return 'dan-physics';
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
        return ['design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 500, 'unit' => 'px', 'style' => '500px']], 'colors' => ['background' => '#171717'], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'background' => ['color' => ['breakpoint_base' => 'red'], 'background' => '#000'], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]], 'content' => ['settings' => ['horizontal_gravity' => 0, 'vertical_gravity' => 1, 'time_scale' => 1, 'mouse_stiffness' => 0.2], 'walls' => ['top' => true, 'bottom' => true, 'left' => true, 'right' => true, 'visible' => false, 'horizontal_gravity' => 10, 'wall_width' => 10, 'width' => 10], 'scrolltrigger' => ['trigger' => 'this', 'start' => 'top bottom'], 'physics_objects' => ['shape' => 'rectangle', 'horizontal_position' => 100, 'vertical_position' => 100, 'width' => 100, 'height' => 50, 'circle_radius' => 100, 'polygon_radius' => 100, 'polygon_sides' => 5, 'rectangle_width' => 100, 'rectangle_height' => 50, 'border_radius' => 10, 'load_image' => false, 'image_scale' => 1, 'stroke_width' => 0, 'restitution' => 0.3, 'friction' => 0.1, 'friction_air' => 0.01, 'density' => 0.001, 'object' => [['shape' => 'circle', 'load_image' => false, 'horizontal_position' => 100, 'vertical_position' => 100, 'rectangle_width' => 100, 'rectangle_height' => 50, 'circle_radius' => 68, 'polygon_radius' => 100, 'polygon_sides' => 5, 'border_radius' => 10, 'image_scale' => 1, 'restitution' => 0.3, 'friction' => 0.1, 'friction_air' => 0.01, 'density' => 0.001, 'stroke_width' => 0, 'fill' => 'lightgrey', 'stroke_color' => null, 'url' => 'https://nextbricks.io/wp-content/uploads/2024/11/nextbreakdance-logo.png', 'horizontal_position_x_' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'vertical_position_y_' => ['number' => 20, 'unit' => '%', 'style' => '20%']], ['shape' => 'circle', 'load_image' => false, 'horizontal_position' => 100, 'vertical_position' => 100, 'rectangle_width' => 100, 'rectangle_height' => 50, 'circle_radius' => 68, 'polygon_radius' => 100, 'polygon_sides' => 5, 'border_radius' => 10, 'image_scale' => 1, 'restitution' => 0.3, 'friction' => 0.1, 'friction_air' => 0.01, 'density' => 0.001, 'stroke_width' => 0, 'fill' => 'lightgrey', 'stroke_color' => null, 'url' => 'https://nextbricks.io/wp-content/uploads/2024/11/nextbreakdance-logo.png', 'horizontal_position_x_' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'vertical_position_y_' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Physics']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF']]]], 'children' => []]];
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
     ), c(
        "background",
        "Background",
        [c(
        "background",
        "Background",
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
      )];
    }

    static function contentControls()
    {
        return [c(
        "physics_objects",
        "Physics Objects",
        [c(
        "object",
        "Object",
        [c(
        "shape",
        "Shape",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'rectangle', 'text' => 'rectangle'], ['text' => 'circle', 'value' => 'circle'], ['text' => 'polygon', 'value' => 'polygon']]],
        false,
        false,
        [],
      ), c(
        "horizontal_position_x_",
        "Horizontal position (x)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%']]],
        false,
        false,
        [],
      ), c(
        "horizontal_position",
        "Horizontal position",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => '', 'operand' => 'equals', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "vertical_position_y_",
        "Vertical position (y)",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%']]],
        false,
        false,
        [],
      ), c(
        "vertical_position",
        "Vertical position",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => '', 'operand' => 'equals', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "rectangle_width",
        "Rectangle width",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "rectangle_height",
        "Rectangle height",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "circle_radius",
        "Circle radius",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "polygon_radius",
        "Polygon radius",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "polygon_sides",
        "Polygon sides",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "border_radius",
        "Border radius",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Image is a texture for the shape. Dimensions or collision borders come from the shape crafted.</p>']],
        false,
        false,
        [],
      ), c(
        "load_image",
        "Load image",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "url",
        "URL",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_scale",
        "Image scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline'],
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
      ), c(
        "stroke_width",
        "Stroke width",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'URL'],
        false,
        false,
        [],
      ), c(
        "link_target",
        "Open in new tab",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "static",
        "Static",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "restitution",
        "Restitution",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "friction",
        "Friction",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "friction_air",
        "Friction Air",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "density",
        "Density",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
        "settings",
        "Settings",
        [c(
        "horizontal_gravity",
        "Horizontal gravity",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "vertical_gravity",
        "Vertical gravity",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "time_scale",
        "Time scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "mouse_stiffness",
        "Mouse stiffness",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "wireframes",
        "Wireframes",
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
        "walls",
        "Walls",
        [c(
        "top",
        "Top",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "right",
        "Right",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "visible",
        "Visible",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "width",
        "Width",
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
        "scrolltrigger",
        "ScrollTrigger",
        [c(
        "trigger",
        "Trigger",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'inline'],
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
        return ['0' =>  ['title' => 'jQuery','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_jquery.min.js?ver=' . DANCEPAD_VERSION],],
        '1' =>  ['title' => 'Dancepad - Physics library','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_matterjs_library.min.js?ver=' . DANCEPAD_VERSION],],
        '2' =>  ['title' => 'Dancepad - Physics','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Physics/dancepad_physics.min.js?ver=' . DANCEPAD_VERSION],],
        '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],],
        '4' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_physics();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
        '5' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_physics();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_physics();',
],],

'onCreatedElement' => [['script' => 'dancepad_physics();',
],],

'onMountedElement' => [['script' => 'dancepad_physics();',
],],

'onMovedElement' => [['script' => 'dancepad_physics();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_physics();',
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
        return [['name' => 'data-gravity-horizontal', 'template' => '{{ content.settings.horizontal_gravity }}'], ['name' => 'data-gravity-vertical', 'template' => '{{ content.settings.vertical_gravity }}'], ['name' => 'data-time-scale', 'template' => '{{ content.settings.time_scale }}'], ['name' => 'data-stiffness', 'template' => '{{ content.settings.mouse_stiffness }}'], ['name' => 'data-wireframes', 'template' => '{% if content.settings.wireframes %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-top-wall', 'template' => '{% if content.walls.top %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-bottom-wall', 'template' => '{% if content.walls.bottom %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-left-wall', 'template' => '{% if content.walls.left %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-right-wall', 'template' => '{% if content.walls.right %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-wall-visible', 'template' => '{% if content.walls.visible %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-wall-width', 'template' => '{{ content.walls.width }}'], ['name' => 'data-trigger', 'template' => '{{ content.scrolltrigger.trigger }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-flickering', 'template' => 'true']];
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
