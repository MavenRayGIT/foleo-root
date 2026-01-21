<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_image_reveal_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ImageReveal",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ImageReveal extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">     <path d="M9.5 8.5C9.5 9.60457 8.60457 10.5 7.5 10.5C6.39543 10.5 5.5 9.60457 5.5 8.5C5.5 7.39543 6.39543 6.5 7.5 6.5C8.60457 6.5 9.5 7.39543 9.5 8.5Z" fill="currentColor" />     <path d="M18.5 1.25C18.8138 1.25 19.0945 1.4454 19.2034 1.73972L19.4613 2.43675C19.8233 3.4151 19.9388 3.68091 20.1289 3.87106C20.3191 4.06121 20.5849 4.17667 21.5633 4.53869L22.2603 4.79661C22.5546 4.90552 22.75 5.18617 22.75 5.5C22.75 5.81383 22.5546 6.09448 22.2603 6.20339L21.5633 6.46131C20.5849 6.82333 20.3191 6.93879 20.1289 7.12894C19.9388 7.31909 19.8233 7.5849 19.4613 8.56325L19.2034 9.26028C19.0945 9.5546 18.8138 9.75 18.5 9.75C18.1862 9.75 17.9055 9.5546 17.7966 9.26028L17.5387 8.56325C17.1767 7.5849 17.0612 7.31909 16.8711 7.12894C16.6809 6.93879 16.4151 6.82333 15.4367 6.46131L14.7397 6.20339C14.4454 6.09448 14.25 5.81383 14.25 5.5C14.25 5.18617 14.4454 4.90552 14.7397 4.79661L15.4367 4.53869C16.4151 4.17667 16.6809 4.06121 16.8711 3.87106C17.0612 3.68091 17.1767 3.4151 17.5387 2.43675L17.7966 1.73972C17.9055 1.4454 18.1862 1.25 18.5 1.25Z" fill="currentColor" />     <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M11.5015 2.25H11.4273H11.4273C9.30315 2.24998 7.60973 2.24996 6.28198 2.42847C4.91104 2.61279 3.78471 3.00337 2.89404 3.89404C2.00337 4.78471 1.61279 5.91104 1.42847 7.28198C1.24996 8.60973 1.24998 10.3031 1.25 12.4273V12.4273V12.5727V12.5727C1.24998 14.6969 1.24996 16.3903 1.42847 17.718C1.61279 19.089 2.00337 20.2153 2.89404 21.106C3.78471 21.9966 4.91104 22.3872 6.28198 22.5715C7.60974 22.75 9.30317 22.75 11.4274 22.75H11.5727C13.6968 22.75 15.3903 22.75 16.718 22.5715C18.089 22.3872 19.2153 21.9966 20.106 21.106C20.9966 20.2153 21.3872 19.089 21.5715 17.718C21.75 16.3903 21.75 14.6968 21.75 12.5727V12.4987C21.75 11.9817 21.75 11.4923 21.7477 11.0309C21.7451 10.4918 21.3059 10.0569 20.7667 10.0595C20.2276 10.0622 19.7927 10.5014 19.7954 11.0405C19.7976 11.4966 19.7976 11.9814 19.7976 12.5C19.7976 12.799 19.7976 13.0861 19.7971 13.362C13.7051 10.3912 9.3109 15.6805 5.41613 20.3954C4.91695 20.2327 4.56206 20.0129 4.27458 19.7254C3.80713 19.258 3.51865 18.6123 3.36344 17.4579C3.20446 16.2753 3.20238 14.7135 3.20238 12.5C3.20238 10.2865 3.20446 8.72466 3.36344 7.54213C3.51865 6.38769 3.80713 5.74203 4.27458 5.27458C4.74203 4.80713 5.38769 4.51865 6.54213 4.36344C7.72466 4.20446 9.28655 4.20238 11.5 4.20238C12.0186 4.20238 12.5034 4.20238 12.9595 4.20463C13.4986 4.20729 13.9378 3.77239 13.9405 3.23326C13.9431 2.69413 13.5082 2.25493 12.9691 2.25227C12.5078 2.25 12.0184 2.25 11.5015 2.25Z" fill="currentColor" /> </svg>';
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
        return "content.content.tag";
    }

    static function name()
    {
        return 'Image Reveal';
    }

    static function className()
    {
        return 'dan-image-reveal';
    }

    static function category()
    {
        return 'dancepad_medias';
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
        return ['content' => ['content' => ['source' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/3824262/pexels-photo-3824262.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => 'liquid_gradient', 'caption' => '']], 'animation' => ['direction' => 'left', 'scale' => 1.3, 'duration' => ['number' => 1.6, 'unit' => 's', 'style' => '1.6s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'expo'], 'scrolltrigger' => ['trigger' => 'this', 'start' => 'top bottom', 'toggleactions' => 'play none none none', 'additional_triggers' => null, 'element' => null]], 'design' => ['dimensions' => ['width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'size' => ['width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'borders' => ['radius' => ['breakpoint_base' => null]]]];
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
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "source",
        "Source",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
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
        "direction",
        "Direction",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'left', 'text' => 'left'], ['text' => 'right', 'value' => 'right'], ['text' => 'bottom', 'value' => 'bottom'], ['text' => 'top', 'value' => 'top']]],
        false,
        false,
        [],
      ), c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']]],
        false,
        false,
        [],
      ), c(
        "duration",
        "Duration",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "delay",
        "Delay",
        [],
        ['type' => 'unit', 'layout' => 'vertical', 'rangeOptions' => ['min' => 0, 'max' => 7, 'step' => 0.1], 'unitOptions' => ['types' => ['s']]],
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
        "trigger",
        "Trigger",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "toggleactions",
        "toggleActions",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "additional_triggers",
        "Additional Triggers",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'Click'], ['text' => 'Hover', 'value' => 'hover']]],
        false,
        false,
        [],
      ), c(
        "element",
        "Element",
        [],
        ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'click']], [['path' => 'content.scrolltrigger.additional_triggers', 'operand' => 'equals', 'value' => 'hover']]]],
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
        return ['0' =>  ['title' => 'Dancepad - Image Reveal','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Image_Reveal/dancepad_image_reveal.min.js?ver=' . DANCEPAD_VERSION],],
        '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_image_reveal();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
        '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_image_reveal();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_image_reveal();',
],],

'onCreatedElement' => [['script' => 'dancepad_image_reveal();',
],],

'onMountedElement' => [['script' => 'dancepad_image_reveal();',
],],

'onMovedElement' => [['script' => 'dancepad_image_reveal();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_image_reveal();',
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
        return [['name' => 'data-animation-direction', 'template' => '{{ content.animation.direction }}'], ['name' => 'data-animation-duration', 'template' => '{{ content.animation.duration.style }}'], ['name' => 'data-animation-delay', 'template' => '{{ content.animation.delay.style }}'], ['name' => 'data-animation-easing', 'template' => '{{ content.animation.gsap_easing }}'], ['name' => 'data-scrolltrigger-trigger', 'template' => '{{ content.scrolltrigger.trigger }}'], ['name' => 'data-scrolltrigger-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-scrolltrigger-toggleactions', 'template' => '{{ content.scrolltrigger.toggleactions }}'], ['name' => 'data-scrolltrigger-additional', 'template' => '{{ content.scrolltrigger.additional_triggers }}'], ['name' => 'data-scrolltrigger-element', 'template' => '{{ content.scrolltrigger.element }}']];
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
        return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'image_url', 'path' => 'content.content.source']];
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

