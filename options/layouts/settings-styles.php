<div>
    <table class="form-table">
        <tbody>            
            <tr valign="top">
                <th scope="row"><?php _e('Custom CSS to include in header:', APSW_Core::$text_domain); ?> </th>
                <td>
                    <label for="custom_css">
                        <textarea cols="50" rows="10" placeholder="<?php _e('Write here your css to include in header:', APSW_Core::$text_domain); ?>" id="custom_css" class="custom_css_area" name="custom_css"><?php echo $this->apsw_options_serialized->custom_css; ?></textarea>
                    </label>
                </td>
            </tr>           
        </tbody>
    </table>
</div>