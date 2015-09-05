<div>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Show author and post statistics in:', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label>
                        <input type="radio" <?php checked($this->apsw_options_serialized->is_stats_together == '1') ?> value="1" name="is_stats_together" id="is_stats_tabbed" />
                        <span><?php _e('Tabs', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
                    </label><br/>
                    <label>
                        <input type="radio" <?php checked($this->apsw_options_serialized->is_stats_together == '2') ?> value="2" name="is_stats_together" id="is_stats_separate" />
                        <span><?php _e('Separate blocks', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Display author/user statistic on all pages', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                </th>
                <td>       
                    <label for="apsw_is_stats_on_all_pages">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_stats_on_all_pages == '1'); ?> value="1" name="is_stats_on_all_pages" id="apsw_is_stats_on_all_pages" />
                    </label>
                </td>
            </tr>            

            <tr valign="top">
                <th scope="row">
                    <?php _e('Create statistic for post and taxonomy types:', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <?php
                    foreach ($all_post_types as $post_type) {
                        $post_type_checked = in_array($post_type['post_type'], $this->apsw_options_serialized->post_types);
                        $taxonomy_css = ($post_type_checked) ? 'block' : 'none';
                        ?>
                        <div class="post_type_wrapper">
                            <label for="apsw_<?php echo $post_type['post_type']; ?>">
                                <input type="checkbox" <?php checked($post_type_checked); ?> value="<?php echo $post_type['post_type']; ?>" name="post_types[]" id="apsw_<?php echo $post_type['post_type']; ?>" class="apsw_post_taxonomy_types" />
                                <span><?php echo $post_type['post_type']; ?></span>
                            </label>
                            <?php
                            if ($post_type['taxonomies']) {
                                ?>
                                <div class="taxonomy_type_wrapper" style="display: <?php echo $taxonomy_css; ?>;">
                                    <?php
                                    foreach ($post_type['taxonomies'] as $taxonomies) {
                                        ?>
                                        <label for="apsw_<?php echo $taxonomies['taxonomy']; ?>">
                                            <input type="checkbox" <?php checked(in_array($taxonomies['taxonomy'], $this->apsw_options_serialized->custom_taxonomy_types)); ?> value="<?php echo $taxonomies['taxonomy']; ?>" name="custom_taxonomy_types[]" id="apsw_<?php echo $taxonomies['taxonomy']; ?>" />
                                            <span><?php echo $taxonomies['taxonomy']; ?></span>
                                        </label><br/>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>