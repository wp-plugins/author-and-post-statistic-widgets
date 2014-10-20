<div id="tabs-4">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">Count post view by: </th>
                <td>
                    <fieldset>
                        <?php
                        $is_post_view_by_ip = $this->options->is_post_view_by_ip;
                        ?>
                        <label title="by ip">
                            <input type="radio" value="1" <?php checked('1' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_ip" class=""/> 
                            <span>IP (for each day)</span>
                        </label><br>
                        <label title="by page reload">
                            <input type="radio" value="2" <?php checked('2' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_page_reload" class="" /> 
                            <span>Page Reload</span>
                        </label><br>                                    
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
</div>