<?php

namespace Dancepad;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;

if(get_option('dan_dropdown_enable') == 'true'){
    \Breakdance\ElementStudio\registerElementForEditing(
        "Dancepad\\Dropdown",
        \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
    );
    
    class Dropdown extends \Breakdance\Elements\Element
    {
        static function uiIcon()
        {
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#cacaca" fill="none">
                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M6.46915 2.25H6.53085C7.11718 2.24999 7.60234 2.24998 7.99782 2.28229C8.40897 2.31589 8.78878 2.38811 9.1461 2.57017C9.69882 2.8518 10.1482 3.30118 10.4298 3.8539C10.6119 4.21122 10.6841 4.59103 10.7177 5.00218C10.75 5.39766 10.75 5.88283 10.75 6.46916V6.53084C10.75 7.11717 10.75 7.60234 10.7177 7.99782C10.6841 8.40897 10.6119 8.78878 10.4298 9.1461C10.1482 9.69882 9.69882 10.1482 9.1461 10.4298C8.78878 10.6119 8.40897 10.6841 7.99782 10.7177C7.60234 10.75 7.11717 10.75 6.53084 10.75H6.46916C5.88283 10.75 5.39766 10.75 5.00218 10.7177C4.59103 10.6841 4.21122 10.6119 3.8539 10.4298C3.30118 10.1482 2.8518 9.69882 2.57017 9.1461C2.38811 8.78878 2.31589 8.40897 2.28229 7.99782C2.24998 7.60234 2.24999 7.11718 2.25 6.53085V6.46915C2.24999 5.88282 2.24998 5.39766 2.28229 5.00218C2.31589 4.59103 2.38811 4.21122 2.57017 3.8539C2.8518 3.30118 3.30118 2.8518 3.8539 2.57017C4.21122 2.38811 4.59103 2.31589 5.00218 2.28229C5.39766 2.24998 5.88282 2.24999 6.46915 2.25Z" fill="currentColor" />
                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M6.46915 13.25H6.53085C7.11718 13.25 7.60234 13.25 7.99782 13.2823C8.40897 13.3159 8.78878 13.3881 9.1461 13.5702C9.69882 13.8518 10.1482 14.3012 10.4298 14.8539C10.6119 15.2112 10.6841 15.591 10.7177 16.0022C10.75 16.3977 10.75 16.8828 10.75 17.4692V17.5308C10.75 18.1172 10.75 18.6023 10.7177 18.9978C10.6841 19.409 10.6119 19.7888 10.4298 20.1461C10.1482 20.6988 9.69882 21.1482 9.1461 21.4298C8.78878 21.6119 8.40897 21.6841 7.99782 21.7177C7.60234 21.75 7.11717 21.75 6.53084 21.75H6.46916C5.88283 21.75 5.39766 21.75 5.00218 21.7177C4.59103 21.6841 4.21122 21.6119 3.8539 21.4298C3.30118 21.1482 2.8518 20.6988 2.57017 20.1461C2.38811 19.7888 2.31589 19.409 2.28229 18.9978C2.24998 18.6023 2.24999 18.1172 2.25 17.5309V17.4692C2.24999 16.8828 2.24998 16.3977 2.28229 16.0022C2.31589 15.591 2.38811 15.2112 2.57017 14.8539C2.8518 14.3012 3.30118 13.8518 3.8539 13.5702C4.21122 13.3881 4.59103 13.3159 5.00218 13.2823C5.39766 13.25 5.88282 13.25 6.46915 13.25Z" fill="currentColor" />
                <path d="M17 15.4997V14.5377C17 12.2141 16.9791 11.3578 16.6425 10.616C16.306 9.87422 15.6753 9.29463 13.9266 7.76451L13.3415 7.25259C12.9259 6.88891 12.8838 6.25715 13.2474 5.84151C13.6111 5.42587 14.2429 5.38376 14.6585 5.74744L15.4123 6.40689C16.9301 7.73405 17.9264 8.60522 18.4638 9.78956C19.0012 10.9739 19.0008 12.2974 19.0001 14.3136L19 15.4997L19.5885 15.4997C19.7641 15.4996 19.9798 15.4994 20.1562 15.5215L20.1596 15.5219C20.286 15.5377 20.8621 15.6095 21.1364 16.1751C21.4114 16.7419 21.1095 17.2421 21.0441 17.3503L20.705 17.8188C20.4104 18.1946 20.0047 18.7091 19.6242 19.1001C19.4344 19.2952 19.2171 19.4964 18.9862 19.6553C18.781 19.7965 18.4308 19.9997 18.0001 19.9997C17.5694 19.9997 17.2193 19.7965 17.014 19.6553C16.7831 19.4964 16.5658 19.2952 16.376 19.1001C15.9956 18.7091 15.5899 18.1946 15.2952 17.8188L14.9561 17.3503C14.8908 17.2421 14.5888 16.7419 14.8638 16.1751C15.1382 15.6095 15.7142 15.5377 15.8406 15.5219L15.844 15.5215C16.0204 15.4994 16.2361 15.4996 16.4117 15.4997L17 15.4997Z" fill="currentColor" />
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
            return 'Dropdown';
        }
    
        static function className()
        {
            return 'dan-dropdown-wrapper';
        }
    
        static function category()
        {
            return 'dancepad_menus';
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
            return [['slug' => 'EssentialElements\Div', 'defaultProperties' => ['meta' => ['friendlyName' => 'Toggle'], 'settings' => ['advanced' => ['classes' => ['dan-dropdown-toggle'], 'css' => ['breakpoint_base' => '%%SELECTOR%% {
          cursor: pointer;
        }']]], 'design' => ['layout_v2' => ['layout' => 'horizontal', 'h_vertical_align' => ['breakpoint_base' => 'center'], 'h_gap' => ['breakpoint_base' => null]], 'container' => ['padding' => ['padding' => ['breakpoint_base' => ['top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'left' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]]], 'background' => ['color' => '#000']]], 'children' => [['slug' => 'EssentialElements\Heading', 'defaultProperties' => ['content' => ['content' => ['text' => 'Toggle', 'tags' => 'h3']], 'design' => ['typography' => ['color' => ['breakpoint_base' => '#fff'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontWeight' => ['breakpoint_base' => '500']]]]]]], 'children' => []], ['slug' => 'Dancepad\ArrowIcon', 'defaultProperties' => ['content' => ['content' => ['text' => 'Arrow Icon', 'tag' => 'span', 'link' => null, 'top_arrow_text' => 'Top Arrow', 'bottom_arrow_text' => 'Bottom arrow', 'arrow_text' => 'Arrow Icon', 'swap_text' => 'Swapped!', 'white_space' => 'wrap'], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'fromTop', 'distance_dynamic_meta' => null, 'skew' => ['number' => 10, 'unit' => 'deg', 'style' => '10deg'], 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.22, 1, 0.36, 1)', 'type' => 'dan-arrow-icon--from-top', 'amplitude' => ['number' => 0, 'unit' => '%', 'style' => '0%'], 'in_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'out_duration' => ['number' => 0.8, 'unit' => 's', 'style' => '0.8s'], 'scale' => 1.3, 'scale_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'scale_easing' => 'cubic-bezier(.76,0,.24,1)', 'scale_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate_easing' => 'ease-out', 'translate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'translate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'translate' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'rotate_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'rotate_duration' => ['number' => 0.4, 'unit' => 's', 'style' => '0.4s'], 'rotate' => ['number' => -90, 'unit' => 'deg', 'style' => '-90deg'], 'rotate_easing' => 'cubic-bezier(.76,0,.24,1)', 'arrow_speed' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'arrow_easing' => 'linear', 'swap_easing' => 'ease-out', 'swap_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'swap_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'background_duration' => ['number' => 0.25, 'unit' => 's', 'style' => '0.25s'], 'background_easing' => 'ease-out', 'background_delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'arrow_gap' => ['number' => 15, 'unit' => 'px', 'style' => '15px'], 'repeats' => 8, 'repeats_gap' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'animation_duration' => ['number' => 3, 'unit' => 's', 'style' => '3s'], 'fade_duration' => ['number' => 0.5, 'unit' => 's', 'style' => '0.5s'], 'spark_dimensions' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'toggle' => null, 'event' => 'hover', 'enable_scale' => false, 'enable_rotate' => true, 'enable_translate' => false, 'scale_css_easing' => 'ease', 'rotate_css_easing' => 'ease', 'distance_between_arrows' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'translate_css_easing' => 'ease'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor'], 'spark' => ['color' => 'rgba(0,0,0,.5)', 'path_color' => 'white', 'dimensions' => ['number' => 2, 'unit' => 'px', 'style' => '2px'], 'animation_duration' => ['number' => 5, 'unit' => 's', 'style' => '5s']], 'accessibility' => null], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => null, 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']], 'fontFamily_hover' => null, 'fontSize_hover' => null, 'advanced' => ['lineHeight' => ['breakpoint_base' => ['number' => 'normal', 'unit' => 'custom', 'style' => 'normal']]]]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]], 'padding' => ['padding' => ['breakpoint_base' => ['top' => null]]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']], 'border' => null], 'background' => null, 'mask_typography' => ['color' => ['breakpoint_base' => '#FFF']], 'margin' => ['margin' => ['breakpoint_base' => ['top' => null]]], 'top_arrow' => ['background' => 'greenyellow', 'text_color' => 'black'], 'bottom_arrow' => ['background' => 'black', 'text_color' => 'white'], 'mask_colors' => ['text_color' => 'white', 'background' => 'black'], 'icon_colors' => ['text_color' => 'black', 'background' => '#e3e3e3'], 'icon_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => ['breakpoint_base' => ['number' => 20, 'unit' => 'px', 'style' => '20px']]]]], 'color' => ['breakpoint_base' => '#000000FF']], 'arrow_typography' => ['typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontSize_hover' => null]]]], 'icon_background' => ['background' => '#e3e3e3'], 'arrow_styles' => ['size_scale_' => 0.3, 'type' => 'type3', 'rotation' => ['number' => 90, 'unit' => 'deg', 'style' => '90deg'], 'color' => '#fff'], 'border' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'topRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomLeft' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'bottomRight' => ['number' => 50, 'unit' => 'px', 'style' => '50px'], 'editMode' => 'all']]], 'dimensions' => ['width' => ['number' => 30, 'unit' => 'px', 'style' => '30px'], 'height' => ['number' => 30, 'unit' => 'px', 'style' => '30px']], 'size' => ['width' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']], 'height' => ['breakpoint_base' => ['number' => 27, 'unit' => 'px', 'style' => '27px']]]]], 'children' => []]]], ['slug' => 'Dancepad\DropdownElement', 'defaultProperties' => ['content' => ['settings' => ['event' => 'hover', 'open_at_the_builder' => false], 'fade_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease'], 'transform_animation' => ['duration' => ['number' => 0.2, 'unit' => 's', 'style' => '0.2s'], 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'css_easing' => 'ease', 'scale' => 0, 'transform_x' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'transform_y' => ['number' => -30, 'unit' => 'px', 'style' => '-30px']]], 'design' => ['positioning' => ['position' => ['breakpoint_base' => 'absolute'], 'toggled_position' => ['breakpoint_base' => 'absolute'], 'top' => null, 'bottom' => null, 'left' => null, 'right' => null], 'mask' => ['padding_right' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_left' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_bottom' => ['breakpoint_base' => ['number' => 0, 'unit' => 'px', 'style' => '0px']], 'padding_top' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'topRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomLeft' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottomRight' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'editMode' => 'all']]], 'background' => ['color' => ['breakpoint_base' => '#000']], 'layout' => ['display' => ['breakpoint_base' => 'flex'], 'flex_direction' => ['breakpoint_base' => 'column'], 'gap' => ['breakpoint_base' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'right' => ['number' => 16, 'unit' => 'px', 'style' => '16px'], 'top' => ['number' => 12, 'unit' => 'px', 'style' => '12px'], 'bottom' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]], 'margin' => ['margin' => ['breakpoint_base' => ['top' => ['number' => 12, 'unit' => 'px', 'style' => '12px']]]]]], 'children' => [['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]], 'settings' => ['advanced' => ['classes' => null]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []], ['slug' => 'Dancepad\UnderlineHover', 'defaultProperties' => ['content' => ['content' => ['text' => 'Drop item', 'tag' => 'span', 'link' => null], 'animation' => ['duration' => ['number' => 0.6, 'unit' => 's', 'style' => '0.6s'], 'distance' => ['number' => 100, 'unit' => '%', 'style' => '100%'], 'split_type' => 'chars', 'from' => 'bottom', 'distance_dynamic_meta' => null, 'skew' => 0, 'stagger' => 0.05, 'delay' => ['number' => 0, 'unit' => 's', 'style' => '0s'], 'gsap_easing' => 'power3', 'blur' => ['number' => 20, 'unit' => 'px', 'style' => '20px'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'type' => 'Side to Side'], 'scrolltrigger' => ['additional_triggers' => null, 'trigger' => 'this', 'start' => 'top bottom', 'end' => 'unset', 'toggleactions' => 'play none none none'], 'underline' => ['type' => 'Side to Side', 'bottom_distance' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'thickness' => ['number' => 1, 'unit' => 'px', 'style' => '1px'], 'initial_width' => ['number' => 0, 'unit' => 'px', 'style' => '0px'], 'duration' => ['number' => 0.7, 'unit' => 's', 'style' => '0.7s'], 'css_easing' => 'cubic-bezier(0.16, 1, 0.3, 1)', 'color' => 'currentColor']], 'design' => ['typography' => ['text' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['number' => 75, 'unit' => 'px', 'style' => '75px'], 'advanced' => ['letterSpacing' => null]]]], 'color' => ['breakpoint_base' => '#fff'], 'color_hover' => null, 'typography' => ['custom' => ['customTypography' => ['fontFamily' => null, 'fontSize' => ['breakpoint_base' => ['number' => 16, 'unit' => 'px', 'style' => '16px']], 'fontFamily_hover' => null, 'fontSize_hover' => null]]]], 'elements_hive' => ['backlight' => ['enabled' => false]], 'style' => ['new_control' => ['label' => 'Preset 0', 'id' => 'preset-id-72d05461-b30c-4ca4-be1a-3a678f1d3fcf'], 'typography' => ['custom' => ['customTypography' => ['fontSize' => null, 'fontFamily' => null]]]]]], 'children' => []]]]];
        }
    
        static function cssTemplate()
        {
            $template = file_get_contents(__DIR__ . '/css.twig');
            return $template;
        }
    
        static function designControls()
        {
            return [];
        }
    
        static function contentControls()
        {
            return [c(
            "settings",
            "Settings",
            [c(
            "note",
            "Note",
            [],
            ['type' => 'alert_box', 'layout' => 'vertical', 'alertBoxOptions' => ['style' => 'default', 'content' => '<p>If Dropdown element and Arrow Icon are inside Dropdown then the Dropdown will be taken as the Toggle selector at both of them.</p>']],
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
            return ['0' =>  ['title' => 'Dancepad - Dropdown','scripts' => [DANCEPAD_PLUGIN_URL . 'elements/Dropdown/dancepad_dropdown.min.js?ver=' . DANCEPAD_VERSION],],'1' =>  ['title' => 'Init Builder','inlineScripts' => ['dancepad_dropdown();'],'builderCondition' => 'return true;','frontendCondition' => 'return false;',],'2' =>  ['title' => 'Init Front','inlineScripts' => ['dancepad_dropdown();'],'builderCondition' => 'return false;','frontendCondition' => 'return true;',],];
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
    
    'onPropertyChange' => [['script' => 'dancepad_dropdown();',
    ],],
    
    'onCreatedElement' => [['script' => 'dancepad_dropdown();',
    ],],
    
    'onMountedElement' => [['script' => 'dancepad_dropdown();',
    ],],
    
    'onMovedElement' => [['script' => 'dancepad_dropdown();',
    ],],
    
    'onAfterDeletedElement' => [['script' => 'dancepad_dropdown();',
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
            return [['accepts' => 'string', 'path' => 'content.content.text'], ['accepts' => 'string', 'path' => 'content.animation.distance'], ['accepts' => 'image_url', 'path' => 'design.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.items_style.background.layers[].image'], ['accepts' => 'image_url', 'path' => 'design.tooltip_style.background.layers[].image']];
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
