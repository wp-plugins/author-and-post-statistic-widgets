<div>
    <table class="form-table">
        <tbody>            
            <tr valign="top">
                <th scope="row"><?php _e('Display widgets\' custom html areas', APSW_Core::$APSW_TEXT_DOMAIN); ?></th>
                <td>                                
                    <label for="is_display_custom_html_for_widgets">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_display_custom_html_for_widgets == '1') ?> value="1" name="is_display_custom_html_for_widgets" id="is_display_custom_html_for_widgets" />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Custom CSS to include in header:', APSW_Core::$APSW_TEXT_DOMAIN); ?> </th>
                <td>
                    <label for="custom_css">
                        <textarea cols="50" rows="10" placeholder="<?php _e('Write here your css to include in header:', APSW_Core::$APSW_TEXT_DOMAIN); ?>" id="custom_css" class="custom_css_area" name="custom_css"><?php echo $this->apsw_options_serialized->custom_css; ?></textarea>
                    </label>
                </td>
            </tr>           
        </tbody>
    </table>
</div>