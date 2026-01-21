<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_site_loader_enable') == 'true'){
  \Breakdance\ElementStudio\registerElementForEditing(
    "Dancepad\\SiteLoader",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class SiteLoader extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
    <path d="M20 15C21.6569 15 23 13.6569 23 12C23 10.3431 21.6569 9 20 9H14V15H20Z" fill="currentColor" />
    <path opacity="0.4" d="M4 9C2.34315 9 1 10.3431 1 12C1 13.6569 2.34315 15 4 15H14V13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H14V9H4Z" fill="currentColor" />
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
        return 'Site Loader';
    }

    static function className()
    {
        return 'dan-site-loader';
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
        return ['content' => ['site_loader' => ['type' => 'type1', 'min_loading_time' => ['number' => 4, 'unit' => 's', 'style' => '4s'], 'disable_at_the_builder' => false], 'type_1' => ['swap_duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'swap_stagger' => ['number' => 0.03, 'unit' => 's', 'style' => '0.03s'], 'swap_gsap_easing' => 'power2', 'loading_text' => 'Loading', 'complete_text' => 'Complete'], 'settings_type_1' => ['swap_duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'swap_stagger' => ['number' => 0.03, 'unit' => 's', 'style' => '0.03s'], 'swap_gsap_easing' => 'power2', 'loading_text' => 'Loading', 'complete_text' => 'Complete', 'slide_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'slide_stagger' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'slide_gsap_easing' => 'power2', 'progress_bar_gsap_easing' => 'power1', 'slide_delay' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s']], 'settings_type_2' => ['progress_bar_gsap_easing' => 'power1', 'percentage_gsap_easing' => 'power1', 'slide_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'slide_delay' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'slide_gsap_easing' => 'power2'], 'settings_type_3' => ['finish_scale' => 0.95, 'scale_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'scale_gsap_easing' => 'power2', 'symbol' => '$', 'line_1' => 'Removing the boring WordPress website', 'line_2' => 'Accessing Breakdance', 'line_3' => 'Launching Dancepad', 'line_4' => 'Decoding Elements', 'terminal_translate_from' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'terminal_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'terminal_gsap_easing' => 'power2', 'cursor_blink_css_easing' => 'ease-in-out', 'cursor_blink_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'exit_fade_gsap_easing' => 'power2', 'exit_fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s']], 'settings_type_4' => ['progress_text' => 'loading', 'initial_loading_duration' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s'], 'initial_loading_delay' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'initial_loading_gsap_easing' => 'expo', 'progress_gsap_easing' => 'expo', 'exit_slides_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'exit_slides_gsap_easing' => 'power3'], 'settings_type_5' => ['brand_text' => 'Dancepad', 'exit_slides_duration' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s'], 'exit_slides_gsap_easing' => 'power4', 'loader_scale_duration' => ['number' => 2, 'unit' => 's', 'style' => '2s'], 'loader_scale_gsap_easing' => 'power4', 'loader_scale' => 0.5, 'swap_duration' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s'], 'swap_stagger' => ['number' => 0.03, 'unit' => 's', 'style' => '0.03s'], 'swap_gsap_easing' => 'expo', 'count_exit_fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'count_exit_fade_duration_gsap_easing' => 'power2'], 'settings_type_6' => ['counter_swap_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'counter_swap_stagger' => ['number' => 0.1, 'unit' => 's', 'style' => '0.1s'], 'counter_swap_gsap_easing' => 'expo', 'exit_animation_duration' => ['number' => 1, 'unit' => 's', 'style' => '1s'], 'exit_animation_type' => 'toTop', 'exit_animation_gsap_easing' => 'expo'], 'settings_type_7' => ['image' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://dancepad.io/wp-content/uploads/2024/11/dancepad-logo-1.png', 'alt' => '', 'caption' => ''], 'alt' => 'Dancepad', 'scale' => 200, 'progress_gsap_easing' => 'power2', 'bar_scale_gsap_easing' => 'power2', 'bar_scale_duration' => ['number' => 2, 'unit' => 's', 'style' => '2s'], 'exit_fade_duration' => ['number' => 1.5, 'unit' => 's', 'style' => '1.5s'], 'exit_fade_gsap_easing' => 'power1'], 'settings_type_8' => ['bars_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'bars_stagger' => ['number' => 0.03, 'unit' => 's', 'style' => '0.03s'], 'bars_gsap_easing' => 'power3', 'counters_exit_fade_gsap_easing' => 'expo', 'counter_exit_fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s']], 'settings_type_9' => ['direction' => 'bottom', 'bars_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'bars_stagger' => ['number' => 0.03, 'unit' => 's', 'style' => '0.03s'], 'bars_gsap_easing' => 'power3', 'counter_exit_fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'counter_exit_fade_gsap_easing' => 'expo'], 'settings_type_10' => ['pause_after_zoom' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'image_scale_gsap_easing' => 'power3', 'image_scale_duration' => ['number' => 1.2, 'unit' => 's', 'style' => '1.2s'], 'image_reveal_gsap_easing' => 'smoothBlur', 'image_reveal_duration' => ['number' => 0.65, 'unit' => 's', 'style' => '0.65s'], 'image_reveal_stagger' => ['number' => 0.15, 'unit' => 's', 'style' => '0.15s'], 'image_4_alt_text' => 'Image 4', 'image_3_alt_text' => 'Image 3', 'image_2_alt_text' => 'Image 2', 'image_1_alt_text' => 'Image 1', 'image_1' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://cdn.cosmos.so/5f8d5539-943c-4df5-bae8-8e714633ddd0.jpeg', 'alt' => '', 'caption' => ''], 'image_2' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://cdn.cosmos.so/0098a074-f8a2-4821-bcb0-433c093ae255.jpeg', 'alt' => '', 'caption' => ''], 'image_3' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://cdn.cosmos.so/ce9f9fd7-a2a5-476d-9757-481ca01b5861.jpeg', 'alt' => '', 'caption' => ''], 'image_4' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://cdn.cosmos.so/94579ea4-daee-43f9-b778-84156b731361.jpeg', 'alt' => '', 'caption' => '']], 'settings_type_11' => ['slides_duration' => ['number' => 2, 'unit' => 's', 'style' => '2s'], 'slides_gsap_easing' => 'power4', 'progress_exit_fade_duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'progress_exit_fade_gsap_easing' => 'power3', 'progress_gsap_easing' => 'power3', 'left_text' => 'Break', 'right_text' => 'Dance'], 'settings_type_12' => ['exit_fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'exit_fade_gsap_easing' => 'power3', 'progress_gsap_easing' => 'power3', 'progress_from' => 'left', 'alt' => 'Dancepad logo', 'logo' => ['id' => -1, 'type' => 'external_image', 'url' => 'https://dancepad.io/wp-content/uploads/2024/11/dancepad-logo-1.png', 'alt' => '', 'caption' => '']]], 'design' => ['styles_type_1' => ['site_loader_background' => 'rgb(60, 66, 55)', 'site_loader_zindex' => 1000, 'progress_size' => ['max_width' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']], 'height' => ['breakpoint_base' => ['number' => 2, 'unit' => 'px', 'style' => '2px']]], 'progress_color' => '#ffffff', 'progress_path_color' => 'rgba(255, 255, 255, 0.1)', 'percentage_typography' => ['custom' => ['customTypography' => ['fontSize' => ['number' => 256, 'unit' => 'px', 'style' => '256px'], 'fontWeight' => '700', 'advanced' => ['lineHeight' => ['number' => '0.8', 'unit' => 'custom', 'style' => '0.8']]]], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 256, 'unit' => 'px', 'style' => '256px']], 'fontWeight' => ['breakpoint_base' => '700'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '0.8', 'unit' => 'custom', 'style' => '0.8']]]]]], 'color' => ['breakpoint_base' => '#fff']], 'percentage_bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'percentage_right' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'percentage_opacity' => 0.1, 'text_margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'left' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'right' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'text_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '300'], 'advanced' => ['textTransform' => ['breakpoint_base' => 'uppercase']]]]], 'color' => ['breakpoint_base' => '#fff'], 'text_align' => ['breakpoint_base' => 'center']], 'typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontWeight' => ['breakpoint_base' => '300'], 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'advanced' => ['textTransform' => ['breakpoint_base' => 'uppercase']]]]], 'text_align' => ['breakpoint_base' => 'center']]], 'styles_type_2' => ['site_loader_background' => 'rgb(60, 66, 55)', 'site_loader_zindex' => 1000, 'progress_color' => '#fff', 'percentage_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 256, 'unit' => 'px', 'style' => '256px']], 'fontWeight' => ['breakpoint_base' => '700'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '0.8', 'unit' => 'custom', 'style' => '0.8']]]]]]], 'percentage_bottom' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'blend_mode' => 'difference'], 'styles_type_3' => ['site_loader_background' => '#000000', 'site_loader_zindex' => 1000, 'symbols_gap' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'before_symbol' => '[', 'after_symbol' => ']', 'percentage_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 24, 'unit' => 'px', 'style' => '24px']], 'advanced' => ['letterSpacing' => ['breakpoint_base' => ['number' => 2, 'unit' => 'px', 'style' => '2px']]], 'fontWeight' => ['breakpoint_base' => '700'], 'fontFamily' => ['breakpoint_base' => 'gfont-ibmplexmono']]]], 'color' => ['breakpoint_base' => '#fff']], 'percentage_bottom' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'percentage_right' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'progress_border' => ['shadow' => null, 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid']]]], 'progress_color' => '#fff', 'progress_path_color' => '#000', 'progress_height' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'loading_container_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'topLeft' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'topRight' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottomLeft' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottomRight' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'editMode' => 'all']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid']]]], 'loading_container_background' => ['color' => ['breakpoint_base' => 'rgba(90, 90, 90, 0.05)']], 'loading_container_margin' => ['margin' => ['breakpoint_base' => ['bottom' => ['number' => 64, 'unit' => 'px', 'style' => '64px'], 'top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'right' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'left' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'loading_container_padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'bottom' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]], 'cursor_color' => '#fff', 'cursor_size' => ['width' => ['breakpoint_base' => ['number' => 8, 'unit' => 'px', 'style' => '8px']], 'height' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]], 'commands_typography' => ['typography' => ['custom' => ['customTypography' => ['fontFamily' => ['breakpoint_base' => 'gfont-ibmplexmono'], 'fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']]]]], 'color' => ['breakpoint_base' => '#fff']], 'prompt_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 14, 'unit' => 'px', 'style' => '14px']], 'fontFamily' => ['breakpoint_base' => 'gfont-ibmplexmono']]]]], 'commands_gap' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'terminal_gap' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'terminal_border' => ['shadow' => ['breakpoint_base' => ['shadows' => [['color' => '#5A5A5A1A', 'x' => '0', 'y' => '0', 'blur' => '20', 'spread' => '0', 'position' => 'outset']], 'style' => '0px 0px 20px 0px #5A5A5A1A']], 'border' => ['breakpoint_base' => ['top' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'bottom' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'left' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid'], 'right' => ['width' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'color' => '#333', 'style' => 'solid']]], 'radius' => ['breakpoint_base' => ['all' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'topRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomLeft' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'bottomRight' => ['number' => 4, 'unit' => 'px', 'style' => '4px'], 'editMode' => 'all']]], 'terminal_background' => ['color' => ['breakpoint_base' => '#000']], 'terminal_size' => ['width' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_width' => ['breakpoint_base' => ['number' => 600, 'unit' => 'px', 'style' => '600px']], 'height' => ['breakpoint_base' => ['number' => 100, 'unit' => '%', 'style' => '100%']], 'max_height' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']]], 'terminal_padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'right' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'top' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'bottom' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]]], 'styles_type_4' => ['site_loader_background' => '#555555', 'site_loader_zindex' => 1000, 'progress_color' => '#000', 'progress_padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'right' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'top' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'bottom' => ['number' => 32, 'unit' => 'px', 'style' => '32px']]]], 'progress_initial_width' => ['number' => 25, 'unit' => 'vw', 'style' => '25vw'], 'progress_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontWeight' => ['breakpoint_base' => '500'], 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']]]]]], 'progress_background' => '#000'], 'styles_type_5' => ['site_loader_background' => '#fff', 'site_loader_zindex' => 1000, 'slide_mask_color' => '#ed4026', 'slides_up_color' => '#666666', 'text_typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']], 'textTransform' => ['breakpoint_base' => 'uppercase']], 'fontSize' => ['breakpoint_base' => ['number' => 30, 'unit' => 'px', 'style' => '30px']]]]]], 'count_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500'], 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => '1', 'unit' => 'custom', 'style' => '1']]]]]], 'color' => ['breakpoint_base' => '#fff']], 'count_padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'left' => ['number' => 8, 'unit' => 'px', 'style' => '8px'], 'right' => ['number' => 8, 'unit' => 'px', 'style' => '8px']]]]], 'styles_type_6' => ['site_loader_background' => '#333333', 'site_loader_zindex' => 1000, 'counter_bottom' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'counter_left' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'counter_typography' => ['typography' => ['custom' => ['customTypography' => ['fontWeight' => ['breakpoint_base' => '400'], 'fontSize' => ['breakpoint_base' => ['number' => 256, 'unit' => 'px', 'style' => '256px']]]]], 'color' => ['breakpoint_base' => '#fff']]], 'styles_type_7' => ['site_loader_background' => '#555', 'site_loader_zindex' => 1000, 'logo_gap' => ['number' => 24, 'unit' => 'px', 'style' => '24px'], 'logo_width' => ['number' => 40, 'unit' => 'px', 'style' => '40px'], 'logo_height' => ['number' => null, 'unit' => 'auto', 'style' => 'auto'], 'progress_width' => ['number' => 300, 'unit' => 'px', 'style' => '300px'], 'progress_height' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'path_color' => '#e3e3e3', 'progress_color' => '#808080'], 'styles_type_8' => ['site_loader_background' => '#000000', 'site_loader_zindex' => 1000, 'bars_number' => 10, 'bars_color' => '#ffffff', 'counter_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 256, 'unit' => 'px', 'style' => '256px']]]]], 'color' => ['breakpoint_base' => '#e3e3e3']], 'blend_mode' => 'exclusion', 'counter_blend_mode' => 'exclusion'], 'styles_type_9' => ['site_loader_background' => '#000000', 'site_loader_zindex' => 1000, 'bars_number' => 20, 'bars_color' => '#ffffff', 'counter_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 256, 'unit' => 'px', 'style' => '256px']]]]], 'color' => ['breakpoint_base' => '#e3e3e3']], 'blend_mode' => 'exclusion', 'counter_blend_mode' => 'exclusion', 'bars_horizontal_transform' => 'left', 'bars_vertical_transform' => 'top'], 'styles_type_10' => ['site_loader_background' => '#000', 'site_loader_zindex' => 1000, 'images_wrapper_size' => ['width' => ['breakpoint_base' => ['number' => 400, 'unit' => 'px', 'style' => '400px']], 'height' => ['breakpoint_base' => ['number' => 300, 'unit' => 'px', 'style' => '300px']]]], 'styles_type_11' => ['site_loader_background' => '#272727', 'site_loader_zindex' => 1000, 'loading_text_padding' => ['padding' => ['breakpoint_base' => ['right' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'left' => ['number' => 32, 'unit' => 'px', 'style' => '32px'], 'top' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'bottom' => ['number' => 0, 'unit' => 'px', 'style' => '0px']]]], 'loading_text_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 18, 'unit' => 'px', 'style' => '18px']], 'fontWeight' => ['breakpoint_base' => '500']]]], 'color' => ['breakpoint_base' => '#ffffff']], 'progress_size' => ['width' => ['breakpoint_base' => ['number' => 2, 'unit' => 'px', 'style' => '2px']], 'height' => ['breakpoint_base' => ['number' => 140, 'unit' => 'px', 'style' => '140px']]], 'progress_border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'topLeft' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'topRight' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottomLeft' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'bottomRight' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'editMode' => 'all']]], 'path_color' => '#333333', 'progress_color' => '#ffffff'], 'styles_type_12' => ['site_loader_background' => '#555555', 'site_loader_zindex' => 1000, 'logo_width' => ['number' => 100, 'unit' => 'px', 'style' => '100px'], 'logo_height' => ['number' => null, 'unit' => 'auto', 'style' => 'auto'], 'logo_opacity' => 0.3]]];
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
        "styles_type_1",
        "Styles - Type 1",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_all",
      "Progress Container Margin",
      "progress_container_margin",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Progress Size",
      "progress_size",
       ['type' => 'popout']
     ), c(
        "progress_color",
        "Progress color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_path_color",
        "Progress path color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Percentage Typography",
      "percentage_typography",
       ['type' => 'popout']
     ), c(
        "percentage_bottom",
        "Percentage Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_left",
        "Percentage Left",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_right",
        "Percentage Right",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_opacity",
        "Percentage Opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_all",
      "Text Margin",
      "text_margin",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography_with_effects_and_align",
      "Text Typography",
      "text_typography",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type1']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_2",
        "Styles - Type 2",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_color",
        "Progress color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Percentage Typography",
      "percentage_typography",
       ['type' => 'popout']
     ), c(
        "percentage_bottom",
        "Percentage Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "blend_mode",
        "Blend Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'normal', 'text' => 'Normal'], ['text' => 'Multiply', 'value' => 'multiply'], ['text' => 'Screen', 'value' => 'screen'], ['text' => 'Overlay', 'value' => 'overlay'], ['text' => 'Darken', 'value' => 'darken'], ['text' => 'Lighten', 'value' => 'lighten'], ['text' => 'Color Dodge', 'value' => 'color-dodge'], ['text' => 'Color Burn', 'value' => 'color-burn'], ['text' => 'Difference', 'value' => 'difference'], ['text' => 'Exclusion', 'value' => 'exclusion']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type2']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_3",
        "Styles - Type 3",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Terminal Padding",
      "terminal_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Terminal Size",
      "terminal_size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Terminal Background",
      "terminal_background",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Terminal Border",
      "terminal_border",
       ['type' => 'popout']
     ), c(
        "terminal_gap",
        "Terminal Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "commands_gap",
        "Commands Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "symbol_line_gap",
        "Symbol & Line Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Prompt Typography",
      "prompt_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Commands Typography",
      "commands_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Cursor Size",
      "cursor_size",
       ['type' => 'popout']
     ), c(
        "cursor_color",
        "Cursor Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_all",
      "Loading Container Margin",
      "loading_container_margin",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Loading Container Padding",
      "loading_container_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\background",
      "Loading Container Background",
      "loading_container_background",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Loading Container Border",
      "loading_container_border",
       ['type' => 'popout']
     ), c(
        "progress_height",
        "Progress Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Progress Border",
      "progress_border",
       ['type' => 'popout']
     ), c(
        "progress_color",
        "Progress Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_path_color",
        "Progress Path Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_top",
        "Percentage Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_right",
        "Percentage Right",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_bottom",
        "Percentage Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "percentage_left",
        "Percentage Left",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Percentage Typography",
      "percentage_typography",
       ['type' => 'popout']
     ), c(
        "before_symbol",
        "Before Symbol",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "after_symbol",
        "After Symbol",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "symbols_gap",
        "Symbols Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type3']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_4",
        "Styles - Type 4",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Progress Padding",
      "progress_padding",
       ['type' => 'popout']
     ), c(
        "progress_initial_width",
        "Progress Initial Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Progress Typography",
      "progress_typography",
       ['type' => 'popout']
     ), c(
        "progress_background",
        "Progress Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type4']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_5",
        "Styles - Type 5",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Count Padding",
      "count_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Count Typography",
      "count_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Text Typography",
      "text_typography",
       ['type' => 'popout']
     ), c(
        "slide_mask_color",
        "Slide Mask Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "slides_up_color",
        "Slides Up Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type5']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_6",
        "Styles - Type 6",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "counter_top",
        "Counter Top",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "counter_bottom",
        "Counter Bottom",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "counter_left",
        "Counter Left",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "counter_right",
        "Counter Right",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Counter Typography",
      "counter_typography",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type6']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_7",
        "Styles - Type 7",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_gap",
        "Logo Gap",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_width",
        "Logo Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_height",
        "Logo Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_width",
        "Progress Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "progress_height",
        "Progress Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Progress Border",
      "progress_border",
       ['type' => 'popout']
     ), c(
        "progress_color",
        "Progress Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_color",
        "Path Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type7']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_8",
        "Styles - Type 8",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bars_number",
        "Bars Number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bars_color",
        "Bars Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Counter Typography",
      "counter_typography",
       ['type' => 'popout']
     ), c(
        "counter_blend_mode",
        "Counter Blend Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'normal', 'text' => 'Normal'], ['text' => 'Multiply', 'value' => 'multiply'], ['text' => 'Screen', 'value' => 'screen'], ['text' => 'Overlay', 'value' => 'overlay'], ['text' => 'Darken', 'value' => 'darken'], ['text' => 'Lighten', 'value' => 'lighten'], ['text' => 'Color Dodge', 'value' => 'color-dodge'], ['text' => 'Color Burn', 'value' => 'color-burn'], ['text' => 'Difference', 'value' => 'difference'], ['text' => 'Exclusion', 'value' => 'exclusion']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type8']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_9",
        "Styles - Type 9",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bars_number",
        "Bars Number",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bars_color",
        "Bars Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bars_horizontal_transform",
        "Bars Horizontal Transform",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'left', 'text' => 'Left'], ['text' => 'Right', 'value' => 'right'], ['text' => 'Center', 'value' => 'center']]],
        false,
        false,
        [],
      ), c(
        "bars_vertical_transform",
        "Bars Vertical Transform",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top', 'text' => 'Top'], ['text' => 'Bottom', 'value' => 'bottom'], ['text' => 'Center', 'value' => 'center']]],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\typography",
      "Counter Typography",
      "counter_typography",
       ['type' => 'popout']
     ), c(
        "counter_blend_mode",
        "Counter Blend Mode",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'normal', 'text' => 'Normal'], ['text' => 'Multiply', 'value' => 'multiply'], ['text' => 'Screen', 'value' => 'screen'], ['text' => 'Overlay', 'value' => 'overlay'], ['text' => 'Darken', 'value' => 'darken'], ['text' => 'Lighten', 'value' => 'lighten'], ['text' => 'Color Dodge', 'value' => 'color-dodge'], ['text' => 'Color Burn', 'value' => 'color-burn'], ['text' => 'Difference', 'value' => 'difference'], ['text' => 'Exclusion', 'value' => 'exclusion']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type9']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_10",
        "Styles - Type 10",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\size",
      "Images Wrapper Size",
      "images_wrapper_size",
       ['type' => 'popout']
     )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type10']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_11",
        "Styles - Type 11",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Loading Text Padding",
      "loading_text_padding",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\typography",
      "Loading Text Typography",
      "loading_text_typography",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\size",
      "Progress Size",
      "progress_size",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\borders",
      "Progress Border",
      "progress_border",
       ['type' => 'popout']
     ), c(
        "progress_color",
        "Progress Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "path_color",
        "Path Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type11']]]],
        false,
        false,
        [],
      ), c(
        "styles_type_12",
        "Styles - Type 12",
        [c(
        "site_loader_background",
        "Site Loader Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "site_loader_zindex",
        "Site Loader zIndex",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_width",
        "Logo width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_height",
        "Logo height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "logo_opacity",
        "Logo opacity",
        [],
        ['type' => 'number', 'layout' => 'inline', 'rangeOptions' => ['min' => 0, 'max' => 1, 'step' => 0.1]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type12']]]],
        false,
        false,
        [],
      )];
    }

    static function contentControls()
    {
        return [c(
        "site_loader",
        "Site Loader",
        [c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>The loading animation will only be visible on the front. In the builder the site loader will be displayed to edit its appearance. Enable the following switch when you finish editing to hide it.</p>']],
        false,
        false,
        [],
      ), c(
        "disable_at_the_builder",
        "Disable at the builder",
        [],
        ['type' => 'toggle', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "type",
        "Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'type1', 'text' => 'Type 1'], ['value' => 'type2', 'text' => 'Type 2'], ['value' => 'type3', 'text' => 'Type 3'], ['value' => 'type4', 'text' => 'Type 4'], ['value' => 'type5', 'text' => 'Type 5'], ['value' => 'type6', 'text' => 'Type 6'], ['value' => 'type7', 'text' => 'Type 7'], ['value' => 'type8', 'text' => 'Type 8'], ['value' => 'type9', 'text' => 'Type 9'], ['value' => 'type10', 'text' => 'Type 10'], ['value' => 'type11', 'text' => 'Type 11'], ['value' => 'type12', 'text' => 'Type 12']]],
        false,
        false,
        [],
      ), c(
        "note",
        "Note",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Loading time is extremely short in most cases, so it is recommended to set at least a minimum loading time.\'</p>'], 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'not equals', 'value' => 'type10']]]],
        false,
        false,
        [],
      ), c(
        "min_loading_time",
        "Min. loading time",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Loading time is extremely short in most cases, so it is recommended to set at least a minimum loading time.\'</p>'], 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'not equals', 'value' => 'type10']]], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "note_type_10",
        "Note Type 10",
        [],
        ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>Type 10 isnt a loader but a site reveal instead so there is no minimum duration.</p>'], 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type10']]], 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "settings_type_1",
        "Settings - Type 1",
        [c(
        "loading_text",
        "Loading Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "complete_text",
        "Complete Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "swap_duration",
        "Swap Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "swap_stagger",
        "Swap Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "swap_gsap_easing",
        "Swap GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "slide_duration",
        "Slide Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "slide_delay",
        "Slide Delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "slide_gsap_easing",
        "Slide GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "progress_bar_gsap_easing",
        "Progress Bar GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type1']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_2",
        "Settings - Type 2",
        [c(
        "progress_bar_gsap_easing",
        "Progress Bar GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "percentage_gsap_easing",
        "Percentage GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "slide_duration",
        "Slide Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "slide_delay",
        "Slide Delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "slide_gsap_easing",
        "Slide GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type2']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_3",
        "Settings - Type 3",
        [c(
        "symbol",
        "Symbol",
        [],
        ['type' => 'text', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "line_1",
        "Line 1",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "line_2",
        "Line 2",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "line_3",
        "Line 3",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "line_4",
        "Line 4",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "finish_scale",
        "Finish Scale",
        [],
        ['type' => 'number', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "scale_duration",
        "Scale Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "scale_gsap_easing",
        "Scale GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "terminal_translate_from",
        "Terminal Translate From",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => []]],
        false,
        false,
        [],
      ), c(
        "terminal_duration",
        "Terminal Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "terminal_gsap_easing",
        "Terminal GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_duration",
        "Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_gsap_easing",
        "Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "cursor_blink_duration",
        "Cursor Blink Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "cursor_blink_css_easing",
        "Cursor Blink CSS Easing",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type3']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_4",
        "Settings - Type 4",
        [c(
        "progress_text",
        "Progress Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "initial_loading_duration",
        "Initial Loading Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "initial_loading_delay",
        "Initial Loading Delay",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "initial_loading_gsap_easing",
        "Initial Loading GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "progress_gsap_easing",
        "Progress GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_slides_duration",
        "Exit Slides Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_slides_gsap_easing",
        "Exit Slides GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type4']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_5",
        "Settings - Type 5",
        [c(
        "brand_text",
        "Brand Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "count_exit_fade_duration",
        "Count Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "count_exit_fade_duration_gsap_easing",
        "Count Exit Fade Duration GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "swap_duration",
        "Swap Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "swap_stagger",
        "Swap Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "swap_gsap_easing",
        "Swap GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "loader_scale",
        "Loader Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "loader_scale_duration",
        "Loader Scale Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "loader_scale_gsap_easing",
        "Loader Scale GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_slides_duration",
        "Exit Slides Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_slides_gsap_easing",
        "Exit Slides GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type5']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_6",
        "Settings - Type 6",
        [c(
        "counter_swap_duration",
        "Counter Swap Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "counter_swap_stagger",
        "Counter Swap Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "counter_swap_gsap_easing",
        "Counter Swap GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_animation_type",
        "Exit Animation Type",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'toTop', 'text' => 'To Top'], ['text' => 'To Bottom', 'value' => 'toBottom'], ['text' => 'To Left', 'value' => 'toLeft'], ['text' => 'To Right', 'value' => 'toRight']]],
        false,
        false,
        [],
      ), c(
        "exit_animation_duration",
        "Exit Animation Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_animation_gsap_easing",
        "Exit Animation GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type6']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_7",
        "Settings - Type 7",
        [c(
        "image",
        "Image",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "alt",
        "Alt",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "progress_gsap_easing",
        "Progress GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "scale",
        "Scale",
        [],
        ['type' => 'number', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "bar_scale_duration",
        "Bar Scale Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "bar_scale_gsap_easing",
        "Bar Scale GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_duration",
        "Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_gsap_easing",
        "Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type7']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_8",
        "Settings - Type 8",
        [c(
        "bars_duration",
        "Bars Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "bars_stagger",
        "Bars Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "bars_gsap_easing",
        "Bars GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "counter_exit_fade_duration",
        "Counter Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "counters_exit_fade_gsap_easing",
        "Counters Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type8']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_9",
        "Settings - Type 9",
        [c(
        "direction",
        "Direction",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'top', 'text' => 'Top'], ['text' => 'Bottom', 'value' => 'bottom']]],
        false,
        false,
        [],
      ), c(
        "bars_duration",
        "Bars Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "bars_stagger",
        "Bars Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "bars_gsap_easing",
        "Bars GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "counter_exit_fade_duration",
        "Counter Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "counter_exit_fade_gsap_easing",
        "Counter Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type9']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_10",
        "Settings - Type 10",
        [c(
        "image_1",
        "Image 1",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_1_alt_text",
        "Image 1 - Alt Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_2",
        "Image 2",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_2_alt_text",
        "Image 2 - Alt Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_3",
        "Image 3",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_3_alt_text",
        "Image 3 - Alt Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_4",
        "Image 4",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_4_alt_text",
        "Image 4 - Alt Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "image_reveal_duration",
        "Image Reveal Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "image_reveal_stagger",
        "Image Reveal Stagger",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "image_reveal_gsap_easing",
        "Image Reveal GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps'], ['text' => 'smoothBlur', 'value' => 'smoothBlur']]],
        false,
        false,
        [],
      ), c(
        "image_scale_duration",
        "Image Scale Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "image_scale_gsap_easing",
        "Image Scale GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "pause_after_zoom",
        "Pause after zoom",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type10']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_11",
        "Settings - Type 11",
        [c(
        "left_text",
        "Left Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "right_text",
        "Right Text",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "progress_gsap_easing",
        "Progress GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "progress_exit_fade_duration",
        "Progress Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "progress_exit_fade_gsap_easing",
        "Progress Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "slides_duration",
        "Slides Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "slides_gsap_easing",
        "Slides GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type11']]]],
        false,
        false,
        [],
      ), c(
        "settings_type_12",
        "Settings - Type 12",
        [c(
        "logo",
        "Logo",
        [],
        ['type' => 'wpmedia', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "alt",
        "Alt",
        [],
        ['type' => 'text', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "progress_from",
        "Progress from",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'left', 'text' => 'Left'], ['text' => 'Top', 'value' => 'top']]],
        false,
        false,
        [],
      ), c(
        "progress_gsap_easing",
        "Progress GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_duration",
        "Exit Fade Duration",
        [],
        ['type' => 'unit', 'layout' => 'inline', 'unitOptions' => ['types' => ['s']]],
        false,
        false,
        [],
      ), c(
        "exit_fade_gsap_easing",
        "Exit Fade GSAP Easing",
        [],
        ['type' => 'dropdown', 'layout' => 'inline', 'items' => [['value' => 'none', 'text' => 'none'], ['text' => 'power1', 'value' => 'power1'], ['text' => 'power2', 'value' => 'power2'], ['text' => 'power3', 'value' => 'power3'], ['text' => 'power4', 'value' => 'power4'], ['text' => 'back', 'value' => 'back'], ['text' => 'bounce', 'value' => 'bounce'], ['text' => 'circ', 'value' => 'circ'], ['text' => 'elastic', 'value' => 'elastic'], ['text' => 'expo', 'value' => 'expo'], ['text' => 'sine', 'value' => 'sine'], ['text' => 'steps', 'value' => 'steps']]],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical', 'condition' => [[['path' => 'content.site_loader.type', 'operand' => 'equals', 'value' => 'type12']]]],
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
                'title' => 'Dancepad - Site Loader',
                'scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Site_Loader/dancepad_site_loader.min.js?ver=' . DANCEPAD_VERSION],
            ],
            '1' => [
                'title' => 'Init Builder',
                'inlineScripts' => ['dancepad_site_loader();'],
                'builderCondition' => 'return true;',
                'frontendCondition' => 'return false;',
            ],
            '2' => [
                'title' => 'Init Front',
                'inlineScripts' => ['dancepad_site_loader();'],
                'builderCondition' => 'return false;',
                'frontendCondition' => 'return true;',
            ],
            '3' => [
                'title' => 'GSAP',
                'scripts' => ['%%BREAKDANCE_REUSABLE_GSAP%%'],
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

'onPropertyChange' => [['script' => 'dancepad_site_loader();',
],],

'onCreatedElement' => [['script' => 'dancepad_site_loader();',
],],

'onMountedElement' => [['script' => 'dancepad_site_loader();',
],],

'onMovedElement' => [['script' => 'dancepad_site_loader();',
],],

'onAfterDeletedElement' => [['script' => 'dancepad_site_loader();',
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
        return [['name' => 'data-disable-builder', 'template' => '{% if content.site_loader.disable_at_the_builder %}
1
{% else %}
0
{% endif %}'], ['name' => 'data-type', 'template' => '{{ content.site_loader.type }}'], ['name' => 'data-min-duration', 'template' => '{{ content.site_loader.min_loading_time.style }}'], ['name' => 'type1-data-swap-duration', 'template' => '{{ content.settings_type_1.swap_duration.style }}'], ['name' => 'type1-data-swap-stagger', 'template' => '{{ content.settings_type_1.swap_stagger.style }}'], ['name' => 'type1-data-swap-ease', 'template' => '{{ content.settings_type_1.swap_gsap_easing }}'], ['name' => 'type1-data-slide-duration', 'template' => '{{ content.settings_type_1.slide_duration.style }}'], ['name' => 'type1-data-slide-ease', 'template' => '{{ content.settings_type_1.slide_gsap_easing }}'], ['name' => 'type1-data-slide-delay', 'template' => '{{ content.settings_type_1.slide_delay.style }}'], ['name' => 'type2-data-progress-bar-ease', 'template' => '{{ content.settings_type_2.progress_bar_gsap_easing }}'], ['name' => 'type2-data-percentage-ease', 'template' => '{{ content.settings_type_2.percentage_gsap_easing }}'], ['name' => 'type2-data-slide-duration', 'template' => '{{ content.settings_type_2.slide_duration.style }}'], ['name' => 'type2-data-slide-delay', 'template' => '{{ content.settings_type_2.slide_delay.style }}'], ['name' => 'type2-data-slide-ease', 'template' => '{{ content.settings_type_2.slide_gsap_easing }}'], ['name' => 'type3-data-symbol', 'template' => '{{ content.settings_type_3.symbol }}'], ['name' => 'type3-data-terminal-finish-scale', 'template' => '{{ content.settings_type_3.finish_scale }}'], ['name' => 'type3-data-terminal-scale-duration', 'template' => '{{ content.settings_type_3.scale_duration.style }}'], ['name' => 'type3-data-terminal-scale-ease', 'template' => '{{ content.settings_type_3.scale_gsap_easing }}'], ['name' => 'type3-data-translate-commands-from', 'template' => '{{ content.settings_type_3.terminal_translate_from.style }}'], ['name' => 'type3-data-commands-duration', 'template' => '{{ content.settings_type_3.terminal_duration.style }}'], ['name' => 'type3-data-commands-ease', 'template' => '{{ content.settings_type_3.terminal_gsap_easing }}'], ['name' => 'type3-data-exit-fade-duration', 'template' => '{{ content.settings_type_3.exit_fade_duration.style }}'], ['name' => 'type3-data-exit-fade-ease', 'template' => '{{ content.settings_type_3.exit_fade_gsap_easing }}'], ['name' => 'type4-data-initial-loading-duration', 'template' => '{{ content.settings_type_4.initial_loading_duration.style }}'], ['name' => 'type4-data-initial-loading-ease', 'template' => '{{ content.settings_type_4.initial_loading_gsap_easing }}'], ['name' => 'type4-data-initial-loading-delay', 'template' => '{{ content.settings_type_4.initial_loading_delay.style }}'], ['name' => 'type4-data-progress-ease', 'template' => '{{ content.settings_type_4.progress_gsap_easing }}'], ['name' => 'type4-data-exit-slides-duration', 'template' => '{{ content.settings_type_4.exit_slides_duration.style }}'], ['name' => 'type4-data-exit-slides-ease', 'template' => '{{ content.settings_type_4.exit_slides_gsap_easing }}'], ['name' => 'type5-data-count-exit-fade-duration', 'template' => '{{ content.settings_type_5.count_exit_fade_duration.style }}'], ['name' => 'type5-data-count-exit-fade-ease', 'template' => '{{ content.settings_type_5.count_exit_fade_duration_gsap_easing }}'], ['name' => 'type5-data-swap-duration', 'template' => '{{ content.settings_type_5.swap_duration.style }}'], ['name' => 'type5-data-swap-ease', 'template' => '{{ content.settings_type_5.swap_stagger.style }}'], ['name' => 'type5-data-swap-stagger', 'template' => '{{ content.settings_type_5.swap_stagger.style }}'], ['name' => 'type5-data-loader-scale', 'template' => '{{ content.settings_type_5.loader_scale }}'], ['name' => 'type5-data-loader-scale-duration', 'template' => '{{ content.settings_type_5.loader_scale_duration.style }}'], ['name' => 'type5-data-loader-scale-ease', 'template' => '{{ content.settings_type_5.loader_scale_gsap_easing }}'], ['name' => 'type5-data-exit-slides-duration', 'template' => '{{ content.settings_type_5.exit_slides_duration.style }}'], ['name' => 'type5-data-exit-slides-ease', 'template' => '{{ content.settings_type_5.exit_slides_gsap_easing }}'], ['name' => 'type6-data-exit-counter-swap-duration', 'template' => '{{ content.settings_type_6.counter_swap_duration.style }}'], ['name' => 'type6-data-exit-counter-swap-stagger', 'template' => '{{ content.settings_type_6.counter_swap_stagger.style }}'], ['name' => 'type6-data-exit-counter-swap-ease', 'template' => '{{ content.settings_type_6.counter_swap_gsap_easing }}'], ['name' => 'type6-data-exit-type', 'template' => '{{ content.settings_type_6.exit_animation_type }}'], ['name' => 'type6-data-exit-type-duration', 'template' => '{{ content.settings_type_6.exit_animation_duration.style }}'], ['name' => 'type6-data-exit-type-ease', 'template' => '{{ content.settings_type_6.exit_animation_gsap_easing }}'], ['name' => 'type7-data-progress-ease', 'template' => '{{ content.settings_type_7.progress_gsap_easing }}'], ['name' => 'type7-data-bar-scale', 'template' => '{{ content.settings_type_7.scale }}'], ['name' => 'type7-data-bar-scale-duration', 'template' => '{{ content.settings_type_7.bar_scale_duration.style }}'], ['name' => 'type7-data-bar-scale-easing', 'template' => '{{ content.settings_type_7.bar_scale_gsap_easing }}'], ['name' => 'type7-data-exit-fade-duration', 'template' => '{{ content.settings_type_7.exit_fade_duration.style }}'], ['name' => 'type7-data-exit-fade-easing', 'template' => '{{ content.settings_type_7.exit_fade_gsap_easing }}'], ['name' => 'type8-data-bars-number', 'template' => '{{ design.styles_type_8.bars_number }}'], ['name' => 'type8-data-bars-duration', 'template' => '{{ content.settings_type_8.bars_duration.style }}'], ['name' => 'type8-data-bars-ease', 'template' => '{{ content.settings_type_8.bars_gsap_easing }}'], ['name' => 'type8-data-bars-stagger', 'template' => '{{ content.settings_type_8.bars_stagger.style }}'], ['name' => 'type8-data-counter-exit-fade-duration', 'template' => '{{ content.settings_type_8.counter_exit_fade_duration.style }}'], ['name' => 'type8-data-counter-exit-fade-ease', 'template' => '{{ content.settings_type_8.counter_exit_fade_gsap_easing }}'], ['name' => 'type9-data-bars-number', 'template' => '{{ design.styles_type_9.bars_number }}'], ['name' => 'type9-data-exit-direction', 'template' => '{{ content.settings_type_9.direction }}'], ['name' => 'type9-data-bars-duration', 'template' => '{{ content.settings_type_9.bars_duration.style }}'], ['name' => 'type9-data-bars-ease', 'template' => '{{ content.settings_type_9.bars_gsap_easing }}'], ['name' => 'type9-data-bars-stagger', 'template' => '{{ content.settings_type_9.bars_stagger.style }}'], ['name' => 'type9-data-counter-exit-fade-duration', 'template' => '{{ content.settings_type_9.counter_exit_fade_duration.style }}'], ['name' => 'type9-data-counter-exit-fade-ease', 'template' => '{{ content.settings_type_9.counter_exit_fade_gsap_easing }}'], ['name' => 'type10-data-img-reveal-duration', 'template' => '{{ content.settings_type_10.image_reveal_duration.style }}'], ['name' => 'type10-data-img-reveal-stagger', 'template' => '{{ content.settings_type_10.image_reveal_stagger.style }}'], ['name' => 'type10-data-img-reveal-ease', 'template' => '{{ content.settings_type_10.image_reveal_gsap_easing }}'], ['name' => 'type10-data-img-scale-duration', 'template' => '{{ content.settings_type_10.image_scale_duration.style }}'], ['name' => 'type10-data-img-scale-ease', 'template' => '{{ content.settings_type_10.image_scale_gsap_easing }}'], ['name' => 'type10-data-pause-after-zoom', 'template' => '{{ content.settings_type_10.pause_after_zoom.style }}'], ['name' => 'type11-data-progress-ease', 'template' => '{{ content.settings_type_11.progress_gsap_easing }}'], ['name' => 'type11-data-progress-exit-fade-duration', 'template' => '{{ content.settings_type_11.progress_exit_fade_duration.style }}'], ['name' => 'type11-data-progress-exit-fade-ease', 'template' => '{{ content.settings_type_11.progress_exit_fade_gsap_easing }}'], ['name' => 'type11-data-slides-duration', 'template' => '{{ content.settings_type_11.slides_duration.style }}'], ['name' => 'type11-data-slides-ease', 'template' => '{{ content.settings_type_11.slides_gsap_easing }}'], ['name' => 'type12-data-progress-from', 'template' => '{{ content.settings_type_12.progress_from }}'], ['name' => 'type12-data-progress-ease', 'template' => '{{ content.settings_type_12.progress_gsap_easing }}'], ['name' => 'type12-data-exit-fade-duration', 'template' => '{{ content.settings_type_12.exit_fade_duration.style }}'], ['name' => 'type12-data-exit-fade-ease', 'template' => '{{ content.settings_type_12.exit_fade_gsap_easing }}']];
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
        return [['accepts' => 'image_url', 'path' => 'design.toasts.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.close_button.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.styles_type_3.terminal_background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.styles_type_3.loading_container_background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.styles_type_8.background.layers[].image']];
    }

    static function additionalClasses()
    {
        return [['name' => 'dan-site-loader--type1', 'template' => '{% if content.site_loader.type == \'type1\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type2', 'template' => '{% if content.site_loader.type == \'type2\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type3', 'template' => '{% if content.site_loader.type == \'type3\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type4', 'template' => '{% if content.site_loader.type == \'type4\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type5', 'template' => '{% if content.site_loader.type == \'type5\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type6', 'template' => '{% if content.site_loader.type == \'type6\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type7', 'template' => '{% if content.site_loader.type == \'type7\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type8', 'template' => '{% if content.site_loader.type == \'type8\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type9', 'template' => '{% if content.site_loader.type == \'type9\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type10', 'template' => '{% if content.site_loader.type == \'type10\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type11', 'template' => '{% if content.site_loader.type == \'type11\' %}
1
{% endif %}'], ['name' => 'dan-site-loader--type12', 'template' => '{% if content.site_loader.type == \'type12\' %}
1
{% endif %}']];
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