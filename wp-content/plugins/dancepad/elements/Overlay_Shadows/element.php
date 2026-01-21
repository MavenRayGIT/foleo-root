<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_overlay_shadows_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\OverlayShadows",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class OverlayShadows extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" d="M9.19294 2.364C9.43615 2.212 9.74475 2.212 9.98796 2.36401C10.0899 2.4344 10.3092 2.58724 10.3716 2.63551C10.5937 2.80508 10.8955 3.05467 11.225 3.38177C11.7313 3.88427 12.3166 4.58336 12.7729 5.46973C14.0995 4.76079 15.4656 4.53328 16.5398 4.48961C17.185 4.46338 17.7364 4.5029 18.1291 4.54941C18.3565 4.57285 18.6596 4.62964 18.7827 4.6551C19.0622 4.71959 19.2804 4.9378 19.3449 5.21726C19.3739 5.37809 19.4357 5.73398 19.4506 5.87094C19.4971 6.26364 19.5366 6.81499 19.5104 7.4602C19.4667 8.53439 19.2392 9.90049 18.5303 11.2271C19.4166 11.6834 20.1157 12.2687 20.6182 12.775C20.9453 13.1045 21.1949 13.4063 21.3645 13.6284C21.4109 13.6884 21.5648 13.9092 21.636 14.012C21.788 14.2552 21.788 14.5638 21.636 14.8071C21.553 14.9299 21.3522 15.2171 21.2128 15.3833C20.9458 15.7119 20.5502 16.1484 20.0309 16.5857C19.0238 17.4337 17.5138 18.3145 15.5585 18.3624C15.6463 18.9303 15.6534 19.4535 15.6308 19.8775C15.6128 20.2167 15.5754 20.4993 15.5419 20.7001C15.5322 20.7602 15.4924 20.9514 15.4738 21.0394C15.4062 21.3061 15.1979 21.5143 14.9313 21.582C14.8062 21.6091 14.5102 21.6685 14.3273 21.6889C13.9704 21.7344 13.4717 21.7711 12.8995 21.736C11.761 21.666 10.2698 21.306 9.06011 20.0963C7.95427 18.9904 7.55831 17.6505 7.44505 16.555C6.34953 16.4417 5.00958 16.0457 3.90374 14.9399C2.69405 13.7302 2.33398 12.239 2.26402 11.1005C2.22886 10.5283 2.26555 10.0296 2.31108 9.67265C2.32254 9.57641 2.38714 9.22993 2.41801 9.06872C2.48567 8.80206 2.69478 8.59362 2.96145 8.52598C3.03926 8.50893 3.2159 8.47149 3.29994 8.45814C3.50073 8.42459 3.78334 8.38722 4.12249 8.36918C4.54647 8.34664 5.06971 8.35373 5.63763 8.44146C5.68545 6.48617 6.56629 4.97615 7.41431 3.96913C7.85162 3.44981 8.28814 3.05422 8.61673 2.78723C8.66672 2.74622 9.0217 2.48799 9.19294 2.364Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5303 10.4697C13.8232 10.7626 13.8232 11.2374 13.5303 11.5303L3.53033 21.5303C3.23744 21.8232 2.76256 21.8232 2.46967 21.5303C2.17678 21.2374 2.17678 20.7626 2.46967 20.4697L12.4697 10.4697C12.7626 10.1768 13.2374 10.1768 13.5303 10.4697Z" fill="currentColor" />
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
            return 'Overlay Shadows';
        }
    
        static function className()
        {
            return 'dan-overlay-shadows';
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
            return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]], 'background' => ['color' => ['breakpoint_base' => '#ffffff']]], 'content' => ['shadows' => ['type' => '1', 'color' => 'rgb(0,0,0,0.2)', 'noise_opacity' => 0.25, 'noise' => true]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content']], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Overlay Shadows']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#000'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'fontWeight' => ['breakpoint_base' => '600']]]]]]], 'children' => []]]]];
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
          "EssentialElements\\size",
          "Size",
          "size",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Border",
          "border",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "shadows",
            "Shadows",
            [c(
            "type",
            "Type",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => '1', 'text' => '1'], ['text' => '2', 'value' => '2'], ['text' => '3', 'value' => '3'], ['text' => '4', 'value' => '4'], ['text' => '5', 'value' => '5'], ['text' => '6', 'value' => '6'], ['text' => '7', 'value' => '7'], ['text' => '8', 'value' => '8'], ['text' => '9', 'value' => '9'], ['text' => '10', 'value' => '10'], ['text' => '11', 'value' => '11'], ['text' => '12', 'value' => '12'], ['text' => '13', 'value' => '13'], ['text' => '14', 'value' => '14'], ['text' => '15', 'value' => '15'], ['text' => '16', 'value' => '16'], ['text' => '17', 'value' => '17'], ['text' => '18', 'value' => '18'], ['text' => '19', 'value' => '19'], ['text' => '20', 'value' => '20'], ['text' => '21', 'value' => '21'], ['text' => '22', 'value' => '22'], ['text' => '23', 'value' => '23'], ['text' => '24', 'value' => '24'], ['text' => '25', 'value' => '25'], ['text' => '26', 'value' => '26'], ['text' => '27', 'value' => '27'], ['text' => '28', 'value' => '28'], ['text' => '29', 'value' => '29'], ['text' => '30', 'value' => '30'], ['text' => '31', 'value' => '31'], ['text' => '32', 'value' => '32']]],
            false,
            false,
            [],
          ), c(
            "color",
            "Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "noise",
            "Noise",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "noise_opacity",
            "Noise Opacity",
            [],
            ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1], 'condition' => [[['path' => 'content.shadows.noise', 'operand' => 'is set', 'value' => '']]]],
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
                    'title' => 'Dancepad - Overlay Shadows',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Overlay_Shadows/dancepad_overlay_shadows.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' => [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_overlay_shadows();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' => [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_overlay_shadows();'],
                    'builderCondition' => 'return false;',
                    'frontendCondition' => 'return true;',
                ],
                '3' => [
                    'title' => 'GSAP',
                    'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%', '%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
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
    
    'onPropertyChange' => [['script' => 'dancepad_overlay_shadows();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_overlay_shadows();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_overlay_shadows();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_overlay_shadows();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_overlay_shadows();',
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
            return [
                ['name' => 'data-flickering', 'template' => '1'],
                ['name' => 'data-src', 'template' => DANCEPAD_PLUGIN_URL . 'elements/Overlay_Shadows/srcs/{{ content.shadows.type }}.png'],
                ['name' => 'data-noise-src', 'template' => DANCEPAD_PLUGIN_URL . 'elements/Overlay_Shadows/srcs/overlayshadows_noise.png'],
                ['name' => 'data-include-noise', 'template' => '{% if content.shadows.noise %}true{% else %}false{% endif %}']
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
            return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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