<?php

namespace Dancepad;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dan_active_tab'])) {
        update_option('dan_active_tab', sanitize_text_field($_POST['dan_active_tab']));
    }
}
function save_text_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_texts'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_button_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_buttons'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_menu_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_menus'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_media_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_medias'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_cursor_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_cursors'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_slider_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_sliders'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_background_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_backgrounds'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_core_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_cores'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'false');
    return $checkbox_value;
}
function save_library_checkbox_option($option_name, $checkbox_name) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_libraries'])) {
        $checkbox_value = isset($_POST[$checkbox_name]) ? 'true' : 'false';
        update_option($option_name, $checkbox_value);
    }

    $checkbox_value = get_option($option_name, 'true');
    return $checkbox_value;
}
//Texts
$dan_toggle_all_texts_enable = save_text_checkbox_option('dan_toggle_all_texts_enable', 'paneldantogglealltexts');
$dan_blade_reveal_enable = save_text_checkbox_option('dan_blade_reveal_enable', 'paneldanbladereveal');
$dan_twist_reveal_enable = save_text_checkbox_option('dan_twist_reveal_enable', 'paneldantwistreveal');
$dan_blur_reveal_enable = save_text_checkbox_option('dan_blur_reveal_enable', 'paneldanblurreveal');
$dan_letter_launcher_enable = save_text_checkbox_option('dan_letter_launcher_enable', 'paneldanletterlauncher');
$dan_random_letters_enable = save_text_checkbox_option('dan_random_letters_enable', 'paneldanrandomletters');
$dan_unfold_reveal_enable = save_text_checkbox_option('dan_unfold_reveal_enable', 'paneldanunfoldreveal');
$dan_decode_reveal_enable = save_text_checkbox_option('dan_decode_reveal_enable', 'paneldandecodereveal');
$dan_counter_enable = save_text_checkbox_option('dan_counter_enable', 'paneldancounter'); 
$dan_underline_hover_enable = save_text_checkbox_option('dan_underline_hover_enable', 'paneldanunderlinehover');
$dan_highlight_hover_enable = save_text_checkbox_option('dan_highlight_hover_enable', 'paneldanhighlighthover');
$dan_swap_hover_enable = save_text_checkbox_option('dan_swap_hover_enable', 'paneldanswaphover');
$dan_3d_swap_hover_enable = save_text_checkbox_option('dan_3d_swap_hover_enable', 'paneldan3dswaphover');
$dan_blended_hover_enable = save_text_checkbox_option('dan_blended_hover_enable', 'paneldanblendedhover');
$dan_decode_hover_enable = save_text_checkbox_option('dan_decode_hover_enable', 'paneldandecodehover');
$dan_unfold_hover_enable = save_text_checkbox_option('dan_unfold_hover_enable', 'paneldanunfoldhover');
$dan_arc_title_enable = save_text_checkbox_option('dan_arc_title_enable', 'paneldanarctitle');
$dan_typed_enable = save_text_checkbox_option('dan_typed_enable', 'paneldantyped');
$dan_fluid_gradient_enable = save_text_checkbox_option('dan_fluid_gradient_enable', 'paneldanfluidgradient');
$dan_looping_lines_enable = save_text_checkbox_option('dan_looping_lines_enable', 'paneldanloopinglines');
$dan_mousefill_title_enable = save_text_checkbox_option('dan_mousefill_title_enable', 'paneldanmousefilltitle');
$dan_scroll_reading_enable = save_text_checkbox_option('dan_scroll_reading_enable', 'paneldanscrollreading');
$dan_blur_reading_enable = save_text_checkbox_option('dan_blur_reading_enable', 'paneldanblurreading');
$dan_text_shimmer_enable = save_text_checkbox_option('dan_text_shimmer_enable', 'paneldantextshimmer');
$dan_shading_lines_title_enable = save_text_checkbox_option('dan_shading_lines_title_enable', 'paneldanshadinglinestitle');
$dan_looping_lines_v2_enable = save_text_checkbox_option('dan_looping_lines_v2_enable', 'paneldanloopinglinesv2');
$dan_dynamic_copyright_enable = save_text_checkbox_option('dan_dynamic_copyright_enable', 'paneldandynamiccopyright');
$dan_proximity_weight_enable = save_text_checkbox_option('dan_proximity_weight_enable', 'paneldanproximityweight');
$dan_swap_reading_enable = save_text_checkbox_option('dan_swap_reading_enable', 'paneldanswapreading');
$dan_highlight_enable = save_text_checkbox_option('dan_highlight_enable', 'paneldanhighlight'); /*v2*/
$dan_link_preview_enable = save_text_checkbox_option('dan_link_preview_enable', 'paneldanlinkpreview'); /*v2*/
$dan_read_more_enable = save_text_checkbox_option('dan_read_more_enable', 'paneldanreadmore'); /*v2*/

