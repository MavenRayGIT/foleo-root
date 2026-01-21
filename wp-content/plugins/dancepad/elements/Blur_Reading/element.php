<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_blur_reading_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\BlurReading",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class BlurReading extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path fill-rule="evenodd" clip-rule="evenodd" d="M5.16348 13L2.94396 19.3308C2.76124 19.852 2.19061 20.1264 1.66943 19.9437C1.14824 19.761 0.873867 19.1903 1.05659 18.6692L3.97554 10.3433C4.62537 8.48967 5.14504 7.00734 5.64428 5.99476C5.89751 5.48115 6.18262 5.00853 6.53308 4.65511C6.90398 4.28108 7.39226 4 8.00027 4C8.60828 4 9.09656 4.28108 9.46746 4.65511C9.81792 5.00853 10.103 5.48115 10.3563 5.99476C10.8555 7.00733 11.3752 8.48964 12.025 10.3432L14.944 18.6692C15.1267 19.1903 14.8523 19.761 14.3311 19.9437C13.8099 20.1264 13.2393 19.852 13.0566 19.3308L10.8371 13H5.16348ZM5.86466 11C6.53157 9.09794 7.00524 7.75712 7.4381 6.87919C7.6572 6.43482 7.82869 6.18895 7.95322 6.06338C7.9721 6.04434 7.98772 6.03012 8.00027 6.01961C8.01283 6.03012 8.02845 6.04434 8.04733 6.06338C8.17186 6.18895 8.34335 6.43482 8.56245 6.87919C8.9953 7.75712 9.46898 9.09794 10.1359 11H5.86466ZM8.04062 5.99194C8.04057 5.99226 8.03812 5.99369 8.03344 5.99525C8.03834 5.9924 8.04068 5.99162 8.04062 5.99194ZM7.96711 5.99525C7.96243 5.99369 7.95998 5.99226 7.95992 5.99194C7.95987 5.99162 7.96221 5.9924 7.96711 5.99525Z" fill="currentColor" />     <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M18.9243 9.00002C18.9492 9.00003 18.9744 9.00004 19 9.00004C19.0256 9.00004 19.0508 9.00003 19.0757 9.00002C19.4657 8.99985 19.7734 8.99971 20.0475 9.04313C21.5451 9.28033 22.7197 10.4549 22.9569 11.9525C23.0003 12.2267 23.0002 12.5343 23 12.9243C23 12.9492 23 12.9745 23 13V13.9991L23 15.5715L23 15.5735V18.5C23 19.0523 22.5523 19.5 22 19.5C21.6832 19.5 21.4008 19.3527 21.2176 19.1229C20.4793 19.6739 19.5635 20 18.5714 20C16.6759 20 15 18.5149 15 16.5C15 14.567 16.567 13 18.5 13H21C21 12.4973 20.9969 12.3624 20.9815 12.2654C20.8799 11.6236 20.3765 11.1202 19.7347 11.0185C19.6376 11.0031 19.5027 11 19 11C18.4973 11 18.3624 11.0031 18.2653 11.0185C17.7519 11.0998 17.3265 11.4384 17.1251 11.9C16.9042 12.4062 16.3148 12.6375 15.8086 12.4166C15.3024 12.1957 15.0711 11.6063 15.292 11.1001C15.7615 10.0241 16.753 9.23311 17.9525 9.04313C18.2266 8.99971 18.5343 8.99985 18.9243 9.00002ZM21 15H18.5C17.6716 15 17 15.6716 17 16.5C17 17.3224 17.6904 18 18.5714 18C19.9122 18 20.9992 16.9136 21 15.573L21 15.5715L21 15Z" fill="currentColor" /> </svg>';
        }
    
        static function tag()
        {
            return 'p';
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
            return 'Blur Reading';
        }
    
        static function className()
        {
            return 'dan-blur-reading';
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
            return ['content' => ['content' => ['text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec leo et mi mollis dictum. Vivamus bibendum est vel elit eleifend sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec leo et mi mollis dictum. Vivamus bibendum est vel elit eleifend sodales.', 'tag' => 'p', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'words', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'type' => 'v2', 'blur' => ['number' => 10, 'unit' => 'px', 'style' => '10px']], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top center', 'end' => 'bottom center', 'toggleactions' => 'play none none none', 'scroller' => 'body']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 500, 'unit' => 'px', 'style' => '500px'], 'bottom' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]]]];
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
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "animation",
            "Animation",
            [c(
            "type",
            "Type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'v1', 'text' => 'v1'], ['text' => 'v2', 'value' => 'v2'], ['text' => 'v3', 'value' => 'v3'], ['text' => 'v4', 'value' => 'v4']]],
            false,
            false,
            [],
          ), c(
            "blur",
            "Blur",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px']]],
            false,
            false,
            [],
          ), c(
            "split_type",
            "Split type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'chars', 'text' => 'chars'], ['text' => 'words', 'value' => 'words'], ['text' => 'lines', 'value' => 'lines']]],
            false,
            false,
            [],
          ), c(
            "stagger",
            "Stagger",
            [],
            ['type' => 'number', 'layout' => 'inline'],
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
            "scrolltrigger",
            "ScrollTrigger",
            [c(
            "start",
            "Start",
            [],
            ['type' => 'text', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "end",
            "End",
            [],
            ['type' => 'text', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "scroller",
            "Scroller",
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
            return ['0' =>  ['title' => 'Dancepad - Blur Reading','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Blur_Reading/dancepad_blur_reading.min.js?ver=' . DANCEPAD_VERSION],],
            '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_blur_reading();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_blur_reading();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
            '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%','%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],]];
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
    
    'onPropertyChange' => [['script' => 'dancepad_blur_reading();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_blur_reading();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_blur_reading();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_blur_reading();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_blur_reading();',
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
            return [['name' => 'data-split', 'template' => '{{ content.animation.split_type|default("chars") }}'], ['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-stagger', 'template' => '{{ content.animation.stagger|default(0) }}'], ['name' => 'data-easing', 'template' => '{{ content.animation.gsap_easing|default("none") }}'], ['name' => 'data-scroller', 'template' => '{{ content.scrolltrigger.scroller|default("") }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start|default("") }}'], ['name' => 'data-end', 'template' => '{{ content.scrolltrigger.end|default("") }}'], ['name' => 'data-blur', 'template' => '{{ content.animation.blur.number|default(0) }}'], ['name' => 'data-content', 'template' => '{{ content.content.text }}']];
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
            return [['name' => 'dan-blur-reading--v1', 'template' => '{% if content.animation.type == \'v1\' %}
        yes
        {% endif %}'], ['name' => 'dan-blur-reading--v2', 'template' => '{% if content.animation.type == \'v2\' %}
        yes
        {% endif %}'], ['name' => 'dan-blur-reading--v3', 'template' => '{% if content.animation.type == \'v3\' %}
        yes
        {% endif %}'], ['name' => 'dan-blur-reading--v4', 'template' => '{% if content.animation.type == \'v4\' %}
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

