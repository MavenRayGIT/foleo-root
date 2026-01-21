<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_observer_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Observer",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Observer extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7052 3.57483C19.0607 4.38436 20.75 6.61708 20.75 9.25C20.75 9.80228 21.1977 10.25 21.75 10.25C22.3023 10.25 22.75 9.80228 22.75 9.25C22.75 4.82772 19.1723 1.25 14.75 1.25C14.3897 1.25 14.0573 1.44379 13.8798 1.7573C13.7023 2.07081 13.7071 2.45556 13.8925 2.76449L14.9425 4.51449C15.2266 4.98807 15.8409 5.14164 16.3145 4.8575C16.7588 4.59091 16.9214 4.03377 16.7052 3.57483Z" fill="currentColor" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.25 13.75C1.69772 13.75 1.25 14.1977 1.25 14.75C1.25 19.1723 4.82772 22.75 9.25 22.75C9.61027 22.75 9.94269 22.5562 10.1202 22.2427C10.2977 21.9292 10.2929 21.5444 10.1075 21.2355L9.05751 19.4855C8.77336 19.0119 8.1591 18.8584 7.68552 19.1425C7.24121 19.4091 7.07858 19.9662 7.29482 20.4252C4.93928 19.6156 3.25 17.3829 3.25 14.75C3.25 14.1977 2.80228 13.75 2.25 13.75Z" fill="currentColor" />
            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M7 4C7.55228 4 8 4.44772 8 5V6L12.0686 6C13.1886 5.99996 14.1287 5.99992 14.8764 6.10045C15.6681 6.20688 16.392 6.44224 16.9749 7.02513C17.5578 7.60801 17.7931 8.3319 17.8996 9.12357C18.0001 9.87126 18 10.8114 18 11.9314L18 16H19C19.5523 16 20 16.4477 20 17C20 17.5523 19.5523 18 19 18H18V19C18 19.5523 17.5523 20 17 20C16.4477 20 16 19.5523 16 19V18L11.9314 18C10.8114 18 9.87126 18.0001 9.12357 17.8996C8.3319 17.7931 7.60801 17.5578 7.02513 16.9749C6.44224 16.392 6.20688 15.6681 6.10045 14.8764C5.99992 14.1287 5.99996 13.1886 6 12.0686L6 8H5C4.44772 8 4 7.55228 4 7C4 6.44772 4.44772 6 5 6H6V5C6 4.44772 6.44772 4 7 4ZM8 8V12C8 13.2068 8.00212 14.0113 8.08261 14.6099C8.15923 15.1798 8.28999 15.4113 8.43934 15.5607C8.58869 15.71 8.82017 15.8408 9.39007 15.9174C9.98873 15.9979 10.7932 16 12 16H16V12C16 10.7932 15.9979 9.98873 15.9174 9.39007C15.8408 8.82017 15.71 8.58869 15.5607 8.43934C15.4113 8.28999 15.1798 8.15923 14.6099 8.08261C14.0113 8.00212 13.2068 8 12 8H8Z" fill="currentColor" />
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
            return 'Observer';
        }
    
        static function className()
        {
            return 'dan-observer';
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
            return ['design' => ['dimensions' => ['height' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'width' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'front_back_styles' => ['background' => '#FFF', 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'editMode' => 'all']]]], 'colors' => ['background' => '#000'], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'topRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomLeft' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'bottomRight' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'editMode' => 'all']]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center']], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'height' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']]]], 'content' => ['animation' => ['duration' => ['number' => 1.3, 'unit' => 's', 'style' => '1.3s'], 'css_easing' => 'cubic-bezier(0.175, 0.885, 0.32, 1.275)', 'perspective' => 30, 'event' => 'hover', 'type' => 'horizontal', 'constrain' => 800]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Observer', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF']]]], 'children' => []]];
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
          "EssentialElements\\spacing_padding_all",
          "Padding",
          "padding",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\borders",
          "Borders",
          "borders",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\size",
          "Size",
          "size",
           ['type' => 'popout']
         ), c(
            "colors",
            "Colors",
            [c(
            "background",
            "Background",
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
          )];
        }
    
        static function contentControls()
        {
            return [c(
            "animation",
            "Animation",
            [c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Place the content you want at the Observer and set the element to observe on mousemove.</p><p>Observe is the body by default.</p>']],
            false,
            false,
            [],
          ), c(
            "observe",
            "Observe",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'placeholder' => '.className'],
            false,
            false,
            [],
          ), c(
            "constrain",
            "Constrain",
            [],
            ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
            false,
            false,
            [],
          ), c(
            "perspective",
            "Perspective",
            [],
            ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'custom']]],
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
            return ['0' =>  ['title' => 'Dancepad - Observer','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Observer/dancepad_observer.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_observer();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_observer();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_observer();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_observer();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_observer();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_observer();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_observer();',
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
            return [['name' => 'data-observe', 'template' => '{{ content.animation.observe }}'], ['name' => 'data-constrain', 'template' => '{{ content.animation.constrain }}'], ['name' => 'data-perspective', 'template' => '{{ content.animation.perspective }}']];
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
