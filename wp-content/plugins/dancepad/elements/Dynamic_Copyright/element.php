<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_dynamic_copyright_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\DynamicCopyright",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class DynamicCopyright extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
        <path opacity="0.4" d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z" fill="currentColor" />
        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.968 7L13 7C14.6569 7 16 8.34315 16 10C16 10.5523 15.5523 11 15 11C14.4477 11 14 10.5523 14 10C14 9.44772 13.5523 9 13 9H12C11.5204 9 11.2107 9.00054 10.9738 9.01671C10.7458 9.03227 10.6589 9.05888 10.6173 9.07612C10.3723 9.17762 10.1776 9.37229 10.0761 9.61732C10.0589 9.65893 10.0323 9.74576 10.0167 9.97376C10.0005 10.2107 10 10.5204 10 11V13C10 13.4796 10.0005 13.7893 10.0167 14.0262C10.0323 14.2542 10.0589 14.3411 10.0761 14.3827C10.1776 14.6277 10.3723 14.8224 10.6173 14.9239C10.6589 14.9411 10.7458 14.9677 10.9738 14.9833C11.2107 14.9995 11.5204 15 12 15H13C13.5523 15 14 14.5523 14 14C14 13.4477 14.4477 13 15 13C15.5523 13 16 13.4477 16 14C16 15.6569 14.6569 17 13 17H11.968C11.5294 17 11.1509 17 10.8376 16.9787C10.5078 16.9561 10.1779 16.9066 9.85195 16.7716C9.11687 16.4672 8.53284 15.8831 8.22836 15.1481C8.09336 14.8221 8.04386 14.4922 8.02135 14.1624C7.99998 13.8491 7.99999 13.4706 8 13.032V10.968C7.99999 10.5294 7.99998 10.1509 8.02135 9.83762C8.04386 9.50779 8.09336 9.17788 8.22836 8.85195C8.53284 8.11687 9.11687 7.53284 9.85195 7.22836C10.1779 7.09336 10.5078 7.04386 10.8376 7.02135C11.1509 6.99998 11.5294 6.99999 11.968 7Z" fill="currentColor" />
    </svg>';
        }
    
        static function tag()
        {
            return 'span';
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
            return 'Dynamic Copyright';
        }
    
        static function className()
        {
            return 'dan-dynamic-copyright';
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
            return ['design' => ['general_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 32, 'unit' => 'px', 'style' => '32px']], 'advanced' => ['textTransform' => ['breakpoint_base' => 'uppercase']]]]]], 'prefix_typography' => ['color' => ['breakpoint_base' => '#24a0ff']]], 'content' => ['content' => ['prefix' => '©', 'suffix' => 'Dancepad', 'tag' => 'span']]];
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
          "General Typography",
          "general_typography",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Prefix Typography",
          "prefix_typography",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Year Typography",
          "year_typography",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Suffix Typography",
          "suffix_typography",
           ['type' => 'popout']
         )];
        }
    
        static function contentControls()
        {
            return [c(
            "content",
            "Content",
            [c(
            "prefix",
            "Prefix",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'textOptions' => ['multiline' => true, 'format' => 'plain'], 'autofocus' => true],
            false,
            false,
            [],
          ), c(
            "suffix",
            "Suffix",
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
          ), c(
            "link",
            "Link",
            [],
            ['type' => 'link', 'layout' => 'vertical'],
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
              '0' =>  ['title' => 'Dancepad - Dynamic Copyright','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Dynamic_Copyright/dancepad_dynamic_copyright.min.js?ver=' . DANCEPAD_VERSION],],
              '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_dynamic_copyright();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
              '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_dynamic_copyright();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
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
    
    'onPropertyChange' => [['script' => 'dancepad_dynamic_copyright();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_dynamic_copyright();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_dynamic_copyright();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_dynamic_copyright();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_dynamic_copyright();',
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
            return false;
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
            return [['accepts' => 'string', 'path' => 'content.content.prefix'], ['accepts' => 'string', 'path' => 'content.content.suffix']];
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
            return false;
        }
    
        static function propertyPathsToSsrElementWhenValueChanges()
        {
            return false;
        }
    }
}

