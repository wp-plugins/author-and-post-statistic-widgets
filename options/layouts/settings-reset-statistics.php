<div>
    <table class="form-table">
        <tbody>
            <tr>
                <th colspan="4" scope="col"><h2><?php _e('Delete Statistics', APSW_Core::$text_domain); ?></h2></th>
        </tr>
        <tr valign="top">
            <td>
                <fieldset>
                    <label for="from" title="<?php _e('From Date', APSW_Core::$text_domain); ?>">
                        <span><?php _e('From Date:', APSW_Core::$text_domain); ?></span>
                        <input type="text" class="fromdate" id="from" name="from" placeholder="<?php _e('Example: 2014-06-25 (Y-m-d)', APSW_Core::$text_domain); ?>" />
                    </label>

                    <label for="to" title="<?php _e('To Date', APSW_Core::$text_domain); ?>">
                        <span><?php _e('To Date:', APSW_Core::$text_domain); ?></span>
                        <input type="text" class="todate" id="to" name="to" placeholder="<?php _e('Example: 2014-07-25 (Y-m-d)', APSW_Core::$text_domain); ?>"/>
                    </label>
                    <label>
                        <span><?php _e('Delete All Statistics', APSW_Core::$text_domain); ?></span>
                        <input type="checkbox" id="stats_all" name="all" value="0"/>
                    </label>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td align="center">
                <label>
                    <input class="button button-secondary" type="button" value="Delete" id="delete_stats_between_dates" />
                </label>
            </td>
        </tr>
        </tbody>
    </table>                        
</div>