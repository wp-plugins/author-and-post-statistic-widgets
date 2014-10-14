<div id="tabs-1">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    Show author and post statistics in:
                </th>
                <td>                                
                    <label>
                        <input type="radio" <?php checked($this->options->is_stats_together == '1') ?> value="1" name="is_stats_together" id="is_stats_tabbed" />
                        <span>Tabs</span>
                    </label><br/>
                    <label>
                        <input type="radio" <?php checked($this->options->is_stats_together == '2') ?> value="2" name="is_stats_together" id="is_stats_separate" />
                        <span>Separate blocks</span>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    Create statistic for post types:
                </th>
                <td>                                
                    <?php
                    foreach ($this->post_types as $post_type) {
                        ?>
                        <label for="<?php echo $post_type ?>">
                            <input type="checkbox" <?php checked(in_array($post_type, $this->options->post_types)); ?> value="<?php echo $post_type; ?>" name="post_types[]" id="<?php echo $post_type; ?>" />
                            <span><?php echo $post_type; ?></span>
                        </label><br/>
                        <?php
                    }
                    ?>
                </td>
            </tr>

        </tbody>
    </table>

</div>