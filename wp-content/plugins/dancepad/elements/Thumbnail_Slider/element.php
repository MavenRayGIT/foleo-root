<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_thumbnail_slider_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ThumbnailSlider",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ThumbnailSlider extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
              <path opacity="0.4" d="M12.0514 2.25C13.1349 2.24998 14.0204 2.24996 14.7195 2.34822C15.4502 2.45093 16.0838 2.67321 16.5895 3.2019C17.0952 3.7306 17.3078 4.39293 17.4061 5.15689C17.5 5.88775 17.5 6.81348 17.5 7.94631V16.0537C17.5 17.1865 17.5 18.1123 17.4061 18.8431C17.3078 19.6071 17.0952 20.2694 16.5895 20.7981C16.0838 21.3268 15.4502 21.5491 14.7195 21.6518C14.0204 21.75 13.1349 21.75 12.0514 21.75H12.0514H11.9486H11.9486C10.8651 21.75 9.97958 21.75 9.2805 21.6518C8.54976 21.5491 7.91622 21.3268 7.41052 20.7981C6.90481 20.2694 6.69219 19.6071 6.59395 18.8431C6.49996 18.1123 6.49998 17.1865 6.5 16.0537V16.0537V7.94631V7.94629C6.49998 6.81346 6.49996 5.88774 6.59395 5.15689C6.69219 4.39293 6.90481 3.7306 7.41052 3.2019C7.91622 2.67321 8.54976 2.45093 9.2805 2.34822C9.97958 2.24996 10.8651 2.24998 11.9486 2.25H11.9486H12.0514H12.0514Z" fill="currentColor" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M1.26782 6.81229C1.37146 6.26982 1.89523 5.91407 2.43771 6.0177C3.11726 6.14752 3.73107 6.40163 4.23435 6.91859C4.81242 7.51237 5.04466 8.24703 5.15007 9.0524C5.25013 9.81685 5.2501 10.7794 5.25006 11.9325V12.0674C5.2501 13.2204 5.25013 14.183 5.15007 14.9475C5.04466 15.7529 4.81242 16.4875 4.23435 17.0813C3.73107 17.5982 3.11726 17.8524 2.43771 17.9822C1.89523 18.0858 1.37146 17.7301 1.26782 17.1876C1.16419 16.6451 1.51994 16.1213 2.06242 16.0177C2.47681 15.9385 2.66809 15.823 2.8013 15.6862C2.95547 15.5278 3.08935 15.2811 3.16699 14.6879C3.24805 14.0686 3.25006 13.238 3.25006 11.9999C3.25006 10.7618 3.24805 9.93125 3.16699 9.31197C3.08935 8.71876 2.95547 8.47207 2.8013 8.31371C2.66809 8.17688 2.47681 8.06134 2.06242 7.98218C1.51994 7.87854 1.16419 7.35477 1.26782 6.81229Z" fill="currentColor" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M22.7319 6.81254C22.6283 6.27006 22.1045 5.91431 21.562 6.01795C20.8825 6.14777 20.2687 6.40187 19.7654 6.91883C19.1873 7.51262 18.9551 8.24727 18.8497 9.05265C18.7496 9.81709 18.7497 10.7797 18.7497 11.9328V12.0676C18.7497 13.2207 18.7496 14.1833 18.8497 14.9477C18.9551 15.7531 19.1873 16.4878 19.7654 17.0815C20.2687 17.5985 20.8825 17.8526 21.562 17.9824C22.1045 18.0861 22.6283 17.7303 22.7319 17.1878C22.8356 16.6454 22.4798 16.1216 21.9373 16.0179C21.523 15.9388 21.3317 15.8232 21.1985 15.6864C21.0443 15.5281 20.9104 15.2814 20.8328 14.6882C20.7517 14.0689 20.7497 13.2383 20.7497 12.0002C20.7497 10.7621 20.7517 9.9315 20.8328 9.31221C20.9104 8.719 21.0443 8.47231 21.1985 8.31396C21.3317 8.17712 21.5229 8.06158 21.9373 7.98242C22.4798 7.87879 22.8356 7.35501 22.7319 6.81254Z" fill="currentColor" />
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
        return 'Thumbnail Slider';
    }

    static function className()
    {
        return 'dan-thumbnail-slider';
    }

    static function category()
    {
        return 'dancepad_sliders';
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
        return ['design' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 800, 'unit' => 'px', 'style' => '800px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']], 'max_height' => ['breakpoint_base' => null]], 'slides_container' => ['height' => ['number' => 500, 'unit' => 'px', 'style' => '500px'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'topRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomLeft' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottomRight' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#191919', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#191919', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#191919', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#191919', 'style' => 'solid']]]]], 'thumbnails_container' => ['margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 7, 'unit' => 'px', 'style' => '7px'], 'right' => ['number' => 7, 'unit' => 'px', 'style' => '7px'], 'top' => ['number' => 7, 'unit' => 'px', 'style' => '7px'], 'bottom' => ['number' => 7, 'unit' => 'px', 'style' => '7px']]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 'fit-content', 'unit' => 'custom', 'style' => 'fit-content']], 'max_width' => ['breakpoint_base' => ['number' => 350, 'unit' => 'px', 'style' => '350px']]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 4, 'unit' => 'px', 'style' => '4px']]], 'background' => ['color' => ['breakpoint_base' => '#171717']], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]], 'morphing_selector' => ['zindex' => 9999, 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#ffffff', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#ffffff', 'style' => 'solid'], 'left' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#ffffff', 'style' => 'solid'], 'right' => ['width' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'color' => '#ffffff', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]]], 'thumbnail' => ['size' => ['width' => ['breakpoint_base' => ['number' => 90, 'unit' => 'px', 'style' => '90px']], 'height' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]], 'border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#444', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#444', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#444', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#444', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'topRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomLeft' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'bottomRight' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'editMode' => 'all']]], 'brightness' => 50, 'filter_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'filter_css_easing' => 'ease', 'width' => ['number' => 90, 'unit' => 'px', 'style' => '90px'], 'height' => ['number' => 50, 'unit' => 'px', 'style' => '50px']], 'arrows' => ['display' => 'flex', 'zindex' => 10, 'fill' => '#ffffff', 'dimensions' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'background' => 'rgba(0, 0, 0, 0.5)', 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'topRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomLeft' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'bottomRight' => ['number' => 50, 'unit' => '%', 'style' => '50%'], 'editMode' => 'all']]], 'arrow_left_position' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'arrow_right_position' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'content' => ['scroll_animation' => ['gsap_easing' => 'expo', 'duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s']], 'selector_animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'gsap_easing' => 'expo']]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/14-1-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb', 'dan-thumbnail-slider__thumb--active'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/24-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/74-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/46-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/83-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/80-scaled.jpg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []], ['slug' => 'EssentialElements\Image2', 'defaultProperties' => ['content' => ['image' => ['from' => 'url', 'lazy_load' => false, 'alt' => 'from_media_library', 'url' => 'https://oxyfolio.com/wp-content/uploads/2025/04/16-gigapixel-standard20v2-7680w-scaled.jpeg']], 'meta' => ['friendlyName' => 'Slide'], 'settings' => ['advanced' => ['classes' => ['dan-thumbnail-slider__thumb'], 'attributes' => [['name' => 'tabindex', 'value' => '0']]]]], 'children' => []]];
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
     ), c(
        "slides_container",
        "Slides Container",
        [c(
        "height",
        "Height",
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
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "thumbnails_container",
        "Thumbnails Container",
        [getPresetSection(
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
      "EssentialElements\\layout",
      "Layout",
      "layout",
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
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "morphing_selector",
        "Morphing Selector",
        [c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
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
        "thumbnail",
        "Thumbnail",
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
      ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "brightness",
        "Brightness",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "filter_duration",
        "Filter Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "filter_css_easing",
        "Filter CSS Easing",
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
      ), c(
        "arrows",
        "Arrows",
        [c(
        "display",
        "Display",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'flex', 'text' => 'flex'], ['text' => 'none', 'value' => 'none']]],
        false,
        false,
        [],
      ), c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "dimensions",
        "Dimensions",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "fill",
        "Fill",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
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
     ), c(
        "arrow_left_position",
        "Arrow Left Position",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "arrow_right_position",
        "Arrow Right Position",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
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
        "scroll_animation",
        "Scroll Animation",
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
      ), c(
        "selector_animation",
        "Selector Animation",
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
                'title' => 'Dancepad - Thumbnail Slider',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Thumbnail_Slider/dancepad_thumbnail_slider.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_thumbnail_slider();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_thumbnail_slider();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
            ],
            '4' => [
                'title' => 'GSAP ScrollTo',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/dancepad_gsap_scroll_to.min.js?ver=' . DANCEPAD_VERSION],
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

'onPropertyChange' => [['script' => 'dancepad_thumbnail_slider();',
],],

'onCreatedElement' => [['script' => 'dancepad_thumbnail_slider();',
],],

'onMountedElement' => [['script' => 'dancepad_thumbnail_slider();',
],],

'onMovedElement' => [['script' => 'dancepad_thumbnail_slider();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_thumbnail_slider();',
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
        return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-scroll-duration', 'template' => '{{ content.scroll_animation.duration.style }}'], ['name' => 'data-scroll-ease', 'template' => '{{ content.scroll_animation.gsap_easing }}'], ['name' => 'data-selector-duration', 'template' => '{{ content.selector_animation.duration.style }}'], ['name' => 'data-selector-ease', 'template' => '{{ content.selector_animation.gsap_easing }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.thumbnails_container.background.layers[].image']];
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