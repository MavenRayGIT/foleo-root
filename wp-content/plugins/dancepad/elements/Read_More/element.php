<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_read_more_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\ReadMore",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class ReadMore extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M2 3C2 2.44772 2.44772 2 3 2H21C21.5523 2 22 2.44772 22 3C22 3.55228 21.5523 4 21 4H3C2.44772 4 2 3.55228 2 3Z" fill="currentColor" />
        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M2 15C2 14.4477 2.44772 14 3 14H9C9.55228 14 10 14.4477 10 15C10 15.5523 9.55228 16 9 16H3C2.44772 16 2 15.5523 2 15Z" fill="currentColor" />
        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M2 21C2 20.4477 2.44772 20 3 20H9C9.55228 20 10 20.4477 10 21C10 21.5523 9.55228 22 9 22H3C2.44772 22 2 21.5523 2 21Z" fill="currentColor" />
        <path d="M2 9C2 8.44772 2.44772 8 3 8H16.5C19.5376 8 22 10.4624 22 13.5C22 16.5376 19.5376 19 16.5 19L16 19.0006V21.0012C15.9997 21.252 15.9057 21.5029 15.7171 21.697C15.3321 22.093 14.699 22.102 14.303 21.7171C14.1982 21.6152 13.913 21.3877 13.5855 21.1304L13.5854 21.1303C13.295 20.9024 12.9528 20.6338 12.626 20.3569C12.276 20.0603 11.909 19.7255 11.6221 19.3887C11.4783 19.2199 11.3344 19.0272 11.2223 18.8178C11.1145 18.6164 11 18.3327 11 18C11 17.6673 11.1145 17.3836 11.2223 17.1822C11.3344 16.9728 11.4783 16.7801 11.6221 16.6113C11.909 16.2745 12.276 15.9397 12.626 15.6431C12.9528 15.3662 13.2951 15.0975 13.5855 14.8696C13.913 14.6124 14.1982 14.3848 14.303 14.2829C14.699 13.898 15.3321 13.907 15.7171 14.303C15.9063 14.4977 16.0003 14.7496 16 15.0011V17H16.5C18.433 17 20 15.433 20 13.5C20 11.567 18.433 10 16.5 10H3C2.44772 10 2 9.55228 2 9Z" fill="currentColor" />
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
            return 'Read More';
        }
    
        static function className()
        {
            return 'dan-read-more';
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
            return ['design' => ['size' => ['max_width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']]], 'background' => ['color' => ['breakpoint_base' => '#fff']]], 'content' => ['content' => ['default_height_to_show' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'fade_color' => '#fff', 'fade_height' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'read_more_button' => ['read_less_text' => 'Show Less', 'hover_color' => '#000', 'hover_color_css_easing' => 'ease-in-out', 'hover_color_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s']], 'read_more_animation' => ['in_gsap_easing' => 'back', 'out_gsap_easing' => 'back', 'in_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'out_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s']]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-read-more__container'], 'wrapper' => null]], 'meta' => ['friendlyName' => 'Content'], 'design' => ['spacing' => ['margin_bottom' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Read more.', 'tags' => 'h3']]], 'children' => []], ['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consectetur dicta, eos libero non perspiciatis quia recusandae repellat tempore ullam unde vero! Culpa debitis dolorem laudantium possimus reprehenderit temporibus voluptatem?']]], 'children' => []]]], ['slug' => 'EssentialElements\TextLink', 'defaultProperties' => ['content' => ['content' => ['link' => ['type' => 'url', 'url' => 'https://breakdance.com/'], 'text' => 'Show More']], 'settings' => ['advanced' => ['classes' => ['dan-read-more__btn']]], 'meta' => ['friendlyName' => 'Read More Button'], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#1087f0'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 13, 'unit' => 'px', 'style' => '13px']], 'fontWeight' => ['breakpoint_base' => '500']]]], 'text_align' => ['breakpoint_base' => 'left']]]], 'children' => []]];
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
          "EssentialElements\\size",
          "Size",
          "size",
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
            "content",
            "Content",
            [c(
            "default_height_to_show",
            "Default height to show",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "fade_height",
            "Fade height",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "fade_color",
            "Fade color",
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
            "read_more_button",
            "Read More Button",
            [c(
            "read_less_text",
            "Read less text",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "hover_color",
            "Hover color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "hover_color_duration",
            "Hover color duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "hover_color_css_easing",
            "Hover color CSS easing",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "read_more_animation",
            "Read More Animation",
            [c(
            "in_duration",
            "In duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "out_duration",
            "Out duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "in_gsap_easing",
            "In GSAP easing",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
            false,
            false,
            [],
          ), c(
            "out_gsap_easing",
            "Out GSAP easing",
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
                '0' => [
                    'title' => 'Dancepad - Read More',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Read_More/dancepad_read_more.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' => [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_read_more();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' => [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_read_more();'],
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
    
    'onPropertyChange' => [['script' => 'dancepad_read_more();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_read_more();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_read_more();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_read_more();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_read_more();',
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
            return [['name' => 'data-switch-title', 'template' => '{{ content.read_more_button.read_less_text }}'], ['name' => 'data-in-duration', 'template' => '{{ content.read_more_animation.in_duration.style }}'], ['name' => 'data-out-duration', 'template' => '{{ content.read_more_animation.out_duration.style }}'], ['name' => 'data-in-ease', 'template' => '{{ content.read_more_animation.in_gsap_easing }}'], ['name' => 'data-out-ease', 'template' => '{{ content.read_more_animation.out_gsap_easing }}']];
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
            return [['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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