<div id="tabs-3">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">Show popular posts by: </th>
                <td>
                    <fieldset>
                        <?php
                        $is_popular_posts_by_post_views = $this->options->is_popular_posts_by_post_views;
                        ?>
                        <label title="by post views">
                            <input type="radio" value="1" <?php checked('1' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_views" class=""/> 
                            <span>Views</span>
                        </label><br>
                        <label title="by post comments count">
                            <input type="radio" value="2" <?php checked('2' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_comments" class="" /> 
                            <span>Comment Count</span>
                        </label><br>                                    
                    </fieldset>
                </td>
            </tr>                        

            <tr valign="top">
                <th scope="row">Popular posts limit: </th>
                <td>
                    <fieldset>
                        <?php
                        $popular_posts_limit = $this->options->popular_posts_limit;
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