<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_distorsion_tabs_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\DistorsionTabs",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
  );
  class DistorsionTabs extends \Breakdance\Elements\Element
  {
      static function uiIcon()
      {
          return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M2.125 1C2.67728 1 3.125 1.44772 3.125 2V22C3.125 22.5523 2.67728 23 2.125 23C1.57272 23 1.125 22.5523 1.125 22V2C1.125 1.44772 1.57272 1 2.125 1Z" fill="currentColor" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M14.125 1C14.6773 1 15.125 1.44772 15.125 2V22C15.125 22.5523 14.6773 23 14.125 23C13.5727 23 13.125 22.5523 13.125 22V2C13.125 1.44772 13.5727 1 14.125 1Z" fill="currentColor" />
          <path opacity="0.4" d="M19.4418 7.2515C19.507 7.25214 19.5684 7.25275 19.625 7.25275C19.6816 7.25275 19.743 7.25214 19.8082 7.2515C20.1643 7.24799 20.6333 7.24336 21.0602 7.33032C21.6134 7.44299 22.1958 7.72349 22.5736 8.37775C22.7509 8.68496 22.817 9.01092 22.8468 9.3401C22.875 9.65139 22.875 10.0307 22.875 10.4705V13.535C22.875 13.9748 22.875 14.3541 22.8468 14.6654C22.817 14.9946 22.7509 15.3205 22.5736 15.6278C22.1958 16.282 21.6134 16.5625 21.0602 16.6752C20.6333 16.7621 20.1643 16.7575 19.8082 16.754H19.8081C19.743 16.7534 19.6816 16.7528 19.625 16.7528C19.5684 16.7528 19.507 16.7534 19.4419 16.754H19.4418C19.0857 16.7575 18.6167 16.7621 18.1898 16.6752C17.6366 16.5625 17.0542 16.282 16.6764 15.6278C16.4991 15.3205 16.433 14.9946 16.4032 14.6654C16.375 14.3541 16.375 13.9748 16.375 13.535V13.535V10.4705V10.4705C16.375 10.0307 16.375 9.65139 16.4032 9.3401C16.433 9.01092 16.4991 8.68496 16.6764 8.37775C17.0542 7.72349 17.6366 7.44299 18.1898 7.33032C18.6167 7.24336 19.0857 7.24799 19.4418 7.2515Z" fill="currentColor" />
          <path opacity="0.4" d="M9.06023 4.33032C9.61343 4.44299 10.1958 4.72349 10.5736 5.37775C10.7509 5.68496 10.817 6.01092 10.8468 6.3401C10.875 6.65139 10.875 7.03074 10.875 7.47052L10.875 16.535C10.875 16.9748 10.875 17.3541 10.8468 17.6654C10.817 17.9946 10.7509 18.3205 10.5736 18.6278C10.1958 19.282 9.61343 19.5625 9.06023 19.6752C8.63327 19.7621 8.16425 19.7575 7.80818 19.754H7.80814C7.743 19.7534 7.68164 19.7528 7.625 19.7528C7.56837 19.7528 7.50701 19.7534 7.44186 19.754H7.44182C7.08575 19.7575 6.61673 19.7621 6.18977 19.6752C5.63658 19.5625 5.05418 19.282 4.67645 18.6278C4.49908 18.3205 4.43302 17.9946 4.40318 17.6654C4.37497 17.3541 4.37498 16.9748 4.375 16.535V16.535V7.47052V7.47049C4.37498 7.03072 4.37497 6.65139 4.40318 6.3401C4.43302 6.01092 4.49907 5.68496 4.67644 5.37775C5.05418 4.72349 5.63658 4.44299 6.18977 4.33032C6.61673 4.24336 7.08575 4.24799 7.44182 4.2515C7.50698 4.25214 7.56836 4.25275 7.625 4.25275C7.68165 4.25275 7.74302 4.25214 7.80819 4.2515C8.16425 4.24799 8.63327 4.24336 9.06023 4.33032Z" fill="currentColor" />
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
          return 'Distorsion Tabs';
      }
  
      static function className()
      {
          return 'dan-distorsion-tabs';
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
          return ['design' => ['tabs_element_dimensions' => ['width' => ['number' => 250, 'unit' => 'px', 'style' => '250px'], 'height' => ['number' => 250, 'unit' => 'px', 'style' => '250px']], 'size' => ['width' => null, 'min_height' => null], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'align_items' => ['breakpoint_base' => 'center'], 'justify_content' => ['breakpoint_base' => 'center'], 'gap' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]]], 'content' => ['tabs' => ['active_tab' => 1, 'event' => 'hover'], 'distorsion_animation' => ['duration' => ['number' => 1.2, 'unit' => 's', 'style' => '1.2s'], 'gsap_easing' => 'expo'], 'nav_items_fade_animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'css_easing' => 'ease', 'opacity' => 0.3]]];
      }
  
      static function defaultChildren()
      {
          return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__nav']]], 'design' => ['layout_v2' => ['layout' => 'vertical', 'v_align' => null, 'v_gap' => ['breakpoint_base' => ['number' => 5, 'unit' => 'px', 'style' => '5px']]]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav Item'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__nav-item'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Fast', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav Item'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__nav-item'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Easy', 'tags' => 'h3']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Nav Item'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__nav-item'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Nice', 'tags' => 'h3']]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tabs'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__tabs'], 'attributes' => [['name' => 'style', 'value' => 'filter:url(#svg-distortion-filter)']]]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tab'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_1.webp']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tab'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_2.webp']]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Tab'], 'settings' => ['advanced' => ['classes' => ['dan-distorsion-tabs__tab']]]], 'children' => [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => true, 'alt' => 'from_media_library', 'url' => 'https://nextbricks.io/wp-content/uploads/2024/09/cursor_slide_3.webp']]], 'children' => []]]]]]];
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
       ), c(
          "tabs_element_dimensions",
          "Tabs element dimensions",
          [c(
          "note",
          "Note",
          [],
          ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Each Tab has an absolute position required for the distorsion animation to work properly. So you should give defined dimensions to Tabs.</p>']],
          false,
          false,
          [],
        ), c(
          "width",
          "Width",
          [],
          ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'vw', 'custom']]],
          true,
          false,
          [],
        ), c(
          "height",
          "Height",
          [],
          ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['px', 'em', 'rem', '%', 'custom', 'vh']]],
          true,
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
          "tabs",
          "Tabs",
          [c(
          "active_tab",
          "Active Tab",
          [],
          ['type' => 'number', 'layout' => 'inline'],
          false,
          false,
          [],
        ), c(
          "event",
          "Event",
          [],
          ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'hover', 'text' => 'Hover'], ['text' => 'Click', 'value' => 'click']]],
          false,
          false,
          [],
        )],
          ['type' => 'section', 'layout' => 'vertical'],
          false,
          false,
          [],
        ), c(
          "distorsion_animation",
          "Distorsion Animation",
          [c(
          "duration",
          "Duration",
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
          "nav_items_fade_animation",
          "Nav Items Fade Animation",
          [c(
          "opacity",
          "Opacity",
          [],
          ['type' => 'number', 'layout' => 'inline'],
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
            '0' =>  ['title' => 'Dancepad - Distorsion Tabs','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Distorsion_Tabs/dancepad_distorsion_tabs.min.js?ver=' . DANCEPAD_VERSION],],
            '1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_distorsion_tabs();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],
            '2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_distorsion_tabs();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],
            '3' =>  ['title' => 'GSAP','scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],]
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
  
  'onPropertyChange' => [['script' => 'dancepad_distorsion_tabs();',
  ],],
  
  'onCreatedElement' => [['script' => 'dancepad_distorsion_tabs();',
  ],],
  
  'onMountedElement' => [['script' => 'dancepad_distorsion_tabs();',
  ],],
  
  'onMovedElement' => [['script' => 'dancepad_distorsion_tabs();',
  ],],
  
  'onAfterDeletedElement' => [['script' => 'dancepad_distorsion_tabs();',
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
          return [['name' => 'data-duration', 'template' => '{{ content.distorsion_animation.duration.style }}'], ['name' => 'data-ease', 'template' => '{{ content.distorsion_animation.gsap_easing }}'], ['name' => 'data-event', 'template' => '{{ content.tabs.event }}'], ['name' => 'data-activetab', 'template' => '{{ content.tabs.active_tab }}']];
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
          return [];
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
