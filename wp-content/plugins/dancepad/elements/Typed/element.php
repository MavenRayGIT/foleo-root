<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_typed_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Typed",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Typed extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M4.22354 15.8978C4.60504 16 5.07003 16 6 16H12H18C18.93 16 19.395 16 19.7765 15.8978C20.8117 15.6204 21.6204 14.8117 21.8978 13.7765C22 13.395 22 12.93 22 12C22 11.07 22 10.605 21.8978 10.2235C21.6204 9.18827 20.8117 8.37962 19.7765 8.10222C19.395 8 18.93 8 18 8H12H6C5.07003 8 4.60504 8 4.22354 8.10222C3.18827 8.37962 2.37962 9.18827 2.10222 10.2235C2 10.605 2 11.07 2 12C2 12.93 2 13.395 2.10222 13.7765C2.37962 14.8117 3.18827 15.6204 4.22354 15.8978Z" fill="currentColor" />
    <path d="M6 16C5.07003 16 4.60504 16 4.22354 15.8978C3.18827 15.6204 2.37962 14.8117 2.10222 13.7765C2 13.395 2 12.93 2 12C2 11.07 2 10.605 2.10222 10.2235C2.37962 9.18827 3.18827 8.37962 4.22354 8.10222C4.60504 8 5.07003 8 6 8M12 16H18C18.93 16 19.395 16 19.7765 15.8978C20.8117 15.6204 21.6204 14.8117 21.8978 13.7765C22 13.395 22 12.93 22 12C22 11.07 22 10.605 21.8978 10.2235C21.6204 9.18827 20.8117 8.37962 19.7765 8.10222C19.395 8 18.93 8 18 8H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
    <path d="M7 3H9M11 3H9M9 3V21M9 21H7M9 21H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>';
    }

    static function tag()
    {
        return 'span';
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
        return 'Typed';
    }

    static function className()
    {
        return 'dan-typed';
    }

    static function category()
    {
        return 'dancepad_texts';
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
        return ['content' => ['content' => ['text' => 'Typed', 'tag' => 'span', 'link' => null, 'prefix' => 'My', 'sufix' => null, 'suffix' => 'Sentence', 'sentences' => [['text' => 'First'], ['text' => 'Second'], ['text' => 'Third']]], 'animation' => ['duration' => 20, 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'type_speed' => 100, 'back_speed' => 40, 'start_delay' => 0, 'back_delay' => 2000, 'fade' => false, 'fade_delay' => 500, 'cursor' => true, 'cursor_char' => '|', 'loop_count' => 'Infinity', 'loop' => true, 'shuffle' => false, 'cursor_color' => '#D85A15FF'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]];
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
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Typography",
      "typography",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "tag",
        "Tag",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'h1', 'text' => 'H1'], ['text' => 'H2', 'value' => 'h2'], ['text' => 'H3', 'value' => 'h3'], ['text' => 'H4', 'value' => 'h4'], ['text' => 'H5', 'value' => 'h5'], ['text' => 'H6', 'value' => 'h6'], ['text' => 'p', 'value' => 'p'], ['text' => 'span', 'value' => 'span']]],
        false,
        false,
        [],
      ), c(
        "sentences",
        "Sentences",
        [c(
        "text",
        "Text",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true]],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical', 'repeaterOptions' => ['titleTemplate' => '{text}', 'defaultTitle' => 'List Item', 'buttonName' => '']],
        false,
        false,
        [],
      ), c(
        "prefix",
        "Prefix",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
        false,
        false,
        [],
      ), c(
        "suffix",
        "Suffix",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
        false,
        false,
        [],
      ), c(
        "link",
        "Link",
        [],
        ['type' => 'link', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "animation",
        "Animation",
        [c(
        "type_speed",
        "Type speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "back_speed",
        "Back speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "start_delay",
        "Start delay",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "back_delay",
        "Back delay",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "shuffle",
        "Shuffle",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "loop",
        "Loop",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "loop_count",
        "Loop count",
        [],
        ['type' => 'text', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.loop', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "cursor",
        "Cursor",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "cursor_char",
        "Cursor char",
        [],
        ['type' => 'text', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.cursor', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "cursor_color",
        "Cursor color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.cursor', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "fade",
        "Fade",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "fade_delay",
        "Fade delay",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.animation.fade', 'operand' => 'is set', 'value' => '']]]],
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
        return ['0' =>  ['title' => 'Dancepad - Typed','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Typed/dancepad_typed.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_typed();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_typed();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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

'onPropertyChange' => [['script' => 'dancepad_typed();',
],],

'onCreatedElement' => [['script' => 'dancepad_typed();',
],],

'onMountedElement' => [['script' => 'dancepad_typed();',
],],

'onMovedElement' => [['script' => 'dancepad_typed();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_typed();',
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
        return [['name' => 'data-type-speed', 'template' => '{{ content.animation.type_speed ?? "" }}'], ['name' => 'data-back-speed', 'template' => '{{ content.animation.back_speed ?? "" }}'], ['name' => 'data-start-delay', 'template' => '{{ content.animation.start_delay ?? "" }}'], ['name' => 'data-back-delay', 'template' => '{{ content.animation.back_delay ?? "" }}'], ['name' => 'data-shuffle', 'template' => '{{ content.animation.shuffle ? "true" : "false" }}'], ['name' => 'data-loop', 'template' => '{{ content.animation.loop ? "true" : "false" }}'], ['name' => 'data-loop-count', 'template' => '{{ content.animation.loop_count ?? "" }}'], ['name' => 'data-show-cursor', 'template' => '{{ content.animation.cursor ? "true" : "false" }}'], ['name' => 'data-cursor-char', 'template' => '{{ content.animation.cursor_char ?? "" }}'], ['name' => 'data-fade', 'template' => '{{ content.animation.fade ? "true" : "false" }}'], ['name' => 'data-fade-delay', 'template' => '{{ content.animation.fade_delay ?? "" }}']];
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
        return [['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'string', 'path' => 'content.content.prefix'], ['accepts' => 'string', 'path' => 'content.content.suffix'], ['accepts' => 'string', 'path' => 'content.content.sentences[].text']];
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
