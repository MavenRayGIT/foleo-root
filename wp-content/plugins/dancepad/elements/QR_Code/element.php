<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_qr_code_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\QRCode",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class QRCode extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path opacity="0.4" d="M3 6C3 4.58579 3 3.87868 3.43934 3.43934C3.87868 3 4.58579 3 6 3C7.41421 3 8.12132 3 8.56066 3.43934C9 3.87868 9 4.58579 9 6C9 7.41421 9 8.12132 8.56066 8.56066C8.12132 9 7.41421 9 6 9C4.58579 9 3.87868 9 3.43934 8.56066C3 8.12132 3 7.41421 3 6Z" stroke="currentColor" stroke-width="1.5" />
            <path d="M3 18C3 16.5858 3 15.8787 3.43934 15.4393C3.87868 15 4.58579 15 6 15C7.41421 15 8.12132 15 8.56066 15.4393C9 15.8787 9 16.5858 9 18C9 19.4142 9 20.1213 8.56066 20.5607C8.12132 21 7.41421 21 6 21C4.58579 21 3.87868 21 3.43934 20.5607C3 20.1213 3 19.4142 3 18Z" stroke="currentColor" stroke-width="1.5" />
            <path d="M3 12L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 3V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M15 6C15 4.58579 15 3.87868 15.4393 3.43934C15.8787 3 16.5858 3 18 3C19.4142 3 20.1213 3 20.5607 3.43934C21 3.87868 21 4.58579 21 6C21 7.41421 21 8.12132 20.5607 8.56066C20.1213 9 19.4142 9 18 9C16.5858 9 15.8787 9 15.4393 8.56066C15 8.12132 15 7.41421 15 6Z" stroke="currentColor" stroke-width="1.5" />
            <path opacity="0.4" d="M21 12H15C13.5858 12 12.8787 12 12.4393 12.4393C12 12.8787 12 13.5858 12 15M12 17.7692V20.5385M15 15V16.5C15 17.9464 15.7837 18 17 18C17.5523 18 18 18.4477 18 19M16 21H15M18 15C19.4142 15 20.1213 15 20.5607 15.44C21 15.8799 21 16.5881 21 18.0043C21 19.4206 21 20.1287 20.5607 20.5687C20.24 20.8898 19.7767 20.9766 19 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
        </svg>';
        }
    
        static function tag()
        {
            return 'qr-code';
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
            return 'QR Code';
        }
    
        static function className()
        {
            return 'dan-qr-code';
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
            return ['content' => ['animation' => ['drag_distance' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'drop_distance' => ['number' => 500, 'unit' => 'px', 'style' => '500px'], 'bend_intensity' => 100, 'include_logo' => true, 'qr_content' => 'https://breakdance.com/', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/11/nextbreakdance-logo.png']], 'design' => ['colors' => ['color' => '#000', 'background' => '#EBF5FFFF', 'squares_color' => '#E05020FF', 'qr_color' => '#0160A5FF', 'squares_border_color' => '#000'], 'dimensions' => ['height' => ['number' => 150, 'unit' => 'px', 'style' => '150px'], 'width' => ['number' => 150, 'unit' => 'px', 'style' => '150px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 150, 'unit' => 'px', 'style' => '150px']], 'height' => ['breakpoint_base' => ['number' => 150, 'unit' => 'px', 'style' => '150px']]]]];
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
          ), c(
            "qr_color",
            "QR Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "squares_color",
            "Squares Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "squares_border_color",
            "Squares Border Color",
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
            "qr_content",
            "QR Content",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "include_logo",
            "Include logo",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "url",
            "URL",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'condition' => [[['path' => 'content.animation.include_logo', 'operand' => 'is set', 'value' => '']]]],
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
            return ['0' =>  ['title' => 'Dancepad - QR Code','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/QR_Code/dancepad_qr_code.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_qr_code();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_qr_code();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_qr_code();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_qr_code();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_qr_code();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_qr_code();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_qr_code();',
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
            return [['name' => 'module-color', 'template' => '{{ design.colors.qr_color }}'], ['name' => 'position-ring-color', 'template' => '{{ design.colors.squares_border_color }}'], ['name' => 'position-center-color', 'template' => '{{ design.colors.squares_color }}'], ['name' => 'contents', 'template' => '{{ content.animation.qr_content }}'], ['name' => 'data-flickering', 'template' => '1']];
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'string', 'path' => 'content.animation.qr_content'], ['accepts' => 'string', 'path' => 'content.animation.url']];
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
