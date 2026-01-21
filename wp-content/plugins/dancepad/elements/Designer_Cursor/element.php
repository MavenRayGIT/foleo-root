<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_designer_cursor_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\DesignerCursor",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class DesignerCursor extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path fill-rule="evenodd" clip-rule="evenodd" d="M9.15238 3.18754C5.85805 3.18754 3.18747 5.85813 3.18747 9.15246C3.18747 11.8345 4.95831 14.1055 7.39685 14.8551C7.90824 15.0123 8.19536 15.5544 8.03815 16.0657C7.88093 16.5771 7.33892 16.8643 6.82752 16.7071C3.59878 15.7145 1.25 12.709 1.25 9.15246C1.25 4.78809 4.78802 1.25008 9.15238 1.25008C12.7089 1.25008 15.7144 3.59886 16.707 6.8276C16.8642 7.33899 16.5771 7.88101 16.0657 8.03823C15.5543 8.19544 15.0123 7.90832 14.855 7.39692C14.1054 4.95839 11.8344 3.18754 9.15238 3.18754Z" fill="currentColor" />     <path fill-rule="evenodd" clip-rule="evenodd" d="M8.50083 7.08332C7.72137 7.08332 7.0833 7.71869 7.0833 8.51011C7.0833 8.81112 7.17489 9.08759 7.33113 9.31648C7.61655 9.7346 7.50897 10.3049 7.09085 10.5904C6.67272 10.8758 6.10239 10.7682 5.81697 10.3501C5.45916 9.82589 5.25 9.191 5.25 8.51011C5.25 6.71303 6.70203 5.25002 8.50083 5.25002C9.19031 5.25002 9.83192 5.46629 10.3585 5.8345C10.7734 6.1246 10.8746 6.69611 10.5845 7.111C10.2944 7.52589 9.72289 7.62706 9.30799 7.33696C9.07897 7.17683 8.802 7.08332 8.50083 7.08332Z" fill="currentColor" />     <path d="M22.4713 12.3884C22.5984 12.5548 22.7521 12.8161 22.75 13.145C22.7449 13.9293 22.2098 14.461 21.7032 14.7924C21.182 15.1333 20.5147 15.3837 19.8703 15.5759C19.2158 15.7711 18.53 15.9216 17.9464 16.0426C17.5407 16.1253 16.8195 16.2728 16.6145 16.3303C16.2747 16.4256 16.2181 16.4843 16.2064 16.4969C16.1912 16.5134 16.1333 16.5838 16.0537 16.9461L16.0497 16.9642C15.676 18.6635 15.3813 20.004 15.0655 20.919C14.9076 21.3764 14.7229 21.7948 14.4781 22.1126C14.2191 22.4488 13.8464 22.7268 13.3427 22.749C13.0066 22.7639 12.7387 22.6105 12.573 22.4874C12.3957 22.3558 12.2359 22.1846 12.0945 22.008C11.8097 21.6522 11.5168 21.1685 11.2306 20.6215C10.6541 19.5198 10.0468 18.0492 9.53408 16.5407C9.02168 15.0331 8.5925 13.4547 8.38504 12.1364C8.28169 11.4797 8.22867 10.8591 8.25804 10.3312C8.2853 9.84139 8.39015 9.26612 8.75985 8.86799C9.14131 8.45719 9.71815 8.3213 10.211 8.27379C10.7394 8.22286 11.3621 8.25732 12.0199 8.3436C13.3408 8.51685 14.9282 8.91643 16.4468 9.40525C17.9668 9.89452 19.4527 10.4845 20.5704 11.0526C21.1255 11.3347 21.6173 11.6253 21.981 11.9102C22.1618 12.0519 22.3361 12.2115 22.4713 12.3884Z" fill="currentColor" /> </svg>';
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
        return 'Designer Cursor';
    }

    static function className()
    {
        return 'dan-designer-cursor';
    }

    static function category()
    {
        return 'dancepad_cursors';
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
        return ['content' => ['content' => ['name' => 'Tony', 'enable_floating' => true, 'attached_to_cursor' => false, 'target' => ''], 'floating_animation' => ['direction' => 'horizontal', 'duration' => ['number' => 2, 'unit' => 's', 'style' => '2s'], 'css_easing' => 'ease-in-out'], 'display_animation' => ['scale' => 0.5, 'duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'css_easing' => 'ease']], 'design' => ['spacing' => ['zindex' => '9999', 'top' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'left' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'pointer_icon' => ['color' => '#0284c7', 'rotate' => ['number' => -70, 'unit' => 'deg', 'style' => '-70deg'], 'dimensions' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'stroke_color' => '#0284c7', 'stroke_width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'fill' => '#0ea5e9'], 'pointer_name' => ['top' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'left' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'background' => '#0ea5e9', 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all']]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottom' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '400'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1.7', 'unit' => 'custom', 'style' => '1.7']]]]]]]]]];
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
        "spacing",
        "Spacing",
        [c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "pointer_icon",
        "Pointer Icon",
        [c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      ), c(
        "rotate",
        "Rotate",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg', 'custom']]],
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
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
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
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "pointer_name",
        "Pointer Name",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
        false,
        [],
      ), c(
        "left",
        "Left",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'custom']]],
        true,
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
        "content",
        "Content",
        [c(
        "target",
        "Target",
        [],
        ['type' => 'text', 'layout' => 'inline', 'placeholder' => '.className'],
        false,
        false,
        [],
      ), c(
        "name",
        "Name",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "attached_to_cursor",
        "Attached to cursor",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_floating",
        "Enable floating",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.content.attached_to_cursor', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "floating_animation",
        "Floating Animation",
        [c(
        "direction",
        "Direction",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'horizontal', 'text' => 'horizontal'], ['text' => 'vertical', 'value' => 'vertical']]],
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
        "CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.enable_floating', 'operand' => 'is set', 'value' => ''], ['path' => 'content.content.attached_to_cursor', 'operand' => 'is not set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "display_animation",
        "Display Animation",
        [c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
        "CSS easing",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.content.attached_to_cursor', 'operand' => 'is set', 'value' => '']]]],
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
        return ['0' =>  ['title' => 'Dancepad - Designer Cursor','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Designer_Cursor/dancepad_designer_cursor.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_designer_cursor();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_designer_cursor();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_designer_cursor();',
],],

'onCreatedElement' => [['script' => 'dancepad_designer_cursor();',
],],

'onMountedElement' => [['script' => 'dancepad_designer_cursor();',
],],

'onMovedElement' => [['script' => 'dancepad_designer_cursor();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_designer_cursor();',
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
        return [
            ['name' => 'data-target', 'template' => '{{ content.content.target }}'],
            ['name' => 'data-type', 'template' => '{{ content.content.attached_to_cursor }}'],
            ['name' => 'data-direction', 'template' => '{{ content.floating_animation.direction }}'],
            ['name' => 'data-flickering', 'template' => '1']
        ];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'string', 'path' => 'content.content.name']];
    }

    static function additionalClasses()
    {
        return [['name' => 'dan-designer-cursor--animation-enabled', 'template' => '
      {% if (content.content.attached_to_cursor == "") %}
      {% if content.content.enable_floating %}
yes
{% endif %}
      {% endif %}
      '], ['name' => 'dan-designer-cursor--attached', 'template' => '{% if content.content.attached_to_cursor %}
yes
{% endif %}'], ['name' => 'dan-designer-cursor--relative', 'template' => '{% if content.content.attached_to_cursor %}
{% else %}
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

