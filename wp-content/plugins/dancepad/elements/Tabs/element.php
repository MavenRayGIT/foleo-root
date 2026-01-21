<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_tabs_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Tabs",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Tabs extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path opacity="0.4" d="M13.0537 3.25C14.1865 3.24998 15.1123 3.24996 15.8431 3.34822C16.6071 3.45093 17.2694 3.67321 17.7981 4.2019C18.3268 4.7306 18.5491 5.39294 18.6518 6.15689C18.75 6.88775 18.75 7.81348 18.75 8.94631V15.0537C18.75 16.1865 18.75 17.1123 18.6518 17.8431C18.5491 18.6071 18.3268 19.2694 17.7981 19.7981C17.2694 20.3268 16.6071 20.5491 15.8431 20.6518C15.1123 20.75 14.1865 20.75 13.0537 20.75H13.0537H10.9463H10.9463C9.81347 20.75 8.88774 20.75 8.15689 20.6518C7.39294 20.5491 6.7306 20.3268 6.2019 19.7981C5.67321 19.2694 5.45093 18.6071 5.34822 17.8431C5.24996 17.1123 5.24998 16.1865 5.25 15.0537V15.0537V8.94631V8.94629C5.24998 7.81346 5.24996 6.88774 5.34822 6.15689C5.45093 5.39294 5.67321 4.7306 6.2019 4.2019C6.7306 3.67321 7.39293 3.45093 8.15689 3.34822C8.88774 3.24996 9.81346 3.24998 10.9463 3.25H10.9463H13.0537H13.0537Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 6.5C1.25 6.08579 1.58579 5.75 2 5.75C3.24264 5.75 4.25 6.75736 4.25 8V16C4.25 17.2426 3.24264 18.25 2 18.25C1.58579 18.25 1.25 17.9142 1.25 17.5C1.25 17.0858 1.58579 16.75 2 16.75C2.41421 16.75 2.75 16.4142 2.75 16V8C2.75 7.58579 2.41421 7.25 2 7.25C1.58579 7.25 1.25 6.91421 1.25 6.5Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.75 8C19.75 6.75736 20.7574 5.75 22 5.75C22.4142 5.75 22.75 6.08579 22.75 6.5C22.75 6.91421 22.4142 7.25 22 7.25C21.5858 7.25 21.25 7.58579 21.25 8V16C21.25 16.4142 21.5858 16.75 22 16.75C22.4142 16.75 22.75 17.0858 22.75 17.5C22.75 17.9142 22.4142 18.25 22 18.25C20.7574 18.25 19.75 17.2426 19.75 16V8Z" fill="currentColor" />
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
            return 'Tabs';
        }
    
        static function className()
        {
            return 'dan-tabs';
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
            return ['content' => ['animation' => ['from_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'from_y' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'from_opacity' => 0, 'css_easing' => 'ease', 'duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']], 'content' => ['active_tab' => 1]], 'design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'gap' => ['breakpoint_base' => ['number' => 25, 'unit' => 'px', 'style' => '25px']]], 'dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'Dancepad\MorphingNav', 'defaultProperties' => ['content' => ['content' => ['event' => 'click', 'active_item' => 1, 'page_name_as_active_item' => false], 'animation' => ['morphing_transition' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease']], 'design' => ['morphing_div_style' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'topRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomLeft' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottomRight' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'editMode' => 'all']]], 'background' => '#D1C9FF'], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => null, 'flex_direction' => ['breakpoint_base' => 'row']]]], 'children' => [['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'background' => ['color' => ['breakpoint_base' => null]]], 'settings' => ['advanced' => ['classes' => ['dan-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]], ['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'background' => ['color' => ['breakpoint_base' => null]]], 'settings' => ['advanced' => ['classes' => ['dan-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]], ['slug' => 'Dancepad\MorphingItem', 'defaultProperties' => ['design' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'background' => ['color' => ['breakpoint_base' => null]]], 'settings' => ['advanced' => ['classes' => ['dan-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Heading', 'tags' => 'h6']]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-tabs__tab-content'], 'attributes' => [['name' => 'data-show', 'value' => '1']]]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['background' => ['color' => '#2EDAB5FF'], 'container' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'right' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'top' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottom' => ['number' => 100, 'unit' => 'px', 'style' => '100px']]]], 'min_height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-tabs__tab-content'], 'attributes' => [['name' => 'data-show', 'value' => '1']]]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['background' => ['color' => '#F14545FF'], 'container' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'right' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'top' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottom' => ['number' => 100, 'unit' => 'px', 'style' => '100px']]]], 'min_height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-tabs__tab-content'], 'attributes' => [['name' => 'data-show', 'value' => '1']]]], 'meta' => ['friendlyName' => 'Tab'], 'design' => ['background' => ['color' => '#50A4ECFF'], 'container' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'right' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'top' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'bottom' => ['number' => 100, 'unit' => 'px', 'style' => '100px']]]], 'min_height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'layout_v2' => ['layout' => 'vertical', 'v_align' => ['breakpoint_base' => 'center'], 'v_vertical_align' => ['breakpoint_base' => 'center']]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Tab', 'tags' => 'h3']]], 'children' => []]]]];
        }
    
        static function cssTemplate()
        {
            $template = file_get_contents(__DIR__ . '/css.twig');
            return $template;
        }
    
        static function designControls()
        {
            return [getPresetSection(
          "EssentialElements\\layout",
          "Layout",
          "layout",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\spacing_margin_all",
          "Margin",
          "margin",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\size",
          "Size",
          "size",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Active Tab should match Morphing Nav\'s Active Item for a proper navigation understanding.</p>']],
            false,
            false,
            [],
          ), c(
            "active_tab",
            "Active Tab",
            [],
            ['type' => 'number', 'layout' => 'inline'],
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
            "from_opacity",
            "From opacity",
            [],
            ['type' => 'number', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "from_x",
            "From X",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
            false,
            false,
            [],
          ), c(
            "from_y",
            "From Y",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', '%', 'em', 'rem', 'vw', 'vh', 'svw', 'svh', 'auto', 'custom']]],
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
            "css_easing",
            "CSS easing",
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
          )];
        }
    
        static function settingsControls()
        {
            return [];
        }
    
        static function dependencies()
        {
            return [
              '0' =>  ['title' => 'Dancepad - Tabs','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Tabs/dancepad_tabs.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_tabs();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_tabs();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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
    
    'onPropertyChange' => [['script' => 'dancepad_tabs();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_tabs();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_tabs();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_tabs();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_tabs();',
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
            return [['name' => 'data-activetab', 'template' => '{{ content.content.active_tab }}'], ['name' => 'data-flickering', 'template' => '1']];
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
