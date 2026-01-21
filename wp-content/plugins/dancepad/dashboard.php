<?php

namespace SureCart\DancepadLicensing;

$this->license_form_submit();

$this->print_css();

$activation = $this->get_activation();
$action     = ! empty( $activation->id ) ? 'deactivate' : 'activate'
?>

<?php require_once DANCEPAD_PLUGIN_DIR . 'customizations.php'; ?>
<?php $dan_active_tab = get_option('dan_active_tab', 'texts'); ?>

<div class="dancepad-dashboard">
    <input type="hidden" name="dan_active_tab" id="dan_active_tab" value="<?php echo esc_attr($dan_active_tab); ?>">

    <div class="dancepad-dashboard__sidebar">
        <div class="dancepad-dashboard__license-wrapper">
            <div class="dancepad-dashboard__license-form">
                <form method="post" action="<?php echo esc_attr( $this->form_action_url() ); ?>">
                    <input type="hidden" name="_action" value="<?php echo esc_attr( $action ); ?>">
                    <input type="hidden" name="_nonce" value="<?php echo esc_attr( wp_create_nonce( $this->client->name ) ); ?>">
                    <input type="hidden" name="activation_id" value="<?php echo esc_attr( $this->activation_id ); ?>">

                    <div class="dancepad-dashboard__wrapper-plugintitle-changelog">
                        <h1 class="dancepad-dashboard__plugintitle">Dancepad</h1>
                        <a href="https://dancepad.io/changelog" target="_blank" class="dancepad-dashboard__changelog-link">
                            v<?php echo esc_html( DANCEPAD_VERSION ); ?>
                        </a>
                    </div>

                    <div class="dancepad-dashboard__license">
                        <div class="dancepad-dashboard__license-heading-status">
                            <span class="dancepad-dashboard__license-heading">License</span>
                            
                            <?php if ( 'activate' === $action ) : ?> 
                                <label for="license_key" class="dancepad-dashboard__license-status dancepad-dashboard__license-status--inactive">
                                    <?php echo esc_html( sprintf( $this->client->__( 'Inactive', 'surecart' ), $this->client->name ) ); ?>
                                    <?php update_option('activate_dancepad', false); ?>
                                </label>
                            <?php else : ?>
                                <label for="license_key" class="dancepad-dashboard__license-status dancepad-dashboard__license-status--active">
                                    <?php echo esc_html( sprintf( $this->client->__( 'Active', 'surecart' ), $this->client->name ) ); ?>
                                    <?php update_option('activate_dancepad', true); ?>
                                </label>
                            <?php endif; ?>
                        </div>

                        <div class="dancepad-dashboard__license-input-submit">
                            <?php if ( 'activate' === $action ) : ?> 
                                <input class="widefat" type="password" autocomplete="off" name="license_key" id="license_key" value="<?php echo esc_attr( $this->license_key ); ?>" autofocus>
                            <?php endif; ?>

                            <?php if ( isset( $_GET['debug'] ) ) : // phpcs:ignore  ?>
                                <label for="license_id"><?php echo esc_html( sprintf( $this->client->__( 'License ID', 'surecart' ), $this->client->name ) ); ?></label>
                                <input class="widefat" type="text" autocomplete="off" name="license_id" id="license_id" value="<?php echo esc_attr( $this->license_id ); ?>" autofocus>

                                <label for="activation_id"><?php echo esc_html( sprintf( $this->client->__( 'Activation ID', 'surecart' ), $this->client->name ) ); ?></label>
                                <input class="widefat" type="text" autocomplete="off" name="activation_id" id="activation_id" value="<?php echo esc_attr( $this->activation_id ); ?>" autofocus>
                            <?php endif; ?>

                            <?php submit_button( 'activate' === $action ? $this->client->__( 'Activate' ) : $this->client->__( 'Deactivate' ) ); ?>
                        </div>
                    </div>

                    <?php settings_errors(); ?>
                </form>
            </div>
        </div>

        <div data-tab="libraries" class="dancepad-dashboard__libraries-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'libraries' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__libraries-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__libraries-item-title">Libraries</div>
        </div>

        <div data-tab="texts" class="dancepad-dashboard__texts-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'texts' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__texts-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__texts-item-title">Texts</div>
        </div>

        <div data-tab="buttons" class="dancepad-dashboard__buttons-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'buttons' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__buttons-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__buttons-item-title">Buttons</div>
        </div>

        <div data-tab="menus" class="dancepad-dashboard__menus-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'menus' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__menus-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__menus-item-title">Menus</div>
        </div>

        <div data-tab="medias" class="dancepad-dashboard__medias-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'medias' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__medias-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__medias-item-title">Medias</div>
        </div>

        <div data-tab="cursors" class="dancepad-dashboard__cursors-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'cursors' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__cursors-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__cursors-item-title">Cursors</div>
        </div>

        <div data-tab="sliders" class="dancepad-dashboard__sliders-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'sliders' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__sliders-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__sliders-item-title">Sliders</div>
        </div>

        <div data-tab="backgrounds" class="dancepad-dashboard__backgrounds-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'backgrounds' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__backgrounds-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__backgrounds-item-title">Backgrounds</div>
        </div>

        <div data-tab="cores" class="dancepad-dashboard__cores-item dancepad-dashboard__sidebar-item
        <?php echo $dan_active_tab === 'cores' ? 'dancepad-dashboard__sidebar-item--active' : ''; ?>">
            <div class="dancepad-dashboard__cores-item-icon dancepad-dashboard__sidebar-item-icon"></div>
            <div class="dancepad-dashboard__cores-item-title">Cores</div>
        </div>
    </div>

    <form class="dancepad-dashboard__content dancepad-dashboard__shadow" method="post">
        <div data-tab="libraries" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'libraries' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__libraries-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__libraries-item-title">Libraries</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_libraries" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <span class="dancepad-dashboard__setting-heading">SplitText</span>
                        <input type="checkbox" id="panel-dan-splittext" name="paneldansplittext" value="true" <?php checked('true', $dan_splittext_enable); ?>/>
                        <label for="panel-dan-splittext"></label>
                    </div>
                </div>

                <p class="dancepad-dashboard__content-paragraph">
                    Handling libraries can be specially useful to improve performance. 
                    You should disable a library if the elements you are using don't require it or if it is already loaded by your own way or other 3rd party addons in order to manage the duplicity.<br>
                    When disabling a library be sure it is already loaded and it isn't a deprecated version otherwise elements requiring it won't work as expected.<br>
                </p>
            </div>
        </div>

        <div data-tab="texts" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'texts' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__texts-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__texts-item-title">Texts</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_texts" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-texts" class="toggle-all" name="paneldantogglealltexts" value="true" <?php checked('true', $dan_toggle_all_texts_enable); ?>/>
                        <label for="toggle-all-texts"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/highlight/" target="_blank" class="dancepad-dashboard__setting-heading">Highlight</a>
                        <input type="checkbox" id="panel-dan-highlight" name="paneldanhighlight" value="true" <?php checked('true', $dan_highlight_enable); ?>/>
                        <label for="panel-dan-highlight"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/link-preview/" target="_blank" class="dancepad-dashboard__setting-heading">Link Preview</a>
                        <input type="checkbox" id="panel-dan-link-preview" name="paneldanlinkpreview" value="true" <?php checked('true', $dan_link_preview_enable); ?>/>
                        <label for="panel-dan-link-preview"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/read-more/" target="_blank" class="dancepad-dashboard__setting-heading">Read More</a>
                        <input type="checkbox" id="panel-dan-read-more" name="paneldanreadmore" value="true" <?php checked('true', $dan_read_more_enable); ?>/>
                        <label for="panel-dan-read-more"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/shading-lines-title/" target="_blank" class="dancepad-dashboard__setting-heading">Shading Lines Title</a>
                        <input type="checkbox" id="panel-dan-shading-lines-title" name="paneldanshadinglinestitle" value="true" <?php checked('true', $dan_shading_lines_title_enable); ?>/>
                        <label for="panel-dan-shading-lines-title"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/looping-lines-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Looping Lines V2</a>
                        <input type="checkbox" id="panel-dan-looping-lines-v2" name="paneldanloopinglinesv2" value="true" <?php checked('true', $dan_looping_lines_v2_enable); ?>/>
                        <label for="panel-dan-looping-lines-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dynamic-copyright/" target="_blank" class="dancepad-dashboard__setting-heading">Dynamic Copyright</a>
                        <input type="checkbox" id="panel-dan-dynamic-copyright" name="paneldandynamiccopyright" value="true" <?php checked('true', $dan_dynamic_copyright_enable); ?>/>
                        <label for="panel-dan-dynamic-copyright"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/proximity-weight/" target="_blank" class="dancepad-dashboard__setting-heading">Proximity Hover</a>
                        <input type="checkbox" id="panel-dan-proximity-weight" name="paneldanproximityweight" value="true" <?php checked('true', $dan_proximity_weight_enable); ?>/>
                        <label for="panel-dan-proximity-weight"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/swap-reading/" target="_blank" class="dancepad-dashboard__setting-heading">Swap Reading</a>
                        <input type="checkbox" id="panel-dan-swap-reading" name="paneldanswapreading" value="true" <?php checked('true', $dan_swap_reading_enable); ?>/>
                        <label for="panel-dan-swap-reading"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/text-shimmer/" target="_blank" class="dancepad-dashboard__setting-heading">Text Shimmer</a>
                        <input type="checkbox" id="panel-dan-text-shimmer" name="paneldantextshimmer" value="true" <?php checked('true', $dan_text_shimmer_enable); ?>/>
                        <label for="panel-dan-text-shimmer"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/blade-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Blade Reveal</a>
                        <input type="checkbox" id="panel-dan-blade-reveal" name="paneldanbladereveal" value="true" <?php checked('true', $dan_blade_reveal_enable); ?>/>
                        <label for="panel-dan-blade-reveal"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/twist-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Twist Reveal</a>
                        <input type="checkbox" id="panel-dan-twist-reveal" name="paneldantwistreveal" value="true" <?php checked('true', $dan_twist_reveal_enable); ?>/>
                        <label for="panel-dan-twist-reveal"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/blur-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Blur Reveal</a>
                        <input type="checkbox" id="panel-dan-blur-reveal" name="paneldanblurreveal" value="true" <?php checked('true', $dan_blur_reveal_enable); ?>/>
                        <label for="panel-dan-blur-reveal"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/letter-launcher/" target="_blank" class="dancepad-dashboard__setting-heading">Letter Launcher</a>
                        <input type="checkbox" id="panel-dan-letter-launcher" name="paneldanletterlauncher" value="true" <?php checked('true', $dan_letter_launcher_enable); ?>/>
                        <label for="panel-dan-letter-launcher"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/random-letters/" target="_blank" class="dancepad-dashboard__setting-heading">Random Letters</a>
                        <input type="checkbox" id="panel-dan-random-letters" name="paneldanrandomletters" value="true" <?php checked('true', $dan_random_letters_enable); ?>/>
                        <label for="panel-dan-random-letters"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/unfold-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Unfold Reveal</a>
                        <input type="checkbox" id="panel-dan-unfold-reveal" name="paneldanunfoldreveal" value="true" <?php checked('true', $dan_unfold_reveal_enable); ?>/>
                        <label for="panel-dan-unfold-reveal"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/decode-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Decode Reveal</a>
                        <input type="checkbox" id="panel-dan-decode-reveal" name="paneldandecodereveal" value="true" <?php checked('true', $dan_decode_reveal_enable); ?>/>
                        <label for="panel-dan-decode-reveal"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/counter/" target="_blank" class="dancepad-dashboard__setting-heading">Counter</a>
                        <input type="checkbox" id="panel-dan-counter" name="paneldancounter" value="true" <?php checked('true', $dan_counter_enable); ?>/>
                        <label for="panel-dan-counter"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/underline-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Underline Hover</a>
                        <input type="checkbox" id="panel-dan-underline-hover" name="paneldanunderlinehover" value="true" <?php checked('true', $dan_underline_hover_enable); ?>/>
                        <label for="panel-dan-underline-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/highlight-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Highlight Hover</a>
                        <input type="checkbox" id="panel-dan-highlight-hover" name="paneldanhighlighthover" value="true" <?php checked('true', $dan_highlight_hover_enable); ?>/>
                        <label for="panel-dan-highlight-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/swap-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Swap Hover</a>
                        <input type="checkbox" id="panel-dan-swap-hover" name="paneldanswaphover" value="true" <?php checked('true', $dan_swap_hover_enable); ?>/>
                        <label for="panel-dan-swap-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/3d-swap-hover/" target="_blank" class="dancepad-dashboard__setting-heading">3D Swap Hover</a>
                        <input type="checkbox" id="panel-dan-3d-swap-hover" name="paneldan3dswaphover" value="true" <?php checked('true', $dan_3d_swap_hover_enable); ?>/>
                        <label for="panel-dan-3d-swap-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/blended-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Blended Hover</a>
                        <input type="checkbox" id="panel-dan-blended-hover" name="paneldanblendedhover" value="true" <?php checked('true', $dan_blended_hover_enable); ?>/>
                        <label for="panel-dan-blended-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/decode-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Decode Hover</a>
                        <input type="checkbox" id="panel-dan-decode-hover" name="paneldandecodehover" value="true" <?php checked('true', $dan_decode_hover_enable); ?>/>
                        <label for="panel-dan-decode-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/unfold-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Unfold Hover</a>
                        <input type="checkbox" id="panel-dan-unfold-hover" name="paneldanunfoldhover" value="true" <?php checked('true', $dan_unfold_hover_enable); ?>/>
                        <label for="panel-dan-unfold-hover"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arc-title/" target="_blank" class="dancepad-dashboard__setting-heading">Arc Title</a>
                        <input type="checkbox" id="panel-dan-arc-title" name="paneldanarctitle" value="true" <?php checked('true', $dan_arc_title_enable); ?>/>
                        <label for="panel-dan-arc-title"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/typed/" target="_blank" class="dancepad-dashboard__setting-heading">Typed</a>
                        <input type="checkbox" id="panel-dan-typed" name="paneldantyped" value="true" <?php checked('true', $dan_typed_enable); ?>/>
                        <label for="panel-dan-typed"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/fluid-gradient/" target="_blank" class="dancepad-dashboard__setting-heading">Fluid Gradient</a>
                        <input type="checkbox" id="panel-dan-fluid-gradient" name="paneldanfluidgradient" value="true" <?php checked('true', $dan_fluid_gradient_enable); ?>/>
                        <label for="panel-dan-fluid-gradient"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/looping-lines/" target="_blank" class="dancepad-dashboard__setting-heading">Looping Lines</a>
                        <input type="checkbox" id="panel-dan-looping-lines" name="paneldanloopinglines" value="true" <?php checked('true', $dan_looping_lines_enable); ?>/>
                        <label for="panel-dan-looping-lines"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/mousefill-title/" target="_blank" class="dancepad-dashboard__setting-heading">Mousefill Title</a>
                        <input type="checkbox" id="panel-dan-mousefill-title" name="paneldanmousefilltitle" value="true" <?php checked('true', $dan_mousefill_title_enable); ?>/>
                        <label for="panel-dan-mousefill-title"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/scroll-reading/" target="_blank" class="dancepad-dashboard__setting-heading">Scroll Reading</a>
                        <input type="checkbox" id="panel-dan-scroll-reading" name="paneldanscrollreading" value="true" <?php checked('true', $dan_scroll_reading_enable); ?>/>
                        <label for="panel-dan-scroll-reading"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/blur-reading/" target="_blank" class="dancepad-dashboard__setting-heading">Blur Reading</a>
                        <input type="checkbox" id="panel-dan-blur-reading" name="paneldanblurreading" value="true" <?php checked('true', $dan_blur_reading_enable); ?>/>
                        <label for="panel-dan-blur-reading"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="buttons" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'buttons' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__buttons-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__buttons-item-title">Buttons</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_buttons" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-buttons" class="toggle-all" name="paneldantoggleallbuttons" value="true" <?php checked('true', $dan_toggle_all_buttons_enable); ?>/>
                        <label for="toggle-all-buttons"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v4/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V4</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v4" name="paneldanarrowbuttonv4" value="true" <?php checked('true', $dan_arrow_button_v4_enable); ?>/>
                        <label for="panel-dan-arrow-button-v4"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v5/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V5</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v5" name="paneldanarrowbuttonv5" value="true" <?php checked('true', $dan_arrow_button_v5_enable); ?>/>
                        <label for="panel-dan-arrow-button-v5"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v6/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V6</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v6" name="paneldanarrowbuttonv6" value="true" <?php checked('true', $dan_arrow_button_v6_enable); ?>/>
                        <label for="panel-dan-arrow-button-v6"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v7/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V7</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v7" name="paneldanarrowbuttonv7" value="true" <?php checked('true', $dan_arrow_button_v7_enable); ?>/>
                        <label for="panel-dan-arrow-button-v7"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v8/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V8</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v8" name="paneldanarrowbuttonv8" value="true" <?php checked('true', $dan_arrow_button_v8_enable); ?>/>
                        <label for="panel-dan-arrow-button-v8"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/blurry-button/" target="_blank" class="dancepad-dashboard__setting-heading">Blurry Button</a>
                        <input type="checkbox" id="panel-dan-blurry-button" name="paneldanblurrybutton" value="true" <?php checked('true', $dan_blurry_button_enable); ?>/>
                        <label for="panel-dan-blurry-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/bubbles-button/" target="_blank" class="dancepad-dashboard__setting-heading">Bubbles Button</a>
                        <input type="checkbox" id="panel-dan-bubbles-button" name="paneldanbubblesbutton" value="true" <?php checked('true', $dan_bubbles_button_enable); ?>/>
                        <label for="panel-dan-bubbles-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dot-button/" target="_blank" class="dancepad-dashboard__setting-heading">Dot Button</a>
                        <input type="checkbox" id="panel-dan-dot-button" name="paneldandotbutton" value="true" <?php checked('true', $dan_dot_button_enable); ?>/>
                        <label for="panel-dan-dot-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dot-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Dot Button V2</a>
                        <input type="checkbox" id="panel-dan-dot-button-v2" name="paneldandotbuttonv2" value="true" <?php checked('true', $dan_dot_button_v2_enable); ?>/>
                        <label for="panel-dan-dot-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dot-button-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Dot Button V3</a>
                        <input type="checkbox" id="panel-dan-dot-button-v3" name="paneldandotbuttonv3" value="true" <?php checked('true', $dan_dot_button_v3_enable); ?>/>
                        <label for="panel-dan-dot-button-v3"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/flipflop-button/" target="_blank" class="dancepad-dashboard__setting-heading">Flipflop Button</a>
                        <input type="checkbox" id="panel-dan-flipflop-button" name="paneldanflipflopbutton" value="true" <?php checked('true', $dan_flipflop_button_enable); ?>/>
                        <label for="panel-dan-flipflop-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/flipflop-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Flipflop Button V2</a>
                        <input type="checkbox" id="panel-dan-flipflop-button-v2" name="paneldanflipflopbuttonv2" value="true" <?php checked('true', $dan_flipflop_button_v2_enable); ?>/>
                        <label for="panel-dan-flipflop-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/flipflop-button-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Flipflop Button V3</a>
                        <input type="checkbox" id="panel-dan-flipflop-button-v3" name="paneldanflipflopbuttonv3" value="true" <?php checked('true', $dan_flipflop_button_v3_enable); ?>/>
                        <label for="panel-dan-flipflop-button-v3"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/nudge-button/" target="_blank" class="dancepad-dashboard__setting-heading">Nudge Button</a>
                        <input type="checkbox" id="panel-dan-nudge-button" name="paneldannudgebutton" value="true" <?php checked('true', $dan_nudge_button_enable); ?>/>
                        <label for="panel-dan-nudge-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/pixels-button/" target="_blank" class="dancepad-dashboard__setting-heading">Pixels Button</a>
                        <input type="checkbox" id="panel-dan-pixels-button" name="paneldanpixelsbutton" value="true" <?php checked('true', $dan_pixels_button_enable); ?>/>
                        <label for="panel-dan-pixels-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/prism-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Prism Button V2</a>
                        <input type="checkbox" id="panel-dan-prism-button-v2" name="paneldanprismbuttonv2" value="true" <?php checked('true', $dan_prism_button_v2_enable); ?>/>
                        <label for="panel-dan-prism-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/reel-button/" target="_blank" class="dancepad-dashboard__setting-heading">Reel Button</a>
                        <input type="checkbox" id="panel-dan-reel-button" name="paneldanreelbutton" value="true" <?php checked('true', $dan_reel_button_enable); ?>/>
                        <label for="panel-dan-reel-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v4/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V4</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v4" name="paneldanripplebuttonv4" value="true" <?php checked('true', $dan_ripple_button_v4_enable); ?>/>
                        <label for="panel-dan-ripple-button-v4"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v5/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V5</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v5" name="paneldanripplebuttonv5" value="true" <?php checked('true', $dan_ripple_button_v5_enable); ?>/>
                        <label for="panel-dan-ripple-button-v5"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v6/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V6</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v6" name="paneldanripplebuttonv6" value="true" <?php checked('true', $dan_ripple_button_v6_enable); ?>/>
                        <label for="panel-dan-ripple-button-v6"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v7/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V7</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v7" name="paneldanripplebuttonv7" value="true" <?php checked('true', $dan_ripple_button_v7_enable); ?>/>
                        <label for="panel-dan-ripple-button-v7"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/squeezy-radius-button/" target="_blank" class="dancepad-dashboard__setting-heading">Squeezy Button</a>
                        <input type="checkbox" id="panel-dan-squeezy-radius-button" name="paneldansqueezyradiusbutton" value="true" <?php checked('true', $dan_squeezy_radius_button_enable); ?>/>
                        <label for="panel-dan-squeezy-radius-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/stretchy-button/" target="_blank" class="dancepad-dashboard__setting-heading">Stretchy Button</a>
                        <input type="checkbox" id="panel-dan-stretchy-button" name="paneldanstretchybutton" value="true" <?php checked('true', $dan_stretchy_button_enable); ?>/>
                        <label for="panel-dan-stretchy-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/strip-button/" target="_blank" class="dancepad-dashboard__setting-heading">Strip Button</a>
                        <input type="checkbox" id="panel-dan-strip-button" name="paneldanstripbutton" value="true" <?php checked('true', $dan_strip_button_enable); ?>/>
                        <label for="panel-dan-strip-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/stripes-button/" target="_blank" class="dancepad-dashboard__setting-heading">Stripes Button</a>
                        <input type="checkbox" id="panel-dan-stripes-button" name="paneldanstripesbutton" value="true" <?php checked('true', $dan_stripes_button_enable); ?>/>
                        <label for="panel-dan-stripes-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/rainbow-button/" target="_blank" class="dancepad-dashboard__setting-heading">Rainbow Button</a>
                        <input type="checkbox" id="panel-dan-rainbow-button" name="paneldanrainbowbutton" value="true" <?php checked('true', $dan_rainbow_button_enable); ?>/>
                        <label for="panel-dan-rainbow-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/shiny-button/" target="_blank" class="dancepad-dashboard__setting-heading">Shiny Button</a>
                        <input type="checkbox" id="panel-dan-shiny-button" name="paneldanshinybutton" value="true" <?php checked('true', $dan_shiny_button_enable); ?>/>
                        <label for="panel-dan-shiny-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V2</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v2" name="paneldanarrowbuttonv2" value="true" <?php checked('true', $dan_arrow_button_v2_enable); ?>/>
                        <label for="panel-dan-arrow-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button V3</a>
                        <input type="checkbox" id="panel-dan-arrow-button-v3" name="paneldanarrowbuttonv3" value="true" <?php checked('true', $dan_arrow_button_v3_enable); ?>/>
                        <label for="panel-dan-arrow-button-v3"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/anyside-button/" target="_blank" class="dancepad-dashboard__setting-heading">Anyside Button</a>
                        <input type="checkbox" id="panel-dan-anyside-button" name="paneldananysidebutton" value="true" <?php checked('true', $dan_anyside_button); ?>/>
                        <label for="panel-dan-anyside-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-button/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Button</a>
                        <input type="checkbox" id="panel-dan-arrow-button" name="paneldanarrowbutton" value="true" <?php checked('true', $dan_arrow_button); ?>/>
                        <label for="panel-dan-arrow-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/arrow-icon/" target="_blank" class="dancepad-dashboard__setting-heading">Arrow Icon</a>
                        <input type="checkbox" id="panel-dan-arrow-icon" name="paneldanarrowicon" value="true" <?php checked('true', $dan_arrow_icon_enable); ?>/>
                        <label for="panel-dan-arrow-icon"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/crystal-button/" target="_blank" class="dancepad-dashboard__setting-heading">Crystal Button</a>
                        <input type="checkbox" id="panel-dan-crystal-button" name="paneldancrystalbutton" value="true" <?php checked('true', $dan_crystal_button); ?>/>
                        <label for="panel-dan-crystal-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/glowing-button/" target="_blank" class="dancepad-dashboard__setting-heading">Glowing Button</a>
                        <input type="checkbox" id="panel-dan-glowing-button" name="paneldanglowingbutton" value="true" <?php checked('true', $dan_glowing_button_enable); ?>/>
                        <label for="panel-dan-glowing-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/marquee-button/" target="_blank" class="dancepad-dashboard__setting-heading">Marquee Button</a>
                        <input type="checkbox" id="panel-dan-marquee-button" name="paneldanmarqueebutton" value="true" <?php checked('true', $dan_marquee_button_enable); ?>/>
                        <label for="panel-dan-marquee-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/marquee-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Marquee Button V2</a>
                        <input type="checkbox" id="panel-dan-marquee-button-v2" name="paneldanmarqueebuttonv2" value="true" <?php checked('true', $dan_marquee_button_v2_enable); ?>/>
                        <label for="panel-dan-marquee-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/mask-button/" target="_blank" class="dancepad-dashboard__setting-heading">Mask Button</a>
                        <input type="checkbox" id="panel-dan-mask-button" name="paneldanmaskbutton" value="true" <?php checked('true', $dan_mask_button_enable); ?>/>
                        <label for="panel-dan-mask-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/modal-button/" target="_blank" class="dancepad-dashboard__setting-heading">Modal Button</a>
                        <input type="checkbox" id="panel-dan-modal-button" name="paneldanmodalbutton" value="true" <?php checked('true', $dan_modal_button_enable); ?>/>
                        <label for="panel-dan-modal-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/prism-button/" target="_blank" class="dancepad-dashboard__setting-heading">Prism Button</a>
                        <input type="checkbox" id="panel-dan-prism-button" name="paneldanprismbutton" value="true" <?php checked('true', $dan_prism_button_enable); ?>/>
                        <label for="panel-dan-prism-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button</a>
                        <input type="checkbox" id="panel-dan-ripple-button" name="paneldanripplebutton" value="true" <?php checked('true', $dan_ripple_button_enable); ?>/>
                        <label for="panel-dan-ripple-button"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V2</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v2" name="paneldanripplebuttonv2" value="true" <?php checked('true', $dan_ripple_button_v2_enable); ?>/>
                        <label for="panel-dan-ripple-button-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/ripple-button-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Ripple Button V3</a>
                        <input type="checkbox" id="panel-dan-ripple-button-v3" name="paneldanripplebuttonv3" value="true" <?php checked('true', $dan_ripple_button_v3_enable); ?>/>
                        <label for="panel-dan-ripple-button-v3"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/layer-button/" target="_blank" class="dancepad-dashboard__setting-heading">Layer Button</a>
                        <input type="checkbox" id="panel-dan-layer-button" name="paneldanlayerbutton" value="true" <?php checked('true', $dan_layer_button_enable); ?>/>
                        <label for="panel-dan-layer-button"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="menus" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'menus' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__menus-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__menus-item-title">Menus</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_menus" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-menus" class="toggle-all" name="paneldantoggleallmenus" value="true" <?php checked('true', $dan_toggle_all_menus_enable); ?>/>
                        <label for="toggle-all-menus"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dynamic-island/" target="_blank" class="dancepad-dashboard__setting-heading">Dynamic Island</a>
                        <input type="checkbox" id="panel-dan-dynamic-island" name="paneldandynamicisland" value="true" <?php checked('true', $dan_dynamic_island_enable); ?>/>
                        <label for="panel-dan-dynamic-island"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/focus-nav/" target="_blank" class="dancepad-dashboard__setting-heading">Focus Nav</a>
                        <input type="checkbox" id="panel-dan-focus-nav" name="paneldanfocusnav" value="true" <?php checked('true', $dan_focus_nav_enable); ?>/>
                        <label for="panel-dan-focus-nav"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/gooey-nav/" target="_blank" class="dancepad-dashboard__setting-heading">Gooey Nav</a>
                        <input type="checkbox" id="panel-dan-gooey-nav" name="paneldangooeynav" value="true" <?php checked('true', $dan_gooey_nav_enable); ?>/>
                        <label for="panel-dan-gooey-nav"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/sticky-header/" target="_blank" class="dancepad-dashboard__setting-heading">Sticky Header</a>
                        <input type="checkbox" id="panel-dan-sticky-header" name="paneldanstickyheader" value="true" <?php checked('true', $dan_sticky_header_enable); ?>/>
                        <label for="panel-dan-sticky-header"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/burger/" target="_blank" class="dancepad-dashboard__setting-heading">Burger</a>
                        <input type="checkbox" id="panel-dan-burger" name="paneldanburger" value="true" <?php checked('true', $dan_burger_enable); ?>/>
                        <label for="panel-dan-burger"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dock/" target="_blank" class="dancepad-dashboard__setting-heading">Dock</a>
                        <input type="checkbox" id="panel-dan-dock" name="paneldandock" value="true" <?php checked('true', $dan_dock_enable); ?>/>
                        <label for="panel-dan-dock"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/drawer/" target="_blank" class="dancepad-dashboard__setting-heading">Drawer</a>
                        <input type="checkbox" id="panel-dan-drawer" name="paneldandrawer" value="true" <?php checked('true', $dan_drawer_enable); ?>/>
                        <label for="panel-dan-drawer"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dropdown/" target="_blank" class="dancepad-dashboard__setting-heading">Dropdown</a>
                        <input type="checkbox" id="panel-dan-dropdown" name="paneldandropdown" value="true" <?php checked('true', $dan_dropdown_enable); ?>/>
                        <label for="panel-dan-dropdown"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/dropdown-mega-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Dropdown megaMenu</a>
                        <input type="checkbox" id="panel-dan-dropdown-mega-menu" name="paneldandropdownmegamenu" value="true" <?php checked('true', $dan_dropdown_mega_menu_enable); ?>/>
                        <label for="panel-dan-dropdown-mega-menu"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/morphing-nav/" target="_blank" class="dancepad-dashboard__setting-heading">Morphing Nav</a>
                        <input type="checkbox" id="panel-dan-morphing-nav" name="paneldanmorphingnav" value="true" <?php checked('true', $dan_morphing_nav_enable); ?>/>
                        <label for="panel-dan-morphing-nav"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/overlay-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Overlay Menu</a>
                        <input type="checkbox" id="panel-dan-overlay-menu" name="paneldanoverlaymenu" value="true" <?php checked('true', $dan_overlay_menu_enable); ?>/>
                        <label for="panel-dan-overlay-menu"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/offcanvas-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Offcanvas Menu</a>
                        <input type="checkbox" id="panel-dan-offcanvas-menu" name="paneldanoffcanvasmenu" value="true" <?php checked('true', $dan_offcanvas_menu_enable); ?>/>
                        <label for="panel-dan-offcanvas-menu"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/expanding-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Expanding Menu</a>
                        <input type="checkbox" id="panel-dan-expanding-menu" name="paneldanexpandingmenu" value="true" <?php checked('true', $dan_expanding_menu_enable); ?>/>
                        <label for="panel-dan-expanding-menu"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/circular-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Circular Menu</a>
                        <input type="checkbox" id="panel-dan-circular-menu" name="paneldancircularmenu" value="true" <?php checked('true', $dan_circular_menu_enable); ?>/>
                        <label for="panel-dan-circular-menu"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/multi-offcanvas-menu/" target="_blank" class="dancepad-dashboard__setting-heading">Multi Offcanvas Menu</a>
                        <input type="checkbox" id="panel-dan-multi-offcanvas-menu" name="paneldanmultioffcanvasmenu" value="true" <?php checked('true', $dan_multi_offcanvas_menu_enable); ?>/>
                        <label for="panel-dan-multi-offcanvas-menu"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="medias" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'medias' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__medias-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__medias-item-title">Medias</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_medias" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-medias" class="toggle-all" name="paneldantoggleallmedias" value="true" <?php checked('true', $dan_toggle_all_medias_enable); ?>/>
                        <label for="toggle-all-medias"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/before-after-image-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Before After Image V2</a>
                        <input type="checkbox" id="panel-dan-beforeafter-image-v2" name="paneldanbeforeafterimagev2" value="true" <?php checked('true', $dan_beforeafter_image_v2_enable); ?>/>
                        <label for="panel-dan-beforeafter-image-v2"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/image-reveal-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Image Reveal V2</a>
                        <input type="checkbox" id="panel-dan-image-reveal-v2" name="paneldanimagerevealv2" value="true" <?php checked('true', $dan_image_reveal_v2_enable); ?>/>
                        <label for="panel-dan-image-reveal-v2"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/image-reveal-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Image Reveal V3</a>
                        <input type="checkbox" id="panel-dan-image-reveal-v3" name="paneldanimagerevealv3" value="true" <?php checked('true', $dan_image_reveal_v3_enable); ?>/>
                        <label for="panel-dan-image-reveal-v3"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/image-reveal-v4/" target="_blank" class="dancepad-dashboard__setting-heading">Image Reveal V4</a>
                        <input type="checkbox" id="panel-dan-image-reveal-v4" name="paneldanimagerevealv4" value="true" <?php checked('true', $dan_image_reveal_v4_enable); ?>/>
                        <label for="panel-dan-image-reveal-v4"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/lightbox/" target="_blank" class="dancepad-dashboard__setting-heading">Lightbox</a>
                        <input type="checkbox" id="panel-dan-lightbox" name="paneldanlightbox" value="true" <?php checked('true', $dan_lightbox_enable); ?>/>
                        <label for="panel-dan-lightbox"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/scrolling-gallery/" target="_blank" class="dancepad-dashboard__setting-heading">Scrolling Gallery</a>
                        <input type="checkbox" id="panel-dan-scrolling-gallery" name="paneldanscrollinggallery" value="true" <?php checked('true', $dan_scrolling_gallery_enable); ?>/>
                        <label for="panel-dan-scrolling-gallery"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/image-reveal/" target="_blank" class="dancepad-dashboard__setting-heading">Image Reveal</a>
                        <input type="checkbox" id="panel-dan-image-reveal" name="paneldanimagereveal" value="true" <?php checked('true', $dan_image_reveal_enable); ?>/>
                        <label for="panel-dan-image-reveal"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/before-after-image/" target="_blank" class="dancepad-dashboard__setting-heading">Before After Image</a>
                        <input type="checkbox" id="panel-dan-before-after-image" name="paneldanbeforeafterimage" value="true" <?php checked('true', $dan_before_after_image_enable); ?>/>
                        <label for="panel-dan-before-after-image"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/parallax/" target="_blank" class="dancepad-dashboard__setting-heading">Parallax</a>
                        <input type="checkbox" id="panel-dan-parallax" name="paneldanparallax" value="true" <?php checked('true', $dan_parallax_enable); ?>/>
                        <label for="panel-dan-parallax"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/image-hotspots/" target="_blank" class="dancepad-dashboard__setting-heading">Image Hotspots</a>
                        <input type="checkbox" id="panel-dan-image-hotspots" name="paneldanimagehotspots" value="true" <?php checked('true', $dan_image_hotspots_enable); ?>/>
                        <label for="panel-dan-image-hotspots"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="cursors" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'cursors' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__cursors-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__cursors-item-title">Cursors</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_cursors" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-cursors" class="toggle-all" name="paneldantoggleallcursors" value="true" <?php checked('true', $dan_toggle_all_cursors_enable); ?>/>
                        <label for="toggle-all-cursors"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/crosshair/" target="_blank" class="dancepad-dashboard__setting-heading">Crosshair</a>
                        <input type="checkbox" id="panel-dan-crosshair" name="paneldancrosshair" value="true" <?php checked('true', $dan_crosshair_enable); ?>/>
                        <label for="panel-dan-crosshair"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/cursor-trail/" target="_blank" class="dancepad-dashboard__setting-heading">Cursor Trail</a>
                        <input type="checkbox" id="panel-dan-cursor-trail" name="paneldancursortrail" value="true" <?php checked('true', $dan_cursor_trail_enable); ?>/>
                        <label for="panel-dan-cursor-trail"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/cursor/" target="_blank" class="dancepad-dashboard__setting-heading">Cursor</a>
                        <input type="checkbox" id="panel-dan-cursor" name="paneldancursor" value="true" <?php checked('true', $dan_cursor_enable); ?>/>
                        <label for="panel-dan-cursor"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/designer-cursor/" target="_blank" class="dancepad-dashboard__setting-heading">Designer Cursor</a>
                        <input type="checkbox" id="panel-dan-designer-cursor" name="paneldandesignercursor" value="true" <?php checked('true', $dan_designer_cursor_enable); ?>/>
                        <label for="panel-dan-designer-cursor"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/cursor-slide/" target="_blank" class="dancepad-dashboard__setting-heading">Cursor Slide</a>
                        <input type="checkbox" id="panel-dan-cursor-slide" name="paneldancursor_slide" value="true" <?php checked('true', $dan_cursor_slide_enable); ?>/>
                        <label for="panel-dan-cursor-slide"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="sliders" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'sliders' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__sliders-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__sliders-item-title">Sliders</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_sliders" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-sliders" class="toggle-all" name="paneldantoggleallsliders" value="true" <?php checked('true', $dan_toggle_all_sliders_enable); ?>/>
                        <label for="toggle-all-sliders"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/stories/" target="_blank" class="dancepad-dashboard__setting-heading">Stories</a>
                        <input type="checkbox" id="panel-dan-stories" name="paneldanstories" value="true" <?php checked('true', $dan_stories_enable); ?>/>
                        <label for="panel-dan-stories"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/thumbnail-slider/" target="_blank" class="dancepad-dashboard__setting-heading">Thumbnail Slider</a>
                        <input type="checkbox" id="panel-dan-thumbnail-slider" name="paneldanthumbnailslider" value="true" <?php checked('true', $dan_thumbnail_slider_enable); ?>/>
                        <label for="panel-dan-thumbnail-slider"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/infinite-slider/" target="_blank" class="dancepad-dashboard__setting-heading">Infinite Slider</a>
                        <input type="checkbox" id="panel-dan-infinite-slider" name="paneldaninfiniteslider" value="true" <?php checked('true', $dan_infinite_slider_enable); ?>/>
                        <label for="panel-dan-infinite-slider"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/parallax-slider/" target="_blank" class="dancepad-dashboard__setting-heading">Parallax Slider</a>
                        <input type="checkbox" id="panel-dan-parallax-slider" name="paneldanparallaxslider" value="true" <?php checked('true', $dan_parallax_slider_enable); ?>/>
                        <label for="panel-dan-parallax-slider"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="backgrounds" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'backgrounds' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__backgrounds-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__backgrounds-item-title">Backgrounds</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_backgrounds" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-backgrounds" class="toggle-all" name="paneldantoggleallbackgrounds" value="true" <?php checked('true', $dan_toggle_all_backgrounds_enable); ?>/>
                        <label for="toggle-all-backgrounds"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/interactive-lines-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Interactive Lines V2</a>
                        <input type="checkbox" id="panel-dan-interactive-lines-v2" name="paneldaninteractivelinesv2" value="true" <?php checked('true', $dan_interactive_lines_v2_enable); ?>/>
                        <label for="panel-dan-interactive-lines-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/interactive-lines-v3/" target="_blank" class="dancepad-dashboard__setting-heading">Interactive Lines V3</a>
                        <input type="checkbox" id="panel-dan-interactive-lines-v3" name="paneldaninteractivelinesv3" value="true" <?php checked('true', $dan_interactive_lines_v3_enable); ?>/>
                        <label for="panel-dan-interactive-lines-v3"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/interactive-lines-v4/" target="_blank" class="dancepad-dashboard__setting-heading">Interactive Lines V4</a>
                        <input type="checkbox" id="panel-dan-interactive-lines-v4" name="paneldaninteractivelinesv4" value="true" <?php checked('true', $dan_interactive_lines_v4_enable); ?>/>
                        <label for="panel-dan-interactive-lines-v4"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/overlay-shadows/" target="_blank" class="dancepad-dashboard__setting-heading">Overlay Shadows</a>
                        <input type="checkbox" id="panel-dan-overlay-shadows" name="paneldanoverlayshadows" value="true" <?php checked('true', $dan_overlay_shadows_enable); ?>/>
                        <label for="panel-dan-overlay-shadows"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/scrolling-background/" target="_blank" class="dancepad-dashboard__setting-heading">Scrolling Background</a>
                        <input type="checkbox" id="panel-dan-scrolling-background" name="paneldanscrollingbackground" value="true" <?php checked('true', $dan_scrolling_background_enable); ?>/>
                        <label for="panel-dan-scrolling-background"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/interactive-lines/" target="_blank" class="dancepad-dashboard__setting-heading">Interactive Lines</a>
                        <input type="checkbox" id="panel-dan-interactive-lines" name="paneldaninteractivelines" value="true" <?php checked('true', $dan_interactive_lines_enable); ?>/>
                        <label for="panel-dan-interactive-lines"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/tiles-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Tiles V2</a>
                        <input type="checkbox" id="panel-dan-tiles-v2" name="paneldantilesv2" value="true" <?php checked('true', $dan_tiles_v2_enable); ?>/>
                        <label for="panel-dan-tiles-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/border-beam/" target="_blank" class="dancepad-dashboard__setting-heading">Border Beam</a>
                        <input type="checkbox" id="panel-dan-border-beam" name="paneldanborderbeam" value="true" <?php checked('true', $dan_border_beam_enable); ?>/>
                        <label for="panel-dan-border-beam"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/fluids/" target="_blank" class="dancepad-dashboard__setting-heading">Fluids</a>
                        <input type="checkbox" id="panel-dan-fluids" name="paneldanfluids" value="true" <?php checked('true', $dan_fluids_enable); ?>/>
                        <label for="panel-dan-fluids"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/grainy/" target="_blank" class="dancepad-dashboard__setting-heading">Grainy</a>
                        <input type="checkbox" id="panel-dan-grainy" name="paneldangrainy" value="true" <?php checked('true', $dan_grainy_enable); ?>/>
                        <label for="panel-dan-grainy"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/gradiently/" target="_blank" class="dancepad-dashboard__setting-heading">Gradiently</a>
                        <input type="checkbox" id="panel-dan-gradiently" name="paneldangradiently" value="true" <?php checked('true', $dan_gradiently_enable); ?>/>
                        <label for="panel-dan-gradiently"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/particles/" target="_blank" class="dancepad-dashboard__setting-heading">Particles</a>
                        <input type="checkbox" id="panel-dan-particles" name="paneldanparticles" value="true" <?php checked('true', $dan_particles_enable); ?>/>
                        <label for="panel-dan-particles"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/spotlight/" target="_blank" class="dancepad-dashboard__setting-heading">Spotlight</a>
                        <input type="checkbox" id="panel-dan-spotlight" name="paneldanspotlight" value="true" <?php checked('true', $dan_spotlight_enable); ?>/>
                        <label for="panel-dan-spotlight"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/spotlight-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Spotlight V2</a>
                        <input type="checkbox" id="panel-dan-spotlight-v2" name="paneldanspotlightv2" value="true" <?php checked('true', $dan_spotlight_v2_enable); ?>/>
                        <label for="panel-dan-spotlight-v2"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/tiles/" target="_blank" class="dancepad-dashboard__setting-heading">Tiles</a>
                        <input type="checkbox" id="panel-dan-tiles" name="paneldantiles" value="true" <?php checked('true', $dan_tiles_enable); ?>/>
                        <label for="panel-dan-tiles"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/physics/" target="_blank" class="dancepad-dashboard__setting-heading">Physics</a>
                        <input type="checkbox" id="panel-dan-physics" name="paneldanphysics" value="true" <?php checked('true', $dan_physics_enable); ?>/>
                        <label for="panel-dan-physics"></label>
                    </div>
                </div>
            </div>
        </div>

        <div data-tab="cores" class="dancepad-dashboard__content-item
        <?php echo $dan_active_tab === 'cores' ? 'dancepad-dashboard__content-item--active' : ''; ?>">

            <div class="dancepad-dashboard__content-header">
                <div class="dancepad-dashboard__content-title">
                    <div class="dancepad-dashboard__cores-item-icon dancepad-dashboard__sidebar-item-icon"></div>
                    <div class="dancepad-dashboard__cores-item-title">Cores</div>
                </div>

                <div class="dancepad-dashboard__content-save">
                    <button type="submit" name="save_cores" class="dancepad-dashboard__content-submit">Save</button>
                </div>
            </div>

            <div class="dancepad-dashboard__content-items">
                <div class="dancepad-dashboard__search-toggle-all">
                    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" spellcheck="false">

                    <div class="dancepad-dashboard__setting-item dancepad-dashboard__toggle-all">
                        <span class="dancepad-dashboard__setting-heading">Toggle All</span>
                        <input type="checkbox" id="toggle-all-cores" class="toggle-all" name="paneldantoggleallcores" value="true" <?php checked('true', $dan_toggle_all_cores_enable); ?>/>
                        <label for="toggle-all-cores"></label>
                    </div>
                </div>

                <div class="dancepad-dashboard__content-grid">
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/audio-player/" target="_blank" class="dancepad-dashboard__setting-heading">Audio Player</a>
                        <input type="checkbox" id="panel-dan-audio-player" name="paneldanaudioplayer" value="true" <?php checked('true', $dan_audio_player_enable); ?>/>
                        <label for="panel-dan-audio-player"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/looping-tabs/" target="_blank" class="dancepad-dashboard__setting-heading">Looping Tabs</a>
                        <input type="checkbox" id="panel-dan-looping-tabs" name="paneldanloopingtabs" value="true" <?php checked('true', $dan_looping_tabs_enable); ?>/>
                        <label for="panel-dan-looping-tabs"></label>
                    </div>
                    
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/site-loader/" target="_blank" class="dancepad-dashboard__setting-heading">Site Loader</a>
                        <input type="checkbox" id="panel-dan-site-loader" name="paneldansiteloader" value="true" <?php checked('true', $dan_site_loader_enable); ?>/>
                        <label for="panel-dan-site-loader"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/distorsion-tabs/" target="_blank" class="dancepad-dashboard__setting-heading">Distorsion Tabs</a>
                        <input type="checkbox" id="panel-dan-distorsion-tabs" name="paneldandistortiontabs" value="true" <?php checked('true', $dan_distorsion_tabs_enable); ?>/>
                        <label for="panel-dan-distorsion-tabs"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/toolteam/" target="_blank" class="dancepad-dashboard__setting-heading">Toolteam</a>
                        <input type="checkbox" id="panel-dan-toolteam" name="paneldantoolteam" value="true" <?php checked('true', $dan_toolteam_enable); ?>/>
                        <label for="panel-dan-toolteam"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/toast/" target="_blank" class="dancepad-dashboard__setting-heading">Toast</a>
                        <input type="checkbox" id="panel-dan-toast" name="paneldantoast" value="true" <?php checked('true', $dan_toast_enable); ?>/>
                        <label for="panel-dan-toast"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/decode-card/" target="_blank" class="dancepad-dashboard__setting-heading">Decode Card</a>
                        <input type="checkbox" id="panel-dan-decode-card" name="paneldandecodecard" value="true" <?php checked('true', $dan_decode_card_enable); ?>/>
                        <label for="panel-dan-decode-card"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/progress-bar-v2/" target="_blank" class="dancepad-dashboard__setting-heading">Progress Bar V2</a>
                        <input type="checkbox" id="panel-dan-progress-bar-v2" name="paneldanprogressbarv2" value="true" <?php checked('true', $dan_progress_bar_v2_enable); ?>/>
                        <label for="panel-dan-progress-bar-v2"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/pixels-shimmer-card/" target="_blank" class="dancepad-dashboard__setting-heading">Pixels Shimmer Card</a>
                        <input type="checkbox" id="panel-dan-pixels-shimmer-card" name="paneldanpixelsshimmercard" value="true" <?php checked('true', $dan_pixels_shimmer_card_enable); ?>/>
                        <label for="panel-dan-pixels-shimmer-card"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/qr-code/" target="_blank" class="dancepad-dashboard__setting-heading">QR Code</a>
                        <input type="checkbox" id="panel-dan-qr-code" name="paneldanqrcode" value="true" <?php checked('true', $dan_qr_code_enable); ?>/>
                        <label for="panel-dan-qr-code"></label>
                    </div>
                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/parallax-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Parallax Hover</a>
                        <input type="checkbox" id="panel-dan-parallax-hover" name="paneldanparallaxhover" value="true" <?php checked('true', $dan_parallax_hover_enable); ?>/>
                        <label for="panel-dan-parallax-hover"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/stacking-cards/" target="_blank" class="dancepad-dashboard__setting-heading">Stacking Cards</a>
                        <input type="checkbox" id="panel-dan-stacking-cards" name="paneldanstackingcards" value="true" <?php checked('true', $dan_stacking_cards_enable); ?>/>
                        <label for="panel-dan-stacking-cards"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/glitchy/" target="_blank" class="dancepad-dashboard__setting-heading">Glitchy</a>
                        <input type="checkbox" id="panel-dan-glitchy" name="paneldanglitchy" value="true" <?php checked('true', $dan_glitchy_enable); ?>/>
                        <label for="panel-dan-glitchy"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/tippy/" target="_blank" class="dancepad-dashboard__setting-heading">Tippy</a>
                        <input type="checkbox" id="panel-dan-tippy" name="paneldantippy" value="true" <?php checked('true', $dan_tippy_enable); ?>/>
                        <label for="panel-dan-tippy"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/tabs/" target="_blank" class="dancepad-dashboard__setting-heading">Tabs</a>
                        <input type="checkbox" id="panel-dan-tabs" name="paneldantabs" value="true" <?php checked('true', $dan_tabs_enable); ?>/>
                        <label for="panel-dan-tabs"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/accordion/" target="_blank" class="dancepad-dashboard__setting-heading">Accordion</a>
                        <input type="checkbox" id="panel-dan-accordion" name="paneldanaccordion" value="true" <?php checked('true', $dan_accordion_enable); ?>/>
                        <label for="panel-dan-accordion"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/back-to-top/" target="_blank" class="dancepad-dashboard__setting-heading">Back to Top</a>
                        <input type="checkbox" id="panel-dan-back-to-top" name="paneldanbacktop" value="true" <?php checked('true', $dan_back_to_top_enable); ?>/>
                        <label for="panel-dan-back-to-top"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/click-and-copy/" target="_blank" class="dancepad-dashboard__setting-heading">Click and Copy</a>
                        <input type="checkbox" id="panel-dan-click-and-copy" name="paneldanclickandcopy" value="true" <?php checked('true', $dan_click_and_copy_enable); ?>/>
                        <label for="panel-dan-click-and-copy"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/flipbox/" target="_blank" class="dancepad-dashboard__setting-heading">Flipbox</a>
                        <input type="checkbox" id="panel-dan-flipbox" name="paneldanflipbox" value="true" <?php checked('true', $dan_flipbox_enable); ?>/>
                        <label for="panel-dan-flipbox"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/glowing-card/" target="_blank" class="dancepad-dashboard__setting-heading">Glowing Card</a>
                        <input type="checkbox" id="panel-dan-glowing-card" name="paneldanglowingcard" value="true" <?php checked('true', $dan_glowing_card_enable); ?>/>
                        <label for="panel-dan-glowing-card"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/horizontal-marquee/" target="_blank" class="dancepad-dashboard__setting-heading">Horizontal Marquee</a>
                        <input type="checkbox" id="panel-dan-horizontal-marquee" name="paneldanhorizontalmarquee" value="true" <?php checked('true', $dan_horizontal_marquee_enable); ?>/>
                        <label for="panel-dan-horizontal-marquee"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/vertical-marquee/" target="_blank" class="dancepad-dashboard__setting-heading">Vertical Marquee</a>
                        <input type="checkbox" id="panel-dan-vertical-marquee" name="paneldanverticalmarquee" value="true" <?php checked('true', $dan_vertical_marquee_enable); ?>/>
                        <label for="panel-dan-vertical-marquee"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/interactive-divider/" target="_blank" class="dancepad-dashboard__setting-heading">Interactive Divider</a>
                        <input type="checkbox" id="panel-dan-interactive-divider" name="paneldaninteractivedivider" value="true" <?php checked('true', $dan_interactive_divider_enable); ?>/>
                        <label for="panel-dan-interactive-divider"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/inverted-corner/" target="_blank" class="dancepad-dashboard__setting-heading">Inverted Corner</a>
                        <input type="checkbox" id="panel-dan-inverted-corner" name="paneldaninvertedcorner" value="true" <?php checked('true', $dan_inverted_corner_enable); ?>/>
                        <label for="panel-dan-inverted-corner"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/mask-hover/" target="_blank" class="dancepad-dashboard__setting-heading">Mask Hover</a>
                        <input type="checkbox" id="panel-dan-mask-hover" name="paneldanmaskhover" value="true" <?php checked('true', $dan_mask_hover_enable); ?>/>
                        <label for="panel-dan-mask-hover"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/motion-divider/" target="_blank" class="dancepad-dashboard__setting-heading">Motion Divider</a>
                        <input type="checkbox" id="panel-dan-motion-divider" name="paneldanmotiondivider" value="true" <?php checked('true', $dan_motion_divider_enable); ?>/>
                        <label for="panel-dan-motion-divider"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/observer/" target="_blank" class="dancepad-dashboard__setting-heading">Observer</a>
                        <input type="checkbox" id="panel-dan-observer" name="paneldanobserver" value="true" <?php checked('true', $dan_observer_enable); ?>/>
                        <label for="panel-dan-observer"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/progress-bar/" target="_blank" class="dancepad-dashboard__setting-heading">Progress Bar</a>
                        <input type="checkbox" id="panel-dan-progress-bar" name="paneldanprogressbar" value="true" <?php checked('true', $dan_progress_bar_enable); ?>/>
                        <label for="panel-dan-progress-bar"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/scrollbar/" target="_blank" class="dancepad-dashboard__setting-heading">Scrollbar</a>
                        <input type="checkbox" id="panel-dan-scrollbar" name="paneldanscrollbar" value="true" <?php checked('true', $dan_scrollbar_enable); ?>/>
                        <label for="panel-dan-scrollbar"></label>
                    </div>

                    <div class="dancepad-dashboard__setting-item">
                        <a href="https://dancepad.io/smooth-scroll/" target="_blank" class="dancepad-dashboard__setting-heading">Smooth Scroll</a>
                        <input type="checkbox" id="panel-dan-smooth-scroll" name="paneldansmoothscroll" value="true" <?php checked('true', $dan_smooth_scroll_enable); ?>/>
                        <label for="panel-dan-smooth-scroll"></label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    /*switches*/
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = document.querySelectorAll('.dancepad-dashboard__content-item');
        
        tabs.forEach(function(tab) {
            var toggleAll = tab.querySelector('.toggle-all');
            var individualSwitches = tab.querySelectorAll('.dancepad-dashboard__setting-item input[type="checkbox"]');

            if(toggleAll){
                toggleAll.addEventListener('change', function () {
                    var isChecked = toggleAll.checked;
                    individualSwitches.forEach(function (switchElement) {
                        switchElement.checked = isChecked;
                    });
                });
            }
        });
    });
