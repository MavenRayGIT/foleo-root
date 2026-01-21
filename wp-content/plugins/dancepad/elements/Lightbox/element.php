<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


if(get_option('dan_lightbox_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\Lightbox",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class Lightbox extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M21.8758 2.62441C21.2911 2.1554 20.4989 2.21117 19.78 2.34287C19.0182 2.48243 18.0153 2.7793 16.7593 3.15107L16.7119 3.1651C13.6387 4.07475 10.3613 4.07475 7.28809 3.1651L7.24069 3.15107C5.98473 2.7793 4.98179 2.48243 4.21999 2.34287C3.50106 2.21117 2.70886 2.1554 2.12418 2.62441C1.5749 3.06504 1.40543 3.76696 1.32873 4.46038C1.24997 5.17245 1.24999 6.12288 1.25 7.30355V16.6969C1.24999 17.8776 1.24997 18.828 1.32873 19.5401C1.40543 20.2335 1.5749 20.9354 2.12418 21.376C2.70886 21.8451 3.50106 21.7893 4.21999 21.6576C4.25748 21.6507 4.29555 21.6435 4.33421 21.6358C4.42447 21.6181 4.46961 21.6092 4.51148 21.5856C4.55334 21.5621 4.58566 21.5268 4.65028 21.4562L6.45568 19.4835C6.70641 19.2194 6.9617 18.9469 7.2216 18.6693C8.95935 16.8131 10.907 14.7328 13.1275 13.4704C14.4259 12.7322 15.851 12.2504 17.419 12.25C18.9898 12.2496 20.6438 12.7325 22.3971 13.8282L22.4025 13.8316C22.553 13.9274 22.75 13.8193 22.75 13.6409V7.30355C22.75 6.12288 22.75 5.17244 22.6713 4.46038C22.5946 3.76696 22.4251 3.06504 21.8758 2.62441Z" fill="currentColor" />
    <path d="M22.75 16.1604C22.75 15.9993 22.75 15.9188 22.713 15.8514C22.676 15.784 22.6081 15.7407 22.4722 15.6542L21.6022 15.1003L21.5995 15.0986C20.0452 14.1279 18.664 13.7497 17.4193 13.75C16.1711 13.7503 14.9999 14.1313 13.8688 14.7744C11.8631 15.9146 10.0897 17.8053 8.33298 19.6782C8.07129 19.9572 7.80998 20.2358 7.54832 20.5114C7.49298 20.5722 7.46531 20.6026 7.4586 20.6192C7.43324 20.682 7.47447 20.7498 7.5419 20.7562C7.55974 20.7579 7.60004 20.7472 7.68065 20.7257C10.6295 19.9405 13.7848 19.969 16.7119 20.8354L16.7593 20.8494C18.0152 21.2211 19.0182 21.518 19.78 21.6576C20.4989 21.7893 21.2911 21.8451 21.8758 21.376C22.4251 20.9354 22.5946 20.2335 22.6712 19.5401C22.75 18.828 22.75 17.8776 22.75 16.6969V16.1604Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 8.5C5.5 7.39543 6.39543 6.5 7.5 6.5C8.60457 6.5 9.5 7.39543 9.5 8.5C9.5 9.60457 8.60457 10.5 7.5 10.5C6.39543 10.5 5.5 9.60457 5.5 8.5Z" fill="currentColor" />
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
        return 'Lightbox';
    }

    static function className()
    {
        return 'dan-lightbox';
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
        return ['content' => ['lightbox_images' => ['repeater' => [['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1609342122563-a43ac8917a3a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<p>&lt;p&gt;Location - &lt;a href=\'https://unsplash.com/s/photos/puezgruppe%2C-wolkenstein-in-gr%C3%B6den%2C-s%C3%BCdtirol%2C-italien\'&gt;Puezgruppe, Wolkenstein in Gröden, Südtirol, Italien&lt;/a&gt;layers of blue.&lt;/p&gt;</p>
<p> </p>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1608481337062-4093bf3ed404?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Location - &lt;a href=\'https://unsplash.com/s/photos/tre-cime-di-lavaredo%2C-italia\'&gt;Tre Cime di Lavaredo, Italia&lt;/a&gt;This is the Way&lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1605973029521-8154da591bd7?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Location - &lt;a href=\'https://unsplash.com/s/photos/pizol%2C-mels%2C-schweiz\'&gt;Pizol, Mels, Schweiz&lt;/a&gt;&lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1526281216101-e55f00f0db7a?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Foggy Road&lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1418065460487-3e41a6c84dc5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Misty shroud over a forest&lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1505820013142-f86a3439c5b2?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Location - &lt;a href=\'Bled, Slovenia\'&gt;Bled, Slovenia&lt;/a&gt; &lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1477322524744-0eece9e79640?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Location - &lt;a href=\'Bled, Slovenia\'&gt;Bled, Slovenia&lt;/a&gt; Wooded lake island &lt;/p&gt;</div>
</div>'], ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80', 'alt' => '', 'caption' => ''], 'description' => '<div>
<div>&lt;p&gt;Location - &lt;a href=\'https://unsplash.com/s/photos/ciuca%C8%99-peak%2C-romania\'&gt;Ciucaș Peak, Romania&lt;/a&gt; Alone in the unspoilt wilderness &lt;/p&gt;</div>
</div>']]], 'animations' => ['lightbox_speed' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'lightbox_open_duration' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'backdrop_duration' => ['number' => 300, 'unit' => 'ms', 'style' => '300ms'], 'slide_animation' => 'lg-slide', 'slide_css_easing' => 'ease', 'enable_loop' => true, 'initial_image_0_to_show_selected_' => 0, 'enable_thumbnails' => true, 'thumbnail_height' => ['number' => 180, 'unit' => 'px', 'style' => '180px'], 'gap_between_thumbnails' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'enable_zoom' => true, 'enable_rotate' => true, 'rotate_speed' => ['number' => 400, 'unit' => 'ms', 'style' => '400ms'], 'enable_fullscreen' => true, 'enable_autoplay' => true, 'display_progress_bar' => true, 'slideshow_interval' => ['number' => 5000, 'unit' => 'ms', 'style' => '5000ms'], 'display_controls' => true, 'display_counter' => true, 'display_download_button' => true, 'display_close_icon' => true, 'closable' => true, 'close_on_tap' => true, 'close_on_esc' => true, 'enable_mousewheel' => true, 'enable_drag_on_desktop' => true, 'enable_swipe_on_mobile' => true]], 'design' => ['layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]], 'list_item' => ['size' => ['width' => ['breakpoint_base' => ['number' => 240, 'unit' => 'px', 'style' => '240px']], 'height' => ['breakpoint_base' => ['number' => 'fit-content', 'unit' => 'custom', 'style' => 'fit-content']]]], 'lightbox' => ['zindex' => 9999, 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'background' => '#00000090'], 'toolbar' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'icons' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'left' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'right' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'color' => '#fff', 'weight' => '400', 'size' => ['number' => 24, 'unit' => 'px', 'style' => '24px']], 'counter' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => null]]], 'color' => ['breakpoint_base' => '#fff']]], 'arrows' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'size' => ['number' => 22, 'unit' => 'px', 'style' => '22px'], 'weight' => '400', 'color' => '#fff'], 'description' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'right' => ['number' => 40, 'unit' => 'px', 'style' => '40px']]]], 'typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]], 'text_align' => ['breakpoint_base' => 'center'], 'color' => ['breakpoint_base' => '#fff']]], 'thumbnails' => ['active_border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid']]]]], 'progress' => ['color' => '#1582e8', 'path_color' => '#000', 'height' => ['number' => 3, 'unit' => 'px', 'style' => '3px']]]];
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
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     ), c(
        "list_item",
        "List Item",
        [getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "lightbox",
        "Lightbox",
        [c(
        "zindex",
        "zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "blur",
        "Blur",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
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
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "toolbar",
        "Toolbar",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
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
      ), c(
        "icons",
        "Icons",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "weight",
        "Weight",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => '100', 'text' => '100'], ['text' => '200', 'value' => '200'], ['text' => '300', 'value' => '300'], ['text' => '400', 'value' => '400'], ['text' => '500', 'value' => '500'], ['text' => '600', 'value' => '600'], ['text' => '700', 'value' => '700'], ['text' => '800', 'value' => '800'], ['text' => '900', 'value' => '900']]],
        false,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "counter",
        "Counter",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Typography",
      "typography",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "arrows",
        "Arrows",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "color",
        "Color",
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
      ), c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "weight",
        "Weight",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => '100', 'text' => '100'], ['text' => '200', 'value' => '200'], ['text' => '300', 'value' => '300'], ['text' => '400', 'value' => '400'], ['text' => '500', 'value' => '500'], ['text' => '600', 'value' => '600'], ['text' => '700', 'value' => '700'], ['text' => '800', 'value' => '800'], ['text' => '900', 'value' => '900']]],
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
        "description",
        "Description",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align",
      "Typography",
      "typography",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "thumbnails",
        "Thumbnails",
        [getPresetSection(
      "EssentialElements\\background",
      "Container Background",
      "container_background",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Active Border",
      "active_border",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "progress",
        "Progress",
        [c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_color",
        "Path color",
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
        "lightbox_images",
        "Lightbox Images",
        [c(
        "repeater",
        "Repeater",
        [c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "description",
        "Description",
        [],
        ['type' => 'richtext', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'repeater', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "animations",
        "Animations",
        [c(
        "lightbox_speed",
        "Lightbox speed",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']]],
        false,
        false,
        [],
      ), c(
        "lightbox_open_duration",
        "Lightbox open duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']]],
        false,
        false,
        [],
      ), c(
        "backdrop_duration",
        "Backdrop duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']]],
        false,
        false,
        [],
      ), c(
        "slide_animation",
        "Slide animation",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'lg-slide', 'text' => 'Slide'], ['text' => 'Fade', 'value' => 'lg-fade'], ['text' => 'Zoom In', 'value' => 'lg-zoom-in'], ['value' => 'lg-zoom-in-big', 'text' => 'Zoom In Big'], ['text' => 'Zoom Out', 'value' => 'lg-zoom-out'], ['text' => 'Zoom Out Big', 'value' => 'lg-zoom-out-big'], ['value' => 'lg-zoom-out-in', 'text' => 'Zoom Out In'], ['text' => 'Zoom In Out', 'value' => 'lg-zoom-in-out'], ['value' => 'lg-soft-zoom', 'text' => 'Soft Zoom'], ['text' => 'Scale Up', 'value' => 'lg-scale-up'], ['value' => 'lg-slide-circular', 'text' => 'Slide Circular'], ['value' => 'lg-slide-circular-vertical', 'text' => 'Slide Circular Vertical'], ['value' => 'lg-slide-vertical', 'text' => 'Slide Vertical'], ['value' => 'lg-slide-vertical-growth', 'text' => 'Slide Vertical Growth'], ['value' => 'lg-slide-skew-only', 'text' => 'Slide Skew Only'], ['value' => 'lg-slide-skew-only-rev', 'text' => 'Slide Skew Only Reverse'], ['value' => 'lg-slide-skew-only-y', 'text' => 'Slide Skew Only Y'], ['value' => 'lg-slide-skew-only-y-reverse', 'text' => 'Slide Skew Only Y Reverse'], ['value' => 'lg-slide-skew', 'text' => 'Slide Skew'], ['value' => 'lg-slide-skew-rev', 'text' => 'Slide Skew Reverse'], ['value' => 'lg-slide-skew-cross', 'text' => 'Slide Skew Cross'], ['value' => 'lg-slide-skew-cross-reverse', 'text' => 'Slide Skew Cross Reverse'], ['value' => 'lg-slide-skew-ver', 'text' => 'Slide Skew Vertical'], ['value' => 'lg-slide-skew-ver-rev', 'text' => 'Slide Skew Vertical Reverse'], ['value' => 'lg-slide-skew-ver-cross', 'text' => 'Slide Skew Vertical Cross'], ['value' => 'lg-slide-skew-ver-cross-rev', 'text' => 'Slide Skew Vertical Cross Reverse'], ['value' => 'lg-lollipop', 'text' => 'Lollipop'], ['value' => 'lg-lollipop-rev', 'text' => 'Lollipop Reverse'], ['value' => 'lg-rotate', 'text' => 'Rotate'], ['value' => 'lg-rotate-rev', 'text' => 'Rotate Reverse'], ['text' => 'Tube', 'value' => 'lg-tube']]],
        false,
        false,
        [],
      ), c(
        "slide_css_easing",
        "Slide CSS Easing",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "initial_image_0_to_show_selected_",
        "Initial Image (0 to show selected)",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_loop",
        "Enable Loop",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_zoom",
        "Enable Zoom",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_thumbnails",
        "Enable Thumbnails",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "thumbnail_height",
        "Thumbnail Height",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.enable_thumbnails', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "gap_between_thumbnails",
        "Gap between Thumbnails",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.enable_thumbnails', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_rotate",
        "Enable Rotate",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "rotate_speed",
        "Rotate Speed",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['ms']], 'condition' => [[['path' => 'content.animations.enable_rotate', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "enable_fullscreen",
        "Enable Fullscreen",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_autoplay",
        "Enable Autoplay",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "force_slideshow_autoplay",
        "Force Slideshow Autoplay",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.enable_autoplay', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "display_progress_bar",
        "Display Progress bar",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.enable_autoplay', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "slideshow_interval",
        "Slideshow Interval",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.enable_autoplay', 'operand' => 'is set', 'value' => '']]], 'unitOptions' => ['types' => ['ms']]],
        false,
        false,
        [],
      ), c(
        "display_controls",
        "Display Controls",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "display_counter",
        "Display Counter",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "display_download_button",
        "Display Download Button",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "closable",
        "Closable",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "display_close_icon",
        "Display Close Icon",
        [],
        ['type' => 'toggle', 'layout' => 'inline', 'condition' => [[['path' => 'content.animations.closable', 'operand' => 'is set', 'value' => '']]]],
        false,
        false,
        [],
      ), c(
        "close_on_tap",
        "Close on Tap",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "close_on_esc",
        "Close on ESC",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_mousewheel",
        "Enable mousewheel",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_drag_on_desktop",
        "Enable drag on desktop",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "enable_swipe_on_mobile",
        "Enable swipe on mobile",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
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
                'title' => 'Dancepad - Lightbox',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Lightbox/dancepad_lightbox.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_lightbox();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_lightbox();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'Lightgallery',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '4' => [
                'title' => 'Lightgallery Autoplay',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery-autoplay.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '5' => [
                'title' => 'Lightgallery Fullscreen',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery-fullscreen.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '6' => [
                'title' => 'Lightgallery Rotate',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery-rotate.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '7' => [
                'title' => 'Lightgallery Thumbnail',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery-thumbnail.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '8' => [
                'title' => 'Lightgallery Zoom',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'local_assets/lightgallery/lightgallery-zoom.min.js?ver=' . DANCEPAD_VERSION],
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

'onPropertyChange' => [['script' => 'dancepad_lightbox();',
],],

'onCreatedElement' => [['script' => 'dancepad_lightbox();',
],],

'onMountedElement' => [['script' => 'dancepad_lightbox();',
],],

'onMovedElement' => [['script' => 'dancepad_lightbox();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_lightbox();',
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
        return [['name' => 'data-speed', 'template' => '{{ content.animations.lightbox_speed.style }}'], ['name' => 'data-start-animation-duration', 'template' => '{{ content.animations.lightbox_open_duration.style }}'], ['name' => 'data-backdrop-duration', 'template' => '{{ content.animations.backdrop_duration.style }}'], ['name' => 'data-mode', 'template' => '{{ content.animations.slide_animation }}'], ['name' => 'data-easing', 'template' => '{{ content.animations.slide_css_easing }}'], ['name' => 'data-index', 'template' => '{{ content.animations.initial_image_0_to_show_selected_ }}'], ['name' => 'data-loop', 'template' => '{% if content.animations.enable_loop %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-zoom', 'template' => '{% if content.animations.enable_zoom %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-thumbnail', 'template' => '{% if content.animations.enable_thumbnails %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-thumb-height', 'template' => '{{ content.animations.thumbnail_height.style }}'], ['name' => 'data-thumb-margin', 'template' => '{{ content.animations.gap_between_thumbnails.style }}'], ['name' => 'data-rotate', 'template' => '{% if content.animations.enable_rotate %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-rotate-speed', 'template' => '{{ content.animations.rotate_speed.style }}'], ['name' => 'data-fullscreen', 'template' => '{% if content.animations.enable_fullscreen %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-autoplay', 'template' => '{% if content.animations.enable_autoplay %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-force-slide-show-autoplay', 'template' => '{% if content.animations.force_slideshow_autoplay %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-progress-bar', 'template' => '{% if content.animations.display_progress_bar %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-slide-show-interval', 'template' => '{{ content.animations.slideshow_interval.style }}'], ['name' => 'data-controls', 'template' => '{% if content.animations.display_controls %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-counter', 'template' => '{% if content.animations.display_counter %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-download', 'template' => '{% if content.animations.display_download_button %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-show-close-icon', 'template' => '{% if content.animations.display_close_icon %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-closable', 'template' => '{% if content.animations.closable %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-close-on-tap', 'template' => '{% if content.animations.close_on_tap %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-esc-key', 'template' => '{% if content.animations.close_on_esc %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-drag', 'template' => '{% if content.animations.enable_drag_on_desktop %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-enable-swipe', 'template' => '{% if content.animations.enable_swipe_on_mobile %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-mousewheel', 'template' => '{% if content.animations.enable_mousewheel %}
1
{% else %}
0
{% endif %}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.thumbnails.container_background.layers[].image']];
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