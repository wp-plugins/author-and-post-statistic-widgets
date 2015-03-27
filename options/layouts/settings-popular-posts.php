<div>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><?php _e('Show popular posts by:', APSW_Core::$text_domain); ?> </th>
                <td>
                    <fieldset>
                        <?php
                        $is_popular_posts_by_post_views = $this->apsw_options_serialized->is_popular_posts_by_post_views;
                        ?>
                        <label title="by post views">
                            <input type="radio" value="1" <?php checked('1' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_views" class=""/> 
                            <span><?php _e('Views', APSW_Core::$text_domain); ?></span>
                        </label><br>
                        <label title="by post comments count">
                            <input type="radio" value="2" <?php checked('2' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_comments" class="" /> 
                            <span><?php _e('Comment Count', APSW_Core::$text_domain); ?></span>
                        </label><br>                                    
                    </fieldset>
                </td>
            </tr>                        

            <tr valign="top">
                <th scope="row"><?php _e('Popular posts limit:', APSW_Core::$text_domain); ?> </th>
                <td>
                    <fieldset>
                        <?php
                        $popular_posts_limit = $this->apsw_options_serialized->popular_posts_limit;
                        ?>
                        <label title="How many popular posts display in widget">
                            <input type="text" value="<?php echo $popular_posts_limit; ?>" name="popular_posts_limit" id="popular_posts_limit" class=""/>                                        
                        </label><br>                                   
                    </fieldset>
                </td>
            </tr>                              
        </tbody>
    </table>
</div>