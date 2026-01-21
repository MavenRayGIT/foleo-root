<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_looping_tabs_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\LoopingTabsNavItem",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class LoopingTabsNavItem extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return 'SquareIcon';
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
            return 'Looping Tabs Nav Item';
        }
    
        static function className()
        {
            return 'dan-looping-tabs__nav-item';
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
            return false;
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
            return [c(
            "progress_gradient",
            "Progress Gradient",
            [c(
            "gradient_first_color",
            "Gradient First Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "gradient_second_color",
            "Gradient Second Color",
            [],
            ['type' => 'color', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "degree",
            "Degree",
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
          ), getPresetSection(
          "EssentialElements\\spacing_padding_all",
          "Padding",
          "padding",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\layout",
          "Layout",
          "layout",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
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
            "active",
            "Active",
            [getPresetSection(
          "EssentialElements\\typography_with_effects_and_align_with_hoverable_everything",
          "Typography",
          "typography",
           ['type' => 'popout']
         ), getPresetSection(
          "EssentialElements\\background",
          "Background",
          "background",
           ['type' => 'popout']
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
            "CSS Easing",
            [],
            ['type' => 'text', 'layout' => 'vertical'],
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
            return false;
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
            return false;
        }
    
        static function nestingRule()
        {
            return ["type" => "container",  "restrictedToBeADescendantOf" => ['Dancepad\LoopingTabs'], ];
        }
    
        static function spacingBars()
        {
            return false;
        }
    
        static function attributes()
        {
            return [['name' => 'tabindex', 'template' => '0']];
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
            return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.new_section.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.active_styles.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.progress_gradient.background.layers[].image']];
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
            return ['content.content.text', 'design.layout_v2.layout', 'design.layout_v2.h_vertical_at', 'design.layout_v2.h_alignment_when_vertical', 'design.layout_v2.a_display', 'design.progress_gradient.background.image', 'design.progress_gradient.background.overlay.image', 'design.progress_gradient.background.image_settings.unset_image_at', 'design.progress_gradient.background.image_settings.size', 'design.progress_gradient.background.image_settings.height', 'design.progress_gradient.background.image_settings.repeat', 'design.progress_gradient.background.image_settings.position', 'design.progress_gradient.background.image_settings.left', 'design.progress_gradient.background.image_settings.top', 'design.progress_gradient.background.image_settings.attachment', 'design.progress_gradient.background.image_settings.custom_position', 'design.progress_gradient.background.image_settings.width', 'design.progress_gradient.background.overlay.image_settings.custom_position', 'design.progress_gradient.background.image_size', 'design.progress_gradient.background.overlay.image_size', 'design.progress_gradient.background.overlay.type', 'design.progress_gradient.background.design.layout.horizontal.vertical_at', 'design.progress_gradient.background.image_settings', 'design.progress_gradient.background.type'];
        }
    
        static function propertyPathsToSsrElementWhenValueChanges()
        {
            return false;
        }
    } 
}