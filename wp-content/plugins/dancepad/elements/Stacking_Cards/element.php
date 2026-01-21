<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_stacking_cards_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\StackingCards",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class StackingCards extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M8.64298 3.14559L6.93816 3.93362C4.31272 5.14719 3 5.75397 3 6.75C3 7.74603 4.31272 8.35281 6.93817 9.56638L8.64298 10.3544C10.2952 11.1181 11.1214 11.5 12 11.5C12.8786 11.5 13.7048 11.1181 15.357 10.3544L17.0618 9.56638C19.6873 8.35281 21 7.74603 21 6.75C21 5.75397 19.6873 5.14719 17.0618 3.93362L15.357 3.14559C13.7048 2.38186 12.8786 2 12 2C11.1214 2 10.2952 2.38186 8.64298 3.14559Z" fill="currentColor" />
    <path d="M8.64298 3.14559L6.93816 3.93362C4.31272 5.14719 3 5.75397 3 6.75C3 7.74603 4.31272 8.35281 6.93817 9.56638L8.64298 10.3544C10.2952 11.1181 11.1214 11.5 12 11.5C12.8786 11.5 13.7048 11.1181 15.357 10.3544L17.0618 9.56638C19.6873 8.35281 21 7.74603 21 6.75C21 5.75397 19.6873 5.14719 17.0618 3.93362L15.357 3.14559C13.7048 2.38186 12.8786 2 12 2C11.1214 2 10.2952 2.38186 8.64298 3.14559Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M20.788 11.0977C20.9293 11.2964 21 11.5036 21 11.7314C21 12.7132 19.6873 13.3114 17.0618 14.5077L15.357 15.2845C13.7048 16.0373 12.8786 16.4137 12 16.4137C11.1214 16.4137 10.2952 16.0373 8.64298 15.2845L6.93817 14.5077C4.31272 13.3114 3 12.7132 3 11.7314C3 11.5036 3.07067 11.2964 3.212 11.0977" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M20.3767 16.2656C20.7922 16.5966 21 16.9265 21 17.3171C21 18.299 19.6873 18.8971 17.0618 20.0934L15.357 20.8702C13.7048 21.6231 12.8786 21.9995 12 21.9995C11.1214 21.9995 10.2952 21.6231 8.64298 20.8702L6.93817 20.0934C4.31272 18.8971 3 18.299 3 17.3171C3 16.9265 3.20778 16.5966 3.62334 16.2656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
        return 'Stacking Cards';
    }

    static function className()
    {
        return 'dan-stacking-cards';
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
        return ['content' => ['settings' => ['height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'animation' => ['brightness_to' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'radius_to' => 50, 'scale_to' => 0.75, 'top' => ['number' => 25, 'unit' => 'vh', 'style' => '25vh']], 'scrolltrigger' => ['start' => 'top center', 'end' => '+=300%', 'gsap_easing' => 'none']], 'design' => ['cards_dimensions' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => 600, 'unit' => 'px', 'style' => '600px']]], 'margin' => null]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-stacking-cards__card']]], 'meta' => ['friendlyName' => 'Card'], 'design' => ['background' => ['color' => '#2ED7DAFF']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Card', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-stacking-cards__card']]], 'meta' => ['friendlyName' => 'Card'], 'design' => ['background' => ['color' => '#E05CACFF']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Card', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-stacking-cards__card']]], 'meta' => ['friendlyName' => 'Card'], 'design' => ['background' => ['color' => '#DA5D2EFF']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Card', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-stacking-cards__card']]], 'meta' => ['friendlyName' => 'Card'], 'design' => ['background' => ['color' => '#84F384FF']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Card', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-stacking-cards__card']]], 'meta' => ['friendlyName' => 'Card'], 'design' => ['background' => ['color' => '#2ED0DAFF']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Card', 'tags' => 'h3']]], 'children' => []]]]];
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
      "Cards dimensions",
      "cards_dimensions",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "settings",
        "Settings",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>If you want the last card to stack you will have to define a fixed height.</p>']],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', 'vh', '%']]],
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
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Top will define the general top distance the cards will stick to. In case you want a stacking effect you can customize top value at each card.</p>']],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom', 'vh', '%']]],
        false,
        false,
        [],
      ), c(
        "brightness_to",
        "Brightness to",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']]],
        false,
        false,
        [],
      ), c(
        "scale_to",
        "Scale to",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']]],
        false,
        false,
        [],
      ), c(
        "radius_to",
        "Radius to",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['%']]],
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
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Start and End values are applied to Stacking Cards element, that wraps all the cards.</p>']],
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
        "end",
        "End",
        [],
        ['type' => 'text', 'layout' => 'inline'],
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
        return ['0' =>  ['title' => 'Dancepad - Stacking Cards','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Stacking_Cards/dancepad_stacking_cards.min.js?ver=' . DANCEPAD_VERSION],],
        '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_stacking_cards();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
        '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_stacking_cards();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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

'onPropertyChange' => [['script' => 'dancepad_stacking_cards();',
],],

'onCreatedElement' => [['script' => 'dancepad_stacking_cards();',
],],

'onMountedElement' => [['script' => 'dancepad_stacking_cards();',
],],

'onMovedElement' => [['script' => 'dancepad_stacking_cards();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_stacking_cards();',
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
        return [['name' => 'data-final-brightness', 'template' => '{{ content.animation.brightness_to.style }}'], ['name' => 'data-scale', 'template' => '{{ content.animation.scale_to }}'], ['name' => 'data-border-radius', 'template' => '{{ content.animation.radius_to }}'], ['name' => 'data-start', 'template' => '{{ content.scrolltrigger.start }}'], ['name' => 'data-end', 'template' => '{{ content.scrolltrigger.end }}'], ['name' => 'data-easing', 'template' => '{{ content.scrolltrigger.gsap_easing }}']];
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
