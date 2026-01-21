<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_horizontal_marquee_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\HorizontalMarquee",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class HorizontalMarquee extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.49994 11.9271V12.076C1.49992 14.252 1.4999 15.9867 1.68276 17.3469C1.87158 18.7513 2.27169 19.9051 3.18408 20.8175C4.09647 21.7298 5.25027 22.13 6.65465 22.3188C6.92261 22.3548 7.05658 22.3728 7.17325 22.3297C7.28469 22.2885 7.386 22.1999 7.44167 22.095C7.49994 21.9851 7.49994 21.8423 7.49994 21.5568V2.44641C7.49994 2.16088 7.49994 2.01811 7.44167 1.90823C7.386 1.80327 7.28469 1.71467 7.17325 1.67349C7.05659 1.63038 6.92261 1.64839 6.65465 1.68442C5.25027 1.87323 4.09647 2.27334 3.18408 3.18573C2.27169 4.09812 1.87158 5.25193 1.68276 6.65631C1.4999 8.01644 1.49992 9.75117 1.49994 11.9271ZM17.3452 1.68442C17.0773 1.64839 16.9433 1.63038 16.8266 1.67349C16.7152 1.71467 16.6139 1.80327 16.5582 1.90823C16.4999 2.01811 16.4999 2.16088 16.4999 2.44641V21.5568C16.4999 21.8423 16.4999 21.9851 16.5582 22.095C16.6139 22.1999 16.7152 22.2885 16.8266 22.3297C16.9433 22.3728 17.0773 22.3548 17.3452 22.3188C18.7496 22.13 19.9034 21.7298 20.8158 20.8175C21.7282 19.9051 22.1283 18.7513 22.3171 17.3469C22.5 15.9867 22.5 14.252 22.4999 12.076V11.9272C22.5 9.75118 22.5 8.01645 22.3171 6.65631C22.1283 5.25193 21.7282 4.09812 20.8158 3.18573C19.9034 2.27334 18.7496 1.87323 17.3452 1.68442Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4837 1.50214C10.0219 1.50442 9.79108 1.50557 9.64551 1.65186C9.49994 1.79816 9.49994 2.03069 9.49994 2.49575V21.504C9.49994 21.9691 9.49994 22.2016 9.64551 22.3479C9.79108 22.4942 10.0219 22.4953 10.4837 22.4976C10.9412 22.4999 11.4215 22.4999 11.9255 22.4999H12.0744C12.5784 22.4999 13.0587 22.4999 13.5162 22.4976C13.9779 22.4953 14.2088 22.4942 14.3544 22.3479C14.4999 22.2016 14.4999 21.9691 14.4999 21.504V2.49575C14.4999 2.03069 14.4999 1.79816 14.3544 1.65186C14.2088 1.50557 13.9779 1.50442 13.5162 1.50213C13.0587 1.49987 12.5784 1.49987 12.0744 1.49988L11.9255 1.49988C11.4215 1.49987 10.9412 1.49987 10.4837 1.50214Z" fill="currentColor" />
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
        return 'Horizontal Marquee';
    }

    static function className()
    {
        return 'dan-horizontal-marquee';
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
        return ['design' => ['dimensions' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'gap' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'rotation' => ['rotate' => ['breakpoint_base' => ['number' => 0, 'unit' => 'deg', 'style' => '0deg']]], 'edges' => ['width' => ['number' => 25, 'unit' => '%', 'style' => '25%'], 'blur_width' => ['breakpoint_base' => ['number' => 25, 'unit' => '%', 'style' => '25%']], 'blur_edges' => true, 'blur_color' => '#FFF'], 'margin' => null], 'content' => ['animation' => ['speed' => 3, 'loop' => true, 'pause_on_hover' => true, 'gsap_easing' => 'none', 'reverse' => false], 'scroller' => ['enable_scroller' => true, 'speed' => 1, 'gsap_easing' => 'expo', 'multiplier' => 0.5, 'treshold' => 1]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Marquee']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['advanced' => ['fontStyle' => ['breakpoint_base' => 'italic']]]]]]]], 'children' => []]];
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
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vh']]],
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
      ), c(
        "rotation",
        "Rotation",
        [c(
        "rotate",
        "Rotate",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg', 'custom']]],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "edges",
        "Edges",
        [c(
        "blur_edges",
        "Blur edges",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "blur_width",
        "Blur width",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']], 'condition' => [[['path' => 'design.edges.blur_edges', 'operand' => 'is set', 'value' => '']]]],
        true,
        false,
        [],
      ), c(
        "blur_color",
        "Blur color",
        [],
        ['type' => 'color', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']], 'condition' => [[['path' => 'design.edges.blur_edges', 'operand' => 'is set', 'value' => '']]]],
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
        "animation",
        "Animation",
        [c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
        "reverse",
        "Reverse",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "pause_on_hover",
        "Pause on hover",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "scroller",
        "Scroller",
        [c(
        "enable_scroller",
        "Enable scroller",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "both_directions",
        "Both directions",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.scroller.enable_scroller', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "speed",
        "Speed",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.scroller.enable_scroller', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "multiplier",
        "Multiplier",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.scroller.enable_scroller', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "treshold",
        "Treshold",
        [],
        ['type' => 'number', 'layout' => 'inline', 'condition' => [[['path' => 'content.scroller.enable_scroller', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "gsap_easing",
        "GSAP easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']], 'condition' => [[['path' => 'content.scroller.enable_scroller', 'operand' => 'is set', 'value' => '']]]],
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
        return ['0' =>  ['title' => 'Dancepad - Reeller','scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_reeller.min.js?ver=' . DANCEPAD_VERSION],],
        '1' =>  ['title' => 'Dancepad - Horizontal Marquee','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Horizontal_Marquee/dancepad_horizontal_marquee.min.js?ver=' . DANCEPAD_VERSION],],
        '2' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_horizontal_marquee();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
        '3' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_horizontal_marquee();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
        '4' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],],];
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

'onPropertyChange' => [['script' => 'dancepad_horizontal_marquee();',
],],

'onCreatedElement' => [['script' => 'dancepad_horizontal_marquee();',
],],

'onMountedElement' => [['script' => 'dancepad_horizontal_marquee();',
],],

'onMovedElement' => [['script' => 'dancepad_horizontal_marquee();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_horizontal_marquee();',
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
        return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-blur-edges', 'template' => '{% if design.edges.blur_edges %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-builderedit', 'template' => '{% if content.animation.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-speed-duration', 'template' => '{{ content.animation.speed }}'], ['name' => 'data-defaultloop', 'template' => '{% if content.animation.loop %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-defaultreverse', 'template' => '{% if content.animation.reverse %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-pauseonhover', 'template' => '{% if content.animation.pause_on_hover %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-ease', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-scroller', 'template' => '{% if content.scroller.enable_scroller %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-bothdirection', 'template' => '{% if content.scroller.both_directions %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-scrollerspeed', 'template' => '{{ content.scroller.speed }}'], ['name' => 'data-multiplier', 'template' => '{{ content.scroller.multiplier }}'], ['name' => 'data-threshold', 'template' => '{{ content.scroller.treshold }}'], ['name' => 'data-scrollerease', 'template' => '{{ content.scroller.gsap_easing }}']];
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
