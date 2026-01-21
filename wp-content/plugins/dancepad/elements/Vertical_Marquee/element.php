<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_vertical_marquee_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\VerticalMarquee",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class VerticalMarquee extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path d="M22.5 7.5V5.5C22.5 3.29086 20.7091 1.5 18.5 1.5L5.5 1.5C3.29086 1.5 1.5 3.29086 1.5 5.5L1.5 7.5L22.5 7.5Z" fill="currentColor" />
            <path d="M1.5 9.5L1.5 14.5L22.5 14.4996V9.5L1.5 9.5Z" fill="currentColor" />
            <path d="M1.5 18.5L1.5 16.5L22.5 16.4996V18.5C22.5 20.7091 20.7091 22.5 18.5 22.5H5.5C3.29086 22.5 1.5 20.7091 1.5 18.5Z" fill="currentColor" />
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
            return 'Vertical Marquee';
        }
    
        static function className()
        {
            return 'dan-vertical-marquee';
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
            return ['design' => ['dimensions' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'gap' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'edges' => ['blur_edges' => true, 'blur_width' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'blur_height' => ['breakpoint_base' => ['number' => 50, 'unit' => '%', 'style' => '50%']]]], 'content' => ['animation' => ['duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'gsap_easing' => 'none', 'pause_on_hover' => true]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Great Heading #1']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000']]]], 'children' => []], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Great Heading #2']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000']]]], 'children' => []], ['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Great Heading #3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000']]]], 'children' => []]];
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
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Height must be equal or lower than the height of all children combined.</p>']],
            false,
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
            "blur_height",
            "Blur height",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', '%', 'vw']], 'condition' => [[['path' => 'design.edges.blur_edges', 'operand' => 'is set', 'value' => '']]]],
            true,
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
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
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
          )];
        }
    
        static function settingsControls()
        {
            return [];
        }
    
        static function dependencies()
        {
            return [
                '0' =>  [
                    'title' => 'Dancepad - Vertical Marquee',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Vertical_Marquee/dancepad_vertical_marquee.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' =>  [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_vertical_marquee();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' =>  [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_vertical_marquee();'],
                    'builderCondition' => 'return false;',
                    'frontendCondition' => 'return true;',
                ],
                '3' =>  [
                    'title' => 'GSAP',
                    'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
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
    
    'onPropertyChange' => [['script' => 'dancepad_vertical_marquee();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_vertical_marquee();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_vertical_marquee();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_vertical_marquee();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_vertical_marquee();',
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
            return [['name' => 'data-disable-builder', 'template' => '{% if content.animation.disable_at_the_builder %}
        1
        {% else %}
        0
        {% endif %}'], ['name' => 'data-reverse', 'template' => '{% if content.animation.reverse %}
        1
        {% else %}
        0
        {% endif %}'], ['name' => 'data-pauseonhover', 'template' => '{% if content.animation.pause_on_hover %}
        1
        {% else %}
        0
        {% endif %}'], ['name' => 'data-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-easing', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-blur-edges', 'template' => '{% if design.edges.blur_edges %}
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