//Buttons
$dan_toggle_all_buttons_enable = save_button_checkbox_option('dan_toggle_all_buttons_enable', 'paneldantoggleallbuttons');
$dan_anyside_button = save_button_checkbox_option('dan_anyside_button', 'paneldananysidebutton');
$dan_arrow_button = save_button_checkbox_option('dan_arrow_button', 'paneldanarrowbutton');
$dan_arrow_icon_enable = save_button_checkbox_option('dan_arrow_icon_enable', 'paneldanarrowicon');
$dan_crystal_button = save_button_checkbox_option('dan_crystal_button', 'paneldancrystalbutton');
$dan_glowing_button_enable = save_button_checkbox_option('dan_glowing_button_enable', 'paneldanglowingbutton');
$dan_marquee_button_enable = save_button_checkbox_option('dan_marquee_button_enable', 'paneldanmarqueebutton');
$dan_marquee_button_v2_enable = save_button_checkbox_option('dan_marquee_button_v2_enable', 'paneldanmarqueebuttonv2');
$dan_mask_button_enable = save_button_checkbox_option('dan_mask_button_enable', 'paneldanmaskbutton');
$dan_modal_button_enable = save_button_checkbox_option('dan_modal_button_enable', 'paneldanmodalbutton');
$dan_prism_button_enable = save_button_checkbox_option('dan_prism_button_enable', 'paneldanprismbutton');
$dan_ripple_button_enable = save_button_checkbox_option('dan_ripple_button_enable', 'paneldanripplebutton');
$dan_ripple_button_v2_enable = save_button_checkbox_option('dan_ripple_button_v2_enable', 'paneldanripplebuttonv2');
$dan_ripple_button_v3_enable = save_button_checkbox_option('dan_ripple_button_v3_enable', 'paneldanripplebuttonv3');
$dan_layer_button_enable = save_button_checkbox_option('dan_layer_button_enable', 'paneldanlayerbutton');
$dan_shiny_button_enable = save_button_checkbox_option('dan_shiny_button_enable', 'paneldanshinybutton');
$dan_arrow_button_v2_enable = save_button_checkbox_option('dan_arrow_button_v2_enable', 'paneldanarrowbuttonv2');
$dan_arrow_button_v3_enable = save_button_checkbox_option('dan_arrow_button_v3_enable', 'paneldanarrowbuttonv3');
$dan_rainbow_button_enable = save_button_checkbox_option('dan_rainbow_button_enable', 'paneldanrainbowbutton');
$dan_arrow_button_v4_enable = save_button_checkbox_option('dan_arrow_button_v4_enable', 'paneldanarrowbuttonv4'); /*v2*/
$dan_arrow_button_v5_enable = save_button_checkbox_option('dan_arrow_button_v5_enable', 'paneldanarrowbuttonv5'); /*v2*/
$dan_arrow_button_v6_enable = save_button_checkbox_option('dan_arrow_button_v6_enable', 'paneldanarrowbuttonv6'); /*v2*/
$dan_arrow_button_v7_enable = save_button_checkbox_option('dan_arrow_button_v7_enable', 'paneldanarrowbuttonv7'); /*v2*/
$dan_arrow_button_v8_enable = save_button_checkbox_option('dan_arrow_button_v8_enable', 'paneldanarrowbuttonv8'); /*v2*/
$dan_blurry_button_enable = save_button_checkbox_option('dan_blurry_button_enable', 'paneldanblurrybutton'); /*v2*/
$dan_bubbles_button_enable = save_button_checkbox_option('dan_bubbles_button_enable', 'paneldanbubblesbutton'); /*v2*/
$dan_dot_button_enable = save_button_checkbox_option('dan_dot_button_enable', 'paneldandotbutton'); /*v2*/
$dan_dot_button_v2_enable = save_button_checkbox_option('dan_dot_button_v2_enable', 'paneldandotbuttonv2'); /*v2*/
$dan_dot_button_v3_enable = save_button_checkbox_option('dan_dot_button_v3_enable', 'paneldandotbuttonv3'); /*v2*/
$dan_flipflop_button_enable = save_button_checkbox_option('dan_flipflop_button_enable', 'paneldanflipflopbutton'); /*v2*/
$dan_flipflop_button_v2_enable = save_button_checkbox_option('dan_flipflop_button_v2_enable', 'paneldanflipflopbuttonv2'); /*v2*/
$dan_flipflop_button_v3_enable = save_button_checkbox_option('dan_flipflop_button_v3_enable', 'paneldanflipflopbuttonv3'); /*v2*/
$dan_nudge_button_enable = save_button_checkbox_option('dan_nudge_button_enable', 'paneldannudgebutton'); /*v2*/
$dan_pixels_button_enable = save_button_checkbox_option('dan_pixels_button_enable', 'paneldanpixelsbutton'); /*v2*/
$dan_prism_button_v2_enable = save_button_checkbox_option('dan_prism_button_v2_enable', 'paneldanprismbuttonv2'); /*v2*/
$dan_reel_button_enable = save_button_checkbox_option('dan_reel_button_enable', 'paneldanreelbutton'); /*v2*/
$dan_ripple_button_v4_enable = save_button_checkbox_option('dan_ripple_button_v4_enable', 'paneldanripplebuttonv4'); /*v2*/
$dan_ripple_button_v5_enable = save_button_checkbox_option('dan_ripple_button_v5_enable', 'paneldanripplebuttonv5'); /*v2*/
$dan_ripple_button_v6_enable = save_button_checkbox_option('dan_ripple_button_v6_enable', 'paneldanripplebuttonv6'); /*v2*/
$dan_ripple_button_v7_enable = save_button_checkbox_option('dan_ripple_button_v7_enable', 'paneldanripplebuttonv7'); /*v2*/
$dan_squeezy_radius_button_enable = save_button_checkbox_option('dan_squeezy_radius_button_enable', 'paneldansqueezyradiusbutton'); /*v2*/
$dan_stretchy_button_enable = save_button_checkbox_option('dan_stretchy_button_enable', 'paneldanstretchybutton'); /*v2*/
$dan_strip_button_enable = save_button_checkbox_option('dan_strip_button_enable', 'paneldanstripbutton'); /*v2*/
$dan_stripes_button_enable = save_button_checkbox_option('dan_stripes_button_enable', 'paneldanstripesbutton'); /*v2*/

