<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_scrolling_gallery_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\ScrollingGallery",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class ScrollingGallery extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path opacity="0.4" d="M21.75 12.0514C21.7501 13.1349 21.7501 14.0204 21.6518 14.7195C21.5491 15.4502 21.3268 16.0838 20.7981 16.5895C20.2694 17.0952 19.6071 17.3078 18.8431 17.4061C18.1123 17.5 17.1866 17.5 16.0537 17.5L7.94634 17.5C6.81351 17.5 5.88778 17.5 5.15691 17.4061C4.39296 17.3078 3.73062 17.0952 3.20193 16.5895C2.67324 16.0838 2.45096 15.4502 2.34825 14.7195C2.24998 14.0204 2.25 13.1349 2.25003 12.0514L2.25003 12.0514L2.25003 11.9486L2.25003 11.9486C2.25 10.8651 2.24998 9.97958 2.34825 9.2805C2.45096 8.54976 2.67324 7.91622 3.20193 7.41052C3.73063 6.90481 4.39296 6.69219 5.15691 6.59395C5.88777 6.49996 6.81349 6.49998 7.94631 6.5L7.94634 6.5L16.0537 6.5L16.0537 6.5C17.1866 6.49998 18.1123 6.49996 18.8431 6.59395C19.6071 6.69219 20.2694 6.90481 20.7981 7.41052C21.3268 7.91622 21.5491 8.54976 21.6518 9.2805C21.7501 9.97958 21.7501 10.8651 21.75 11.9486L21.75 11.9486L21.75 12.0514L21.75 12.0514Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1875 1.2677C17.73 1.37134 18.0857 1.89511 17.9821 2.43758C17.8523 3.11713 17.5982 3.73095 17.0812 4.23423C16.4874 4.8123 15.7528 5.04454 14.9474 5.14995C14.1829 5.25001 13.2203 5.24998 12.0673 5.24994L11.9324 5.24994C10.7794 5.24998 9.81676 5.25001 9.05231 5.14995C8.24693 5.04454 7.51228 4.8123 6.9185 4.23423C6.40154 3.73095 6.14743 3.11713 6.01761 2.43758C5.91398 1.89511 6.26973 1.37134 6.8122 1.2677C7.35468 1.16407 7.87845 1.51982 7.98208 2.06229C8.06125 2.47668 8.17678 2.66796 8.31362 2.80118C8.47198 2.95535 8.71867 3.08922 9.31187 3.16687C9.93116 3.24792 10.7618 3.24994 11.9998 3.24994C13.2379 3.24994 14.0685 3.24792 14.6878 3.16687C15.281 3.08922 15.5277 2.95535 15.6861 2.80118C15.8229 2.66797 15.9384 2.47668 16.0176 2.06229C16.1212 1.51982 16.645 1.16407 17.1875 1.2677Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1875 22.7318C17.73 22.6282 18.0857 22.1044 17.9821 21.5619C17.8523 20.8824 17.5982 20.2686 17.0812 19.7653C16.4874 19.1872 15.7528 18.955 14.9474 18.8496C14.1829 18.7495 13.2203 18.7495 12.0673 18.7496L11.9324 18.7496C10.7794 18.7495 9.81676 18.7495 9.05231 18.8496C8.24694 18.955 7.51228 19.1872 6.9185 19.7653C6.40154 20.2686 6.14743 20.8824 6.01761 21.5619C5.91398 22.1044 6.26973 22.6282 6.8122 22.7318C7.35468 22.8354 7.87845 22.4797 7.98208 21.9372C8.06125 21.5228 8.17678 21.3315 8.31362 21.1983C8.47198 21.0442 8.71867 20.9103 9.31187 20.8326C9.93116 20.7516 10.7618 20.7496 11.9998 20.7496C13.2379 20.7496 14.0685 20.7516 14.6878 20.8326C15.281 20.9103 15.5277 21.0442 15.6861 21.1983C15.8229 21.3315 15.9384 21.5228 16.0176 21.9372C16.1212 22.4797 16.645 22.8354 17.1875 22.7318Z" fill="currentColor" />
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
        return 'Scrolling Gallery';
    }

    static function className()
    {
        return 'dan-scrolling-gallery';
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
        return ['content' => ['gallery_images' => ['repeater' => [['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/31887348/pexels-photo-31887348.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/27085501/pexels-photo-27085501/free-photo-of-planta-ventanas-descuidado-cubierto-de-vegetacion.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1048035/pexels-photo-1048035.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/15676265/pexels-photo-15676265/free-photo-of-hojas-verde-flora-tropical.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1207978/pexels-photo-1207978.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1122639/pexels-photo-1122639.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/2718447/pexels-photo-2718447.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']], ['alt' => 'gallery-image', 'image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://images.pexels.com/photos/1407305/pexels-photo-1407305.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2', 'alt' => '', 'caption' => '']]]], 'animation' => ['end' => 'bottom center-=50px', 'start' => 'top center', 'random_margin_images' => 100, 'random_margin_thumbnails' => 15]], 'design' => ['padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]], 'size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => null], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]], 'thumbnails_container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'bottom' => ['number' => 25, 'unit' => 'px', 'style' => '25px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]]], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]], 'size' => ['height' => ['breakpoint_base' => ['number' => 100, 'unit' => 'vh', 'style' => '100vh']], 'width' => ['breakpoint_base' => ['number' => 20, 'unit' => '%', 'style' => '20%']]]], 'thumbnail' => ['active_css_easing' => 'ease-in-out', 'active_duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s'], 'active_border' => ['border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#fff', 'style' => 'solid']]]], 'active_scale' => 1.3, 'opacity' => 0.5, 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'topRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomLeft' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottomRight' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'editMode' => 'all']]], 'width' => ['number' => 50, 'unit' => 'px', 'style' => '50px']], 'images_container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'left' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'right' => ['number' => 100, 'unit' => 'px', 'style' => '100px']]]], 'width' => ['number' => 80, 'unit' => '%', 'style' => '80%'], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'gap' => ['breakpoint_base' => ['number' => 50, 'unit' => 'px', 'style' => '50px']]]], 'image' => ['size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 800, 'unit' => 'px', 'style' => '800px']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_height' => ['breakpoint_base' => ['number' => 1000, 'unit' => 'px', 'style' => '1000px']]], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]]], 'background' => ['color' => ['breakpoint_base' => '#000']]]];
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
        "thumbnails_container",
        "Thumbnails Container",
        [getPresetSection(
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
      ), getPresetSection(
      "EssentialElements\\borders",
      "Border",
      "border",
       ['type' => 'popout']
     ), c(
        "opacity",
        "Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      ), c(
        "active_scale",
        "Active Scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 20, 'step' => 0.1]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Active Border",
      "active_border",
       ['type' => 'popout']
     ), c(
        "active_duration",
        "Active Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "active_css_easing",
        "Active CSS Easing",
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
        "images_container",
        "Images Container",
        [getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     ), c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\layout",
      "Layout",
      "layout",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "image",
        "Image",
        [getPresetSection(
      "EssentialElements\\size",
      "Size",
      "size",
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
      )];
    }

    static function contentControls()
    {
        return [c(
        "gallery_images",
        "Gallery Images",
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
        "animation",
        "Animation",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Random Margin Thumbnails must be at least equal to Thumbnails Container horizontal padding.</p>']],
        false,
        false,
        [],
      ), c(
        "random_margin_thumbnails",
        "Random Margin Thumbnails",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "random_margin_images",
        "Random Margin Images",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "start",
        "Start",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "end",
        "End",
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
            '0' => [
                'title' => 'Dancepad - Scrolling Gallery',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Scrolling_Gallery/dancepad_scrolling_gallery.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_scrolling_gallery();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_scrolling_gallery();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%', '%%BREAKDANCE_REUSABLE_SCROLL_TRIGGER%%'],
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

'onPropertyChange' => [['script' => 'dancepad_scrolling_gallery();',
],],

'onCreatedElement' => [['script' => 'dancepad_scrolling_gallery();',
],],

'onMountedElement' => [['script' => 'dancepad_scrolling_gallery();',
],],

'onMovedElement' => [['script' => 'dancepad_scrolling_gallery();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_scrolling_gallery();',
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
        return [['name' => 'data-flickering', 'template' => '1'], ['name' => 'data-random-margin-thumbnails', 'template' => '{{ content.animation.random_margin_thumbnails }}'], ['name' => 'data-random-margin-images', 'template' => '{{ content.animation.random_margin_images }}'], ['name' => 'data-start', 'template' => '{{ content.animation.start }}'], ['name' => 'data-end', 'template' => '{{ content.animation.end }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image']];
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