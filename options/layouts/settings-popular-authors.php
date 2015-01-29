<div id="tabs-2">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    Display Author Full Name:
                </th>
                <td>                                
                    <label for="is_display_author_name">
                        <input type="checkbox" <?php checked($this->options->is_display_author_name == '1') ?> value="<?php echo $this->options->is_display_author_name; ?>" name="is_display_author_name" id="is_display_author_name" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    Display Author Avatar:
                </th>
                <td>                                
                    <label for="is_display_author_avatar">
                        <input type="checkbox" <?php checked($this->options->is_display_author_avatar == '1') ?> value="<?php echo $this->options->is_display_author_avatar; ?>" name="is_display_author_avatar" id="is_display_author_avatar" />
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Show popular author by posts:</th>
                <td>
                    <fieldset>
                        <?php
                        $is_author_popular_by_post_count = $this->options->is_author_popular_by_post_count;
                        ?>
                        <label title="by posts count">
                            <input type="radio" value="1" <?php checked('1' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_count" class=""/> 
                            <span>Count</span>
                        </label><br>
                        <label title="by posts view">
                            <input type="radio" value="2" <?php checked('2' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_view_count" class="" /> 
                            <span>Views</span>
                        </label><br>
                        <label title="by posts comments count">
                            <input type="radio" value="3" <?php checked('3' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_posts_comments_count" class="" /> 
                            <span>Comment Count</span>
                        </label><br>
                    </fieldset>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Popular authors limit: </th>
                <td>
                    <fieldset>
                        <?php
                        $popular_authors_limit = $this->options->popular_authors_limit;
                        ?>
                        <label title="How many popular authors display in widget">
                            <input type="text" value="<?php echo $popular_authors_limit; ?>" name="popular_authors_limit" id="popular_authors_limit" class=""/>                                        
                        </label><br>                                   
                    </fieldset>
                </td>
            </tr>
        </tbody>
    </table>
</div>