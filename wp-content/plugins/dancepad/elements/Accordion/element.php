<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_accordion_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Accordion",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Accordion extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
            <path d="M8 8L16 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path opacity="0.5" d="M17 3.23693C17.7506 3.22593 20.2363 2.70993 20.7634 3.23693C21.2904 3.76393 20.774 6.24893 20.7634 6.99993M3.23666 16.9999C3.22596 17.7509 2.70956 20.2359 3.23666 20.7629C3.76366 21.2899 6.24936 20.7739 6.99996 20.7629M14.9974 9.00692L20.3832 3.62093M3.62596 20.3739L9.01176 14.9879" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
            return 'Accordion';
        }
    
        static function className()
        {
            return 'dan-accordion';
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
            return ['content' => ['settings' => ['mode' => 'click', 'open_one_at_a_time' => true, 'open_all_by_default' => false, 'open_this_one_by_default' => '1'], 'icon_animation' => ['icon_rotation' => ['number' => 180, 'unit' => 'deg', 'style' => '180deg'], 'duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s']], 'expand_animation' => ['duration' => ['number' => 0.3, 'unit' => 's', 'style' => '0.3s']]], 'design' => ['dimensions' => ['width' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'height' => ['number' => 'auto', 'unit' => 'custom', 'style' => 'auto'], 'max_width' => ['number' => 467, 'unit' => 'px', 'style' => '467px']], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'size' => ['max_width' => ['breakpoint_base' => ['number' => 467, 'unit' => 'px', 'style' => '467px']], 'height' => ['breakpoint_base' => ['number' => null, 'unit' => 'auto', 'style' => 'auto']]]]];
        }
    
        static function defaultChildren()
        {
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Question'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-container']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['bottom' => null]]], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => null, 'color' => '', 'style' => ''], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#737373', 'style' => 'solid'], 'left' => ['width' => null, 'color' => '', 'style' => ''], 'right' => ['width' => null, 'color' => '', 'style' => '']]]]]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Label'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_align' => ['breakpoint_base' => 'space-between'], 'h_gap' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]], 'background' => ['color' => '#9d9c9d'], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Label Heading', 'tags' => 'h3']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question-heading']]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Icon', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-accordion-question-icon']]], 'content' => ['content' => ['icon' => ['slug' => 'icon-angle-down.', 'name' => 'icon-angle-down.', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>', 'iconSetSlug' => 'FontAwesome 6 Free - Solid']]], 'design' => ['icon' => ['color' => '#FFF', 'size' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answercont']]], 'design' => ['background' => ['color' => '#838484'], 'container' => ['borders' => null, 'padding' => ['padding' => ['breakpoint_base' => ['top' => null, 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => null]]]], 'layout_v2' => ['layout' => null, 'v_vertical_align' => ['breakpoint_base' => null]]]], 'children' => [['slug' => 'EssentialElements\RichText', 'defaultProperties' => ['content' => ['content' => ['text' => '<div>
        <div>Phasellus vestibulum justo laoreet odio vehicula porttitor. Quisque nec volutpat mauris. Donec eu magna nec diam consequat auctor.</div>
        <div>Cras mollis congue libero, non eleifend sapien faucibus eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas</div>
        </div>']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answer']]], 'design' => ['typography' => ['default' => ['color' => ['breakpoint_base' => '#FFF']]], 'spacing' => ['wrapper' => ['margin_top' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'margin_bottom' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Question'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-container']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['bottom' => null]]], 'borders' => ['border' => ['breakpoint_base' => ['top' => ['width' => null, 'color' => '', 'style' => ''], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#737373', 'style' => 'solid'], 'left' => ['width' => null, 'color' => '', 'style' => ''], 'right' => ['width' => null, 'color' => '', 'style' => '']]]]]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Label'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_align' => ['breakpoint_base' => 'space-between'], 'h_gap' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]], 'background' => ['color' => '#9d9c9d'], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Label Heading', 'tags' => 'h3']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question-heading']]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Icon', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-accordion-question-icon']]], 'content' => ['content' => ['icon' => ['slug' => 'icon-angle-down.', 'name' => 'icon-angle-down.', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>', 'iconSetSlug' => 'FontAwesome 6 Free - Solid']]], 'design' => ['icon' => ['color' => '#FFF', 'size' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answercont']]], 'design' => ['background' => ['color' => '#838484'], 'container' => ['borders' => null, 'padding' => ['padding' => ['breakpoint_base' => ['top' => null, 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => null]]]], 'layout_v2' => ['layout' => null, 'v_vertical_align' => ['breakpoint_base' => null]]]], 'children' => [['slug' => 'EssentialElements\RichText', 'defaultProperties' => ['content' => ['content' => ['text' => '<div>
        <div>Phasellus vestibulum justo laoreet odio vehicula porttitor. Quisque nec volutpat mauris. Donec eu magna nec diam consequat auctor.</div>
        <div>Cras mollis congue libero, non eleifend sapien faucibus eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas</div>
        </div>']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answer']]], 'design' => ['typography' => ['default' => ['color' => ['breakpoint_base' => '#FFF']]], 'spacing' => ['wrapper' => ['margin_top' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'margin_bottom' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Question'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-container']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['bottom' => null]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Label'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_align' => ['breakpoint_base' => 'space-between'], 'h_gap' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]], 'background' => ['color' => '#9d9c9d'], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Label Heading', 'tags' => 'h3']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question-heading']]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Icon', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-accordion-question-icon']]], 'content' => ['content' => ['icon' => ['slug' => 'icon-angle-down.', 'name' => 'icon-angle-down.', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>', 'iconSetSlug' => 'FontAwesome 6 Free - Solid']]], 'design' => ['icon' => ['color' => '#FFF', 'size' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answercont']]], 'design' => ['background' => ['color' => '#838484'], 'container' => ['borders' => null, 'padding' => ['padding' => ['breakpoint_base' => ['top' => null, 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => null]]]], 'layout_v2' => ['layout' => null, 'v_vertical_align' => ['breakpoint_base' => null]]]], 'children' => [['slug' => 'EssentialElements\RichText', 'defaultProperties' => ['content' => ['content' => ['text' => '<div>
        <div>Phasellus vestibulum justo laoreet odio vehicula porttitor. Quisque nec volutpat mauris. Donec eu magna nec diam consequat auctor.</div>
        <div>Cras mollis congue libero, non eleifend sapien faucibus eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas</div>
        </div>']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answer']]], 'design' => ['typography' => ['default' => ['color' => ['breakpoint_base' => '#FFF']]], 'spacing' => ['wrapper' => ['margin_top' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'margin_bottom' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]]], 'children' => []]]]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Question'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-container']]], 'design' => ['container' => ['padding' => ['padding' => ['breakpoint_base' => ['bottom' => null]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Label'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_align' => ['breakpoint_base' => 'space-between'], 'h_gap' => ['breakpoint_base' => ['number' => 15, 'unit' => 'px', 'style' => '15px']]], 'background' => ['color' => '#9d9c9d'], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'borders' => null]]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Label Heading', 'tags' => 'h3']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-question-heading']]], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#FFF'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'EssentialElements\Icon', 'defaultProperties' => ['settings' => ['advanced' => ['classes' => ['dan-accordion-question-icon']]], 'content' => ['content' => ['icon' => ['slug' => 'icon-angle-down.', 'name' => 'icon-angle-down.', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>', 'iconSetSlug' => 'FontAwesome 6 Free - Solid']]], 'design' => ['icon' => ['color' => '#FFF', 'size' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]], 'children' => []]]], ['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Content'], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answercont']]], 'design' => ['background' => ['color' => '#838484'], 'container' => ['borders' => null, 'padding' => ['padding' => ['breakpoint_base' => ['top' => null, 'left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => null]]]], 'layout_v2' => ['layout' => null, 'v_vertical_align' => ['breakpoint_base' => null]]]], 'children' => [['slug' => 'EssentialElements\RichText', 'defaultProperties' => ['content' => ['content' => ['text' => '<div>
        <div>Phasellus vestibulum justo laoreet odio vehicula porttitor. Quisque nec volutpat mauris. Donec eu magna nec diam consequat auctor.</div>
        <div>Cras mollis congue libero, non eleifend sapien faucibus eget. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas</div>
        </div>']], 'settings' => ['advanced' => ['classes' => ['dan-accordion-answer']]], 'design' => ['typography' => ['default' => ['color' => ['breakpoint_base' => '#FFF']]], 'spacing' => ['wrapper' => ['margin_top' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'margin_bottom' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]]], 'children' => []]]]]]];
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
          "EssentialElements\\borders",
          "Borders",
          "borders",
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
            "settings",
            "Settings",
            [c(
            "mode",
            "Mode",
            [],
            ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'click', 'text' => 'click'], ['text' => 'hover', 'value' => 'hover']]],
            false,
            false,
            [],
          ), c(
            "open_one_at_a_time",
            "Open one at a time",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "open_all_by_default",
            "Open all by default",
            [],
            ['type' => 'toggle', 'layout' => 'inline'],
            false,
            false,
            [],
          ), c(
            "open_this_one_by_default",
            "Open this one by default",
            [],
            ['type' => 'text', 'layout' => 'vertical', 'placeholder' => 'Accordion number'],
            false,
            false,
            [],
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "icon_animation",
            "Icon animation",
            [c(
            "icon_rotation",
            "Icon rotation",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['deg', 'custom']]],
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
          )],
            ['type' => 'section', 'layout' => 'vertical'],
            false,
            false,
            [],
          ), c(
            "expand_animation",
            "Expand animation",
            [c(
            "duration",
            "Duration",
            [],
            ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
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
            return ['0' =>  ['title' => 'Dancepad - Accordion','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Accordion/dancepad_accordion.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_accordion();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_accordion();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_accordion();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_accordion();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_accordion();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_accordion();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_accordion();',
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
            return [['name' => 'data-contenttransitionduration', 'template' => '{{ content.expand_animation.duration.style }}'], ['name' => 'data-mode', 'template' => '{{ content.settings.mode }}'], ['name' => 'data-singleopen', 'template' => '{% if content.settings.open_one_at_a_time %}
        true
        {% else %}
        false
        {% endif %}'], ['name' => 'data-openall', 'template' => '{% if content.settings.open_all_by_default %}
        true
        {% else %}
        false
        {% endif %}'], ['name' => 'data-openthis', 'template' => '{{ content.settings.open_this_one_by_default }}']];
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