//Menus
$dan_toggle_all_menus_enable = save_menu_checkbox_option('dan_toggle_all_menus_enable', 'paneldantoggleallmenus');
$dan_sticky_header_enable = save_menu_checkbox_option('dan_sticky_header_enable', 'paneldanstickyheader');
$dan_burger_enable = save_menu_checkbox_option('dan_burger_enable', 'paneldanburger');
$dan_dock_enable = save_menu_checkbox_option('dan_dock_enable', 'paneldandock');
$dan_drawer_enable = save_menu_checkbox_option('dan_drawer_enable', 'paneldandrawer');
$dan_dropdown_enable = save_menu_checkbox_option('dan_dropdown_enable', 'paneldandropdown');
$dan_dropdown_mega_menu_enable = save_menu_checkbox_option('dan_dropdown_mega_menu_enable', 'paneldandropdownmegamenu');
$dan_morphing_nav_enable = save_menu_checkbox_option('dan_morphing_nav_enable', 'paneldanmorphingnav');
$dan_overlay_menu_enable = save_menu_checkbox_option('dan_overlay_menu_enable', 'paneldanoverlaymenu');
$dan_offcanvas_menu_enable = save_menu_checkbox_option('dan_offcanvas_menu_enable', 'paneldanoffcanvasmenu');
$dan_expanding_menu_enable = save_menu_checkbox_option('dan_expanding_menu_enable', 'paneldanexpandingmenu');
$dan_circular_menu_enable = save_menu_checkbox_option('dan_circular_menu_enable', 'paneldancircularmenu');
$dan_multi_offcanvas_menu_enable = save_menu_checkbox_option('dan_multi_offcanvas_menu_enable', 'paneldanmultioffcanvasmenu');
$dan_dynamic_island_enable = save_menu_checkbox_option('dan_dynamic_island_enable', 'paneldandynamicisland');
$dan_focus_nav_enable = save_menu_checkbox_option('dan_focus_nav_enable', 'paneldanfocusnav');
$dan_gooey_nav_enable = save_menu_checkbox_option('dan_gooey_nav_enable', 'paneldangooeynav');

