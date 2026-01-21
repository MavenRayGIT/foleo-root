<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_link_preview_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\LinkPreview",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class LinkPreview extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M12.1002 2.9982C12.1012 3.55048 11.6543 3.999 11.102 4C9.26069 4.00331 7.95244 4.02946 6.95832 4.19037C5.99343 4.34655 5.43598 4.61383 5.02517 5.02464C4.58291 5.4669 4.30569 6.08056 4.15584 7.19512C4.00213 8.33845 4 9.85009 4 11.9997C4 14.1494 4.00212 15.661 4.15584 16.8044C4.30569 17.9189 4.5829 18.5326 5.02516 18.9748C5.46742 19.4171 6.08108 19.6943 7.19564 19.8442C8.33897 19.9979 9.85061 20 12.0003 20C14.1499 20 15.6616 19.9979 16.8049 19.8442C17.9194 19.6943 18.5331 19.4171 18.9754 18.9748C19.3862 18.564 19.6534 18.0066 19.8096 17.0417C19.9705 16.0476 19.9967 14.7393 20 12.898C20.001 12.3457 20.4495 11.8988 21.0018 11.8998C21.5541 11.9008 22.001 12.3493 22 12.9016C21.9967 14.7099 21.9748 16.182 21.7839 17.3613C21.5883 18.5697 21.2001 19.5785 20.3896 20.3891C19.5138 21.2648 18.4077 21.6467 17.0714 21.8263C15.7793 22 14.1328 22 12.0744 22H11.9262C9.86771 22 8.22126 22 6.92915 21.8263C5.59281 21.6467 4.48675 21.2648 3.61095 20.389C2.73515 19.5133 2.35334 18.4072 2.17367 17.0709C1.99996 15.7787 1.99998 14.1323 2 12.0738L2 11.9257C1.99998 9.86718 1.99996 8.22073 2.17368 6.92862C2.35334 5.59229 2.73516 4.48623 3.61095 3.61043C4.4215 2.79988 5.43031 2.41167 6.63875 2.21607C7.81796 2.0252 9.29011 2.00326 11.0984 2C11.6507 1.99901 12.0992 2.44592 12.1002 2.9982Z" fill="currentColor" />
    <path d="M16.6278 2.05969C17.5062 2.00814 19.2561 1.93287 20.3023 2.11815C20.7322 2.19428 21.1066 2.40101 21.3861 2.69873L21.3948 2.70812C21.6424 2.97543 21.8141 3.31484 21.882 3.69821C22.067 4.74418 21.9919 6.49371 21.9404 7.37214C21.8724 8.53179 20.4836 9.007 19.698 8.22141L18.4671 6.99058L15.7317 9.70515C15.3334 10.1004 14.6901 10.098 14.2948 9.69967C13.8996 9.30138 13.902 8.65808 14.3003 8.26282L17.0302 5.55371L15.7786 4.3021C14.9931 3.51657 15.4682 2.12775 16.6278 2.05969Z" fill="currentColor" />
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
        return 'Link Preview';
    }

    static function className()
    {
        return 'dan-link-preview';
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
        return ['design' => ['size' => ['max_width' => ['breakpoint_base' => ['number' => 500, 'unit' => 'px', 'style' => '500px']]]], 'content' => ['link_text' => ['hover_color' => '#F5601BFF', 'hover_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'hover_css_easing' => 'ease'], 'link_image' => ['width' => ['number' => 200, 'unit' => 'px', 'style' => '200px'], 'height' => ['number' => null, 'unit' => 'auto', 'style' => 'auto'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'hover_bottom' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'fade_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'fade_css_easing' => 'ease', 'transform_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'transform_css_easing' => 'ease']]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []], ['slug' => 'EssentialElements\WrapperLink', 'defaultProperties' => ['content' => ['content' => ['url' => 'https://breakdance.com/', 'link' => ['type' => 'url', 'url' => 'https://dancepad.io', 'openInNewTab' => true]]], 'meta' => ['friendlyName' => 'Link'], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__wrapper']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'dancepad.io']], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__text']]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#3b8ff0'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => null, 'media' => null, 'media_dynamic_meta' => null, 'url' => 'https://dancepad.io/wp-content/uploads/2025/06/SCR-20250619-nhdt.png', 'alt_when_from_url' => null, 'custom_alt_when_from_url' => null]], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__image']]]], 'children' => []]]], ['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.']], 'settings' => ['advanced' => ['tag' => 'span']]], 'children' => []], ['slug' => 'EssentialElements\WrapperLink', 'defaultProperties' => ['content' => ['content' => ['url' => 'https://breakdance.com/', 'link' => ['type' => 'url', 'url' => 'https://dancepad.io', 'openInNewTab' => true]]], 'meta' => ['friendlyName' => 'Link'], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__wrapper']]]], 'children' => [['slug' => 'EssentialElements\Text', 'defaultProperties' => ['content' => ['content' => ['text' => 'dancepad.io']], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__text'], 'tag' => null]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#3b8ff0'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => null, 'media' => null, 'media_dynamic_meta' => null, 'url' => 'https://dancepad.io/wp-content/uploads/2025/06/SCR-20250619-nhdt.png', 'alt_when_from_url' => null, 'custom_alt_when_from_url' => null]], 'settings' => ['advanced' => ['classes' => ['dan-link-preview__image']]]], 'children' => []]]]];
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
     )];
    }

    static function contentControls()
    {
        return [c(
        "link_text",
        "Link Text",
        [c(
        "hover_color",
        "Hover Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hover_duration",
        "Hover Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "hover_css_easing",
        "Hover CSS Easing",
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
        "link_image",
        "Link Image",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "top",
        "Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bottom",
        "Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hover_top",
        "Hover Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "hover_bottom",
        "Hover Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "fade_duration",
        "Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "fade_css_easing",
        "Fade CSS Easing",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "transform_duration",
        "Transform Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "transform_css_easing",
        "Transform CSS Easing",
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
        return ["type" => "container",   ];
    }

    static function spacingBars()
    {
        return false;
    }

    static function attributes()
    {
        return [['name' => 'data-switch-title', 'template' => '{{ content.read_more_button.read_less_text }}'], ['name' => 'data-in-duration', 'template' => '{{ content.read_more_animation.in_duration.style }}'], ['name' => 'data-out-duration', 'template' => '{{ content.read_more_animation.out_duration.style }}'], ['name' => 'data-in-ease', 'template' => '{{ content.read_more_animation.in_gsap_easing }}'], ['name' => 'data-out-ease', 'template' => '{{ content.read_more_animation.out_gsap_easing }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.background.layers[].image']];
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