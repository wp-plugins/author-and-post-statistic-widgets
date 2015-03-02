<div id="tabs-4">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><?php _e('Count post view by:', APSW_Core::$text_domain); ?> </th>
                <td>
                    <fieldset>
                        <?php
                        $is_post_view_by_ip = $this->apsw_options_serialized->is_post_view_by_ip;
                        ?>
                        <label title="by ip">
                            <input type="radio" value="1" <?php checked('1' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_ip" class=""/> 
                            <span><?php _e('IP (for each day)', APSW_Core::$text_domain); ?></span>
                        </label><br>
                        <label title="by page reload">
                            <input type="radio" value="2" <?php checked('2' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_page_reload" class="" /> 
                            <span><?php _e('Page Reload', APSW_Core::$text_domain); ?></span>
                        </label><br>                                    
                    </fieldset>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Display posts\' daily views count', APSW_Core::$text_domain); ?></th>
                <td>                                
                    <label for="is_display_daily_views">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_display_daily_views == '1') ?> value="1" name="is_display_daily_views" id="is_display_daily_views" />
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>