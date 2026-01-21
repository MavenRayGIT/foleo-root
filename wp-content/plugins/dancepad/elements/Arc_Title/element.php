<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_arc_title_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\ArcTitle",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class ArcTitle extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
                <circle opacity="0.4" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
            return false;
        }
    
        static function name()
        {
            return 'Arc Title';
        }
    
        static function className()
        {
            return 'dan-arc-title';
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
            return ['content' => ['content' => ['text' => 'Arc Title · Dancepad · ', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 6, 'unit' => 's', 'style' => '6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'trigger' => 'this', 'css_easing' => 'linear'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => ['breakpoint_base' => 'gfont-notosansmono'], 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['textTransform' => ['breakpoint_base' => 'uppercase'], 'letterSpacing' => ['breakpoint_base' => null]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'stroke_fill' => ['stroke_color' => '#000', 'stroke_width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'fill_color' => '#000'], 'dimensions' => ['dimensions' => ['number' => 250, 'unit' => 'px', 'style' => '250px']], 'arc_dimensions' => ['dimensions' => ['breakpoint_base' => ['number' => 250, 'unit' => 'px', 'style' => '250px']], 'font_spacing' => 1, 'font_units' => 2, 'letter_spacing' => 1]]];
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
            "arc_dimensions",
            "Arc Dimensions",
            [c(
            "dimensions",
            "Dimensions",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'textOptions' => ['multiline' => false]],
            true,
            false,
            [],
          ), c(
            "letter_spacing",
            "Letter spacing",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
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
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "text",
            "Text",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
            false,
            false,
            [],
          ), c(
            "tag",
            "Tag",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'h1', 'text' => 'H1'], ['text' => 'H2', 'value' => 'h2'], ['text' => 'H3', 'value' => 'h3'], ['text' => 'H4', 'value' => 'h4'], ['text' => 'H5', 'value' => 'h5'], ['text' => 'H6', 'value' => 'h6'], ['text' => 'p', 'value' => 'p'], ['text' => 'span', 'value' => 'span']]],
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
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "css_easing",
            "CSS easing",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
            return ['0' =>  ['title' => 'Dancepad - Arc Title','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Arc_Title/dancepad_arc_title.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_arc_title();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_arc_title();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_arc_title();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_arc_title();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_arc_title();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_arc_title();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_arc_title();',
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
            return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-spacing', 'template' => '{{ design.arc_dimensions.letter_spacing }}'], ['name' => 'data-reverse', 'template' => '{% if content.animation.reverse %}
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance']];
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
