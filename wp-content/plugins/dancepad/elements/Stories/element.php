<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_stories_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Stories",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Stories extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path d="M6.25 4.75C6.25 3.2298 7.48343 1.998 9.00363 2L15.0036 2.00791C16.521 2.00991 17.75 3.24054 17.75 4.75791L17.75 18.7474C17.75 20.2661 16.5188 21.4974 15 21.4974H9C7.48122 21.4974 6.25 20.2661 6.25 18.7474V4.75Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.8944 6.30056C23.1414 6.79454 22.9412 7.39522 22.4472 7.6422L21.5528 8.08942C21.214 8.25881 21 8.60507 21 8.98385V14.5117C21 14.8905 21.214 15.2367 21.5528 15.4061L22.4472 15.8534C22.9412 16.1003 23.1414 16.701 22.8944 17.195C22.6474 17.689 22.0468 17.8892 21.5528 17.6422L20.6584 17.195C19.642 16.6868 19 15.648 19 14.5117V8.98385C19 7.84753 19.642 6.80874 20.6584 6.30056L21.5528 5.85335C22.0468 5.60636 22.6474 5.80659 22.8944 6.30056Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.10579 6.30056C1.35278 5.80659 1.95345 5.60636 2.44743 5.85335L3.34186 6.30056C4.35821 6.80874 5.00022 7.84753 5.00022 8.98385V14.5117C5.00022 15.648 4.35821 16.6868 3.34186 17.195L2.44743 17.6422C1.95345 17.8892 1.35278 17.689 1.10579 17.195C0.858803 16.701 1.05903 16.1003 1.55301 15.8534L2.44743 15.4061C2.78622 15.2367 3.00022 14.8905 3.00022 14.5117V8.98385C3.00022 8.60507 2.78622 8.25881 2.44743 8.08942L1.55301 7.6422C1.05903 7.39522 0.858803 6.79454 1.10579 6.30056Z" fill="currentColor" />
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
            return 'Stories';
        }
    
        static function className()
        {
            return 'dan-stories';
        }
    
        static function category()
        {
            return 'dancepad_sliders';
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
            return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 250, 'unit' => 'px', 'style' => '250px']], 'height' => ['breakpoint_base' => ['number' => 250, 'unit' => 'px', 'style' => '250px']]], 'thumb' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]], 'active_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'editMode' => 'all']]], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'editMode' => 'all']]], 'color' => 'rgba(233, 232, 232, .2)', 'active_color' => '#e9e8e8', 'height' => ['number' => 4, 'unit' => 'px', 'style' => '4px']], 'stories' => ['brightness' => 70], 'animation' => ['duration' => ['number' => 5, 'unit' => 's', 'style' => '5s'], 'gsap_easing' => 'none'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'topLeft' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'topRight' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottomLeft' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottomRight' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'editMode' => 'all']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Story'], 'settings' => ['advanced' => ['classes' => ['dan-stories__story']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://images.pexels.com/photos/31737046/pexels-photo-31737046.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Story'], 'settings' => ['advanced' => ['classes' => ['dan-stories__story']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://images.pexels.com/photos/27085501/pexels-photo-27085501/free-photo-of-planta-ventanas-descuidado-cubierto-de-vegetacion.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Story'], 'settings' => ['advanced' => ['classes' => ['dan-stories__story']]]], 'children' => [['slug' => 'EssentialElements\Video', 'defaultProperties' => ['content' => ['video' => ['video' => ['url' => 'https://videos.pexels.com/video-files/31565670/13452401_1440_2560_60fps.mp4', 'mime' => 'video/mp4', 'embedUrl' => 'https://videos.pexels.com/video-files/31565670/13452401_1440_2560_60fps.mp4', 'format' => 'video', 'type' => 'video', 'source' => 'local'], 'video_dynamic_meta' => null], 'youtube' => ['loading_method' => 'lightweight', 'loop' => false, 'mute' => true, 'play_inline' => true, 'hide_player_controls' => true]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Story'], 'settings' => ['advanced' => ['classes' => ['dan-stories__story']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://images.pexels.com/photos/31477151/pexels-photo-31477151.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Story'], 'settings' => ['advanced' => ['classes' => ['dan-stories__story']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://images.pexels.com/photos/31568335/pexels-photo-31568335/free-photo-of-majestuoso-resplandor-alpino-en-el-pico-de-la-montana-nevada.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2']]], 'children' => []]]]];
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
          "EssentialElements\\borders",
          "Border",
          "border",
           ['type' => 'popout']
         ), c(
            "thumb",
            "Thumb",
            [getPresetSection(
          "EssentialElements\\spacing_padding_all",
          "Padding",
          "padding",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\layout",
          "Layout",
          "layout",
           ['type' => 'popout']
         ), c(
            "height",
            "Height",
            [],
            ['type' => 'unit', 'layout' => 'inline'],
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
            "active_color",
            "Active Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), getPresetSection(
          "EssentialElements\\borders",
          "Border",
          "border",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Active Border",
          "active_border",
           ['type' => 'popout']
         )],
            ['type' => 'section'],
            false,
            false,
            [],
          ), c(
            "stories",
            "Stories",
            [c(
            "brightness",
            "Brightness",
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
          ), c(
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
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
            false,
            false,
            [],
          ), c(
            "gsap_easing",
            "GSAP Easing",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
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
            return [];
        }
    
        static function settingsControls()
        {
            return [];
        }
    
        static function dependencies()
        {
            return [
                '0' => [
                    'title' => 'Dancepad - Stories',
                    'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Stories/dancepad_stories.min.js?ver=' . DANCEPAD_VERSION],
                ],
                '1' => [
                    'title' => 'Init Builder',
                    'inlineScripts' => ['dancepad_stories();'],
                    'builderCondition' => 'return true;',
                    'frontendCondition' => 'return false;',
                ],
                '2' => [
                    'title' => 'Init Front',
                    'inlineScripts' => ['dancepad_stories();'],
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
    
    'onPropertyChange' => [['script' => 'dancepad_stories();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_stories();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_stories();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_stories();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_stories();',
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
            return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-disable-builder', 'template' => '{% if design.animation.disable_at_the_builder %}
    1
    {% else %}
    0
    {% endif %}'], ['name' => 'data-duration', 'template' => '{{ design.animation.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ design.animation.gsap_easing }}']];
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
            return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image']];
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