//Medias
$dan_toggle_all_medias_enable = save_media_checkbox_option('dan_toggle_all_medias_enable', 'paneldantoggleallmedias');
$dan_image_reveal_enable = save_media_checkbox_option('dan_image_reveal_enable', 'paneldanimagereveal');
$dan_before_after_image_enable = save_media_checkbox_option('dan_before_after_image_enable', 'paneldanbeforeafterimage');
$dan_parallax_enable = save_media_checkbox_option('dan_parallax_enable', 'paneldanparallax');
$dan_image_hotspots_enable = save_media_checkbox_option('dan_image_hotspots_enable', 'paneldanimagehotspots');
$dan_beforeafter_image_v2_enable = save_media_checkbox_option('dan_beforeafter_image_v2_enable', 'paneldanbeforeafterimagev2'); /*v2*/
$dan_image_reveal_v2_enable = save_media_checkbox_option('dan_image_reveal_v2_enable', 'paneldanimagerevealv2'); /*v2*/
$dan_image_reveal_v3_enable = save_media_checkbox_option('dan_image_reveal_v3_enable', 'paneldanimagerevealv3'); /*v2*/
$dan_image_reveal_v4_enable = save_media_checkbox_option('dan_image_reveal_v4_enable', 'paneldanimagerevealv4'); /*v2*/
$dan_lightbox_enable = save_media_checkbox_option('dan_lightbox_enable', 'paneldanlightbox'); /*v2*/
$dan_scrolling_gallery_enable = save_media_checkbox_option('dan_scrolling_gallery_enable', 'paneldanscrollinggallery'); /*v2*/

//Cursors
$dan_toggle_all_cursors_enable = save_cursor_checkbox_option('dan_toggle_all_cursors_enable', 'paneldantoggleallcursors');
$dan_cursor_enable = save_cursor_checkbox_option('dan_cursor_enable', 'paneldancursor');
$dan_designer_cursor_enable = save_cursor_checkbox_option('dan_designer_cursor_enable', 'paneldandesignercursor');
$dan_cursor_slide_enable = save_cursor_checkbox_option('dan_cursor_slide_enable', 'paneldancursor_slide');
$dan_cursor_trail_enable = save_cursor_checkbox_option('dan_cursor_trail_enable', 'paneldancursortrail');
$dan_crosshair_enable = save_cursor_checkbox_option('dan_crosshair_enable', 'paneldancrosshair'); /*v2*/

//Sliders
$dan_toggle_all_sliders_enable = save_slider_checkbox_option('dan_toggle_all_sliders_enable', 'paneldantoggleallsliders');
$dan_parallax_slider_enable = save_slider_checkbox_option('dan_parallax_slider_enable', 'paneldanparallaxslider');
$dan_infinite_slider_enable = save_slider_checkbox_option('dan_infinite_slider_enable', 'paneldaninfiniteslider');
$dan_stories_enable = save_slider_checkbox_option('dan_stories_enable', 'paneldanstories'); /*v2*/
$dan_thumbnail_slider_enable = save_slider_checkbox_option('dan_thumbnail_slider_enable', 'paneldanthumbnailslider'); /*v2*/

//Backgrounds
$dan_toggle_all_backgrounds_enable = save_background_checkbox_option('dan_toggle_all_backgrounds_enable', 'paneldantoggleallbackgrounds');
$dan_border_beam_enable = save_background_checkbox_option('dan_border_beam_enable', 'paneldanborderbeam');
$dan_fluids_enable = save_background_checkbox_option('dan_fluids_enable', 'paneldanfluids');
$dan_gradiently_enable = save_background_checkbox_option('dan_gradiently_enable', 'paneldangradiently');
$dan_particles_enable = save_background_checkbox_option('dan_particles_enable', 'paneldanparticles');
$dan_spotlight_enable = save_background_checkbox_option('dan_spotlight_enable', 'paneldanspotlight');
$dan_spotlight_v2_enable = save_background_checkbox_option('dan_spotlight_v2_enable', 'paneldanspotlightv2');
$dan_tiles_enable = save_background_checkbox_option('dan_tiles_enable', 'paneldantiles');
$dan_physics_enable = save_background_checkbox_option('dan_physics_enable', 'paneldanphysics');
$dan_grainy_enable = save_background_checkbox_option('dan_grainy_enable', 'paneldangrainy');
$dan_interactive_lines_enable = save_background_checkbox_option('dan_interactive_lines_enable', 'paneldaninteractivelines');
$dan_tiles_v2_enable = save_background_checkbox_option('dan_tiles_v2_enable', 'paneldantilesv2');
$dan_interactive_lines_v2_enable = save_background_checkbox_option('dan_interactive_lines_v2_enable', 'paneldaninteractivelinesv2'); /*v2*/
$dan_interactive_lines_v3_enable = save_background_checkbox_option('dan_interactive_lines_v3_enable', 'paneldaninteractivelinesv3'); /*v2*/
$dan_interactive_lines_v4_enable = save_background_checkbox_option('dan_interactive_lines_v4_enable', 'paneldaninteractivelinesv4'); /*v2*/
$dan_overlay_shadows_enable = save_background_checkbox_option('dan_overlay_shadows_enable', 'paneldanoverlayshadows'); /*v2*/
$dan_scrolling_background_enable = save_background_checkbox_option('dan_scrolling_background_enable', 'paneldanscrollingbackground'); /*v2*/

