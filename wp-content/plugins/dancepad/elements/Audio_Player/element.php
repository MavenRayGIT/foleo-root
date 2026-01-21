<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_audio_player_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\AudioPlayer",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class AudioPlayer extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path d="M2 18.4062C2 20.8915 4.01472 22.9062 6.5 22.9062C8.98528 22.9062 11 20.8915 11 18.4062C11 15.921 8.98528 13.9062 6.5 13.9062C4.01472 13.9062 2 15.921 2 18.4062Z" fill="currentColor" />
    <path d="M14 15.9062C14 18.1154 15.7909 19.9062 18 19.9062C20.2091 19.9062 22 18.1154 22 15.9062C22 13.6971 20.2091 11.9062 18 11.9062C15.7909 11.9062 14 13.6971 14 15.9062Z" fill="currentColor" />
    <path opacity="0.4" d="M22 2.63834C22.0002 2.50355 22.0004 2.31281 21.9779 2.15047C21.9554 1.98781 21.8697 1.51504 21.3959 1.24399C20.9159 0.969391 20.4584 1.14388 20.3139 1.20447C20.1623 1.26796 19.9968 1.36557 19.8771 1.43608L19.8771 1.43609L19.8484 1.45298C18.5076 2.24129 15.7632 3.49593 11.9136 3.82438L11.8628 3.82871C11.4162 3.86676 10.9981 3.90237 10.6619 3.97099C10.302 4.04446 9.86802 4.18536 9.5269 4.55682C9.19408 4.91925 9.08528 5.34504 9.04046 5.70799C8.99986 6.03686 8.99992 6.43677 8.99999 6.85406L9 14.6632C10.206 15.4705 11 16.8452 11 18.4054V10.8835C15.086 10.7052 18.1779 9.46881 20 8.56883V12.4406C21.1956 13.1322 22 14.4249 22 15.9054V6.92382C22.0002 6.91088 22.0002 6.89791 22 6.88494L22 2.63834V2.63834Z" fill="currentColor" />
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
        return 'Audio Player';
    }

    static function className()
    {
        return 'dan-audio-player';
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
        return ['content' => ['audio' => ['source' => 'https://nextbricks.io/wp-content/uploads/2025/04/Cartoon-Daniel-Levi-Jeja-On-On-feat.-Daniel-Levi-NCS-Release.mp3'], 'progress_animation' => ['gsap_easing' => 'expo', 'duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']], 'thumbnail' => ['source' => 'https://i.scdn.co/image/ab67616d00001e0291293cbe0afa8ca67f8ab9f4'], 'texts' => ['audio_title' => 'On & On', 'artist_name' => 'NCS']], 'design' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 250, 'unit' => 'px', 'style' => '250px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'background' => ['color' => ['breakpoint_base' => '#272727']], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'topRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomLeft' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'bottomRight' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'editMode' => 'all']]], 'top_wrapper' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'thumbnail' => ['size' => ['width' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']], 'height' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]]], 'texts' => ['name_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]], 'color' => ['breakpoint_base' => '#a0a0a0']], 'artist_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]], 'color' => ['breakpoint_base' => '#656565']], 'gap' => ['number' => 2, 'unit' => 'px', 'style' => '2px']], 'play_pause_button' => ['size' => ['width' => ['breakpoint_base' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'height' => ['breakpoint_base' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]], 'margin' => ['margin' => ['breakpoint_base' => ['right' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottom' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'play_background' => '#3a8ce3', 'play_fill' => '#ffffff', 'pause_background' => '#3a8ce3', 'pause_fill' => '#ffffff'], 'duration_progress_container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottom' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'right' => ['number' => 2, 'unit' => 'px', 'style' => '2px']]]]], 'progress' => ['fill_color' => '#3a8ce3', 'height' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'margin' => ['margin' => ['breakpoint_base' => ['right' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'path_color' => '#555555'], 'timer_duration' => ['typography' => ['color' => ['breakpoint_base' => '#a0a0a0'], 'typography' => ['custom' => ['customTypography' => ['fontWeight' => ['breakpoint_base' => '500'], 'fontSize' => ['breakpoint_base' => null], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'timer_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'fontWeight' => ['breakpoint_base' => '500']]]], 'color' => ['breakpoint_base' => '#a0a0a0']], 'duration_typography' => ['color' => ['breakpoint_base' => '#a0a0a0'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]]]];
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
     ), c(
        "top_wrapper",
        "Top Wrapper",
        [getPresetSection(
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "thumbnail",
        "Thumbnail",
        [getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "texts",
        "Texts",
        [c(
        "gap",
        "Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Name Typography",
      "name_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Artist Typography",
      "artist_typography",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "play_pause_button",
        "Play/Pause Button",
        [getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
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
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "play_background",
        "Play Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "play_fill",
        "Play Fill",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "pause_background",
        "Pause Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "pause_fill",
        "Pause Fill",
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
        "duration_progress_container",
        "Duration & Progress Container",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "progress",
        "Progress",
        [getPresetSection(
      "EssentialElements\\spacing_margin_all",
      "Margin",
      "margin",
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
        "fill_color",
        "Fill color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_color",
        "Path color",
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
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "timer_duration",
        "Timer & Duration",
        [getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Timer Typography",
      "timer_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
      "Duration Typography",
      "duration_typography",
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
        "audio",
        "Audio",
        [c(
        "source",
        "Source",
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
        "thumbnail",
        "Thumbnail",
        [c(
        "source",
        "Source",
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
        "texts",
        "Texts",
        [c(
        "audio_title",
        "Audio Title",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "artist_name",
        "Artist Name",
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
        "progress_animation",
        "Progress Animation",
        [c(
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
                'title' => 'Dancepad - Audio Player',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Audio_Player/dancepad_audio_player.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_audio_player();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_audio_player();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'Howler',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_howler.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '4' => [
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

'onPropertyChange' => [['script' => 'dancepad_audio_player();',
],],

'onCreatedElement' => [['script' => 'dancepad_audio_player();',
],],

'onMountedElement' => [['script' => 'dancepad_audio_player();',
],],

'onMovedElement' => [['script' => 'dancepad_audio_player();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_audio_player();',
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
        return [['name' => 'data-duration', 'template' => '{{ content.progress_animation.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ content.progress_animation.gsap_easing }}'], ['name' => 'data-source', 'template' => '{{ content.audio.source }}']];
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