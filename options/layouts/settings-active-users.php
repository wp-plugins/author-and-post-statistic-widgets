<div id="tabs-2">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <?php _e('Display user full name:', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="is_display_author_name">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_display_author_name == '1') ?> value="1" name="is_display_author_name" id="is_display_author_name" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Display user avatar:', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                </th>
                <td>                                
                    <label for="is_display_author_avatar">
                        <input type="checkbox" <?php checked($this->apsw_options_serialized->is_display_author_avatar == '1') ?> value="1" name="is_display_author_avatar" id="is_display_author_avatar" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Show active users by posts:', APSW_Core::$APSW_TEXT_DOMAIN); ?></th>
                <td>
                    <fieldset>
                        <?php
                        $is_author_popular_by_post_count = $this->apsw_options_serialized->is_author_popular_by_post_count;
                        ?>
                        <label title="by posts count">
                            <input type="radio" value="1" <?php checked('1' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_count" class=""/> 
                            <span><?php _e('Count', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
                        </label><br>
                        <label title="by posts view">
                            <input type="radio" value="2" <?php checked('2' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_view_count" class="" /> 
                            <span><?php _e('Views', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
                        </label><br>
                        <label title="by posts comments count">
                            <input type="radio" value="3" <?php checked('3' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_posts_comments_count" class="" /> 
                            <span><?php _e('Comment Count', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
                        </label><br>
                    </fieldset>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Active users limit:', APSW_Core::$APSW_TEXT_DOMAIN); ?> </th>
                <td>
                    <fieldset>
                        <?php
                        $popular_authors_limit = $this->apsw_options_serialized->popular_authors_limit;
                        ?>
                        <label title="How many active users display in widget">
                            <input type="text" value="<?php echo $popular_authors_limit; ?>" name="popular_authors_limit" id="popular_authors_limit" class=""/>
                        </label><br>                                   
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
</div>