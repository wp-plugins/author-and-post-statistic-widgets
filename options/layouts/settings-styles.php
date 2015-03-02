<div id="tabs-5">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><?php _e('Jquery UI CSS Theme: ', APSW_Core::$text_domain); ?></th>
                <td>
                    <label for="switcher">
                        <div id="switcher" style="display: inline-block;"></div>
                        <input type="hidden" name="active_theme_name" id="stats_active_theme" value=""/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Custom CSS to include in header:', APSW_Core::$text_domain); ?> </th>
                <td>
                    <label for="custom_css">
                        <textarea cols="50" rows="10" placeholder="<?php _e('Write here your css to include in header:', APSW_Core::$text_domain); ?>" id="custom_css" class="custom_css_area" name="custom_css"> <?php echo $this->apsw_options_serialized->custom_css; ?></textarea>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Use Simple Tabs', APSW_Core::$text_domain) ?>:
                </th>
                <td>                                
                    <label for="is_simple_tabs_default">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_simple_tabs_default == 1); ?> value="1" name="is_simple_tabs_default" id="is_simple_tabs_default" />
                    </label>
                </td>
            </tr>

            <?php if ($this->apsw_options_serialized->is_simple_tabs_default) { ?>

                <tr id="apsw_simple_tabs_styles">
                    <td colspan="2">
                        <table>
                            <tbody>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_active_bg_color"><?php _e('Active Tab Background Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_active_bg_color; ?>" id="apsw_tab_active_bg_color" name="apsw_tab_active_bg_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal1">
                                            <img class="apsw_colorpicker_img1" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal1" class="modalDialog">
                                            <div id="apsw_box1">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder1"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_bg_color"><?php _e('Tab Background Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_bg_color; ?>" id="apsw_tab_bg_color" name="apsw_tab_bg_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal2">
                                            <img class="apsw_colorpicker_img2" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal2" class="modalDialog">
                                            <div id="apsw_box2">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder2"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_border_color"><?php _e('Tab Border Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_border_color; ?>" id="apsw_tab_border_color" name="apsw_tab_border_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal3">
                                            <img class="apsw_colorpicker_img3" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal3" class="modalDialog">
                                            <div id="apsw_box3">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder3"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_active_text_color"><?php _e('Active Tab Title Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_active_text_color; ?>" id="apsw_tab_active_text_color" name="apsw_tab_active_text_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal4">
                                            <img class="apsw_colorpicker_img4" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal4" class="modalDialog">
                                            <div id="apsw_box4">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder4"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_text_color"><?php _e('Tab Title Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_text_color; ?>" id="apsw_tab_text_color" name="apsw_tab_text_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal5">
                                            <img class="apsw_colorpicker_img5" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal5" class="modalDialog">
                                            <div id="apsw_box5">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder5"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr valign="top">
                                    <th scope="row">
                                        <label for="apsw_tab_hover_text_color"><?php _e('Tab Hover Title Color', APSW_Core::$text_domain); ?>: </label>
                                    </th>
                                    <td>
                                        <input type="text" class="regular-text" value="<?php echo $this->apsw_options_serialized->apsw_tab_hover_text_color; ?>" id="apsw_tab_hover_text_color" name="apsw_tab_hover_text_color" placeholder="<?php _e('Example: #f0000f', APSW_Core::$text_domain); ?>"/>
                                    </td>

                                    <td class="picker_img_cell">
                                        <a href="#apsw_openModal6">
                                            <img class="apsw_colorpicker_img6" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/colorpicker_icon_22.png'); ?>" />
                                        </a>
                                    </td>
                                    <td class="color_picker">
                                        <div id="apsw_openModal6" class="modalDialog">
                                            <div id="apsw_box6">
                                                <a href="#close" title="Close" class="close">X</a>
                                                <h2>Color Picker</h2>
                                                <p id="apsw_colorpickerHolder6"></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>