//Cores
$dan_toggle_all_cores_enable = save_core_checkbox_option('dan_toggle_all_cores_enable', 'paneldantoggleallcores');
$dan_qr_code_enable = save_core_checkbox_option('dan_qr_code_enable', 'paneldanqrcode');
$dan_parallax_hover_enable = save_core_checkbox_option('dan_parallax_hover_enable', 'paneldanparallaxhover');
$dan_stacking_cards_enable = save_core_checkbox_option('dan_stacking_cards_enable', 'paneldanstackingcards');
$dan_glitchy_enable = save_core_checkbox_option('dan_glitchy_enable', 'paneldanglitchy');
$dan_tippy_enable = save_core_checkbox_option('dan_tippy_enable', 'paneldantippy');
$dan_tabs_enable = save_core_checkbox_option('dan_tabs_enable', 'paneldantabs');
$dan_accordion_enable = save_core_checkbox_option('dan_accordion_enable', 'paneldanaccordion');
$dan_back_to_top_enable = save_core_checkbox_option('dan_back_to_top_enable', 'paneldanbacktop');
$dan_click_and_copy_enable = save_core_checkbox_option('dan_click_and_copy_enable', 'paneldanclickandcopy');
$dan_flipbox_enable = save_core_checkbox_option('dan_flipbox_enable', 'paneldanflipbox');
$dan_glowing_card_enable = save_core_checkbox_option('dan_glowing_card_enable', 'paneldanglowingcard');
$dan_horizontal_marquee_enable = save_core_checkbox_option('dan_horizontal_marquee_enable', 'paneldanhorizontalmarquee');
$dan_vertical_marquee_enable = save_core_checkbox_option('dan_vertical_marquee_enable', 'paneldanverticalmarquee');
$dan_interactive_divider_enable = save_core_checkbox_option('dan_interactive_divider_enable', 'paneldaninteractivedivider');
$dan_inverted_corner_enable = save_core_checkbox_option('dan_inverted_corner_enable', 'paneldaninvertedcorner');
$dan_mask_hover_enable = save_core_checkbox_option('dan_mask_hover_enable', 'paneldanmaskhover');
$dan_motion_divider_enable = save_core_checkbox_option('dan_motion_divider_enable', 'paneldanmotiondivider');
$dan_observer_enable = save_core_checkbox_option('dan_observer_enable', 'paneldanobserver');
$dan_progress_bar_enable = save_core_checkbox_option('dan_progress_bar_enable', 'paneldanprogressbar');
$dan_scrollbar_enable = save_core_checkbox_option('dan_scrollbar_enable', 'paneldanscrollbar');
$dan_smooth_scroll_enable = save_core_checkbox_option('dan_smooth_scroll_enable', 'paneldansmoothscroll');
$dan_pixels_shimmer_card_enable = save_core_checkbox_option('dan_pixels_shimmer_card_enable', 'paneldanpixelsshimmercard');
$dan_distorsion_tabs_enable = save_core_checkbox_option('dan_distorsion_tabs_enable', 'paneldandistortiontabs');
$dan_toolteam_enable = save_core_checkbox_option('dan_toolteam_enable', 'paneldantoolteam');
$dan_toast_enable = save_core_checkbox_option('dan_toast_enable', 'paneldantoast'); 
$dan_decode_card_enable = save_core_checkbox_option('dan_decode_card_enable', 'paneldandecodecard');
$dan_progress_bar_v2_enable = save_core_checkbox_option('dan_progress_bar_v2_enable', 'paneldanprogressbarv2');
$dan_audio_player_enable = save_core_checkbox_option('dan_audio_player_enable', 'paneldanaudioplayer'); /*v2*/
$dan_looping_tabs_enable = save_core_checkbox_option('dan_looping_tabs_enable', 'paneldanloopingtabs'); /*v2*/
$dan_site_loader_enable = save_core_checkbox_option('dan_site_loader_enable', 'paneldansiteloader'); /*v2*/


//Assets
$dan_splittext_enable = save_library_checkbox_option('dan_splittext_enable', 'paneldansplittext');