</script>
<script>
    /*search*/
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = document.querySelectorAll('.dancepad-dashboard__content-item');
        
        tabs.forEach(function(tab) {
            var searchInput = tab.querySelector('#searchInput');

            if(searchInput){
                searchInput.addEventListener('keyup', function() {
                    var searchQuery = this.value.toLowerCase();
                    var elements = tab.querySelectorAll('.dancepad-dashboard__setting-item:not(.dancepad-dashboard__toggle-all)');

                    elements.forEach(function(element) {
                        if (element.textContent.toLowerCase().indexOf(searchQuery) === -1) {
                            element.classList.add('dancepad-dashboard__setting-item--hidden');
                        } else {
                            element.classList.remove('dancepad-dashboard__setting-item--hidden');
                        }
                    });
                });
            }
        });
    });
</script>
<?php
/*Switch between tabs*/
$dan_active_tab = get_option('dan_active_tab', 'texts');

wp_register_script( 'dan_active_tab_script', DANCEPAD_PLUGIN_URL . 'licensing/src/change_active_tab.js' );
wp_localize_script('dan_active_tab_script', 'data_tab', array(
    'tab' => $dan_active_tab,
    'ajaxurl' => admin_url('admin-ajax.php'),
));
wp_enqueue_script('dan_active_tab_script');