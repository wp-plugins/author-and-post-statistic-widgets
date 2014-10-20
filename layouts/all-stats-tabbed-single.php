<div style="padding-bottom:10px;" id="" class="stats_tabs">
    <ul class="css-tabs tabs-menu">
        <li class="current"><a href="#tabs-1" class="current"><?php _e('Author', Statistic_Info::$text_domain); ?></a></li>
        <li><a href="#tabs-2"><?php _e('Posts', Statistic_Info::$text_domain) ?></a></li>
    </ul>
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = date($date_format);

    $author_cats = $this->statistic->get_author_posts_categories($post->post_author);
    $posts_limit = $this->options->popular_posts_limit;
    ?>
    <?php if ($this->options->is_simple_tabs_default) { ?>
        <div class="tab">
        <?php } ?>
        <div id="tabs-1" class="tab-content">
            <!--<span class="inner-title"><?php _e('Post Author Statistic', Statistic_Info::$text_domain); ?></span>-->
            <div class="sw_author_info">
                <?php
                if ($this->options->is_display_author_avatar) {
                    ?>
                    <div class="sw_author_avatar">
                        <a href="<?php echo get_author_posts_url($post->post_author); ?>" title="<?php _e('View all posts by ' . get_userdata($post->post_author)->display_name, Statistic_Info::$text_domain); ?>">
                            <?php echo get_avatar($post->post_author, 48); ?>
                        </a>
                    </div>
                    <?php
                }

                if ($this->options->is_display_author_name) {
                    ?>
                    <div class="sw_author_name">
                        <a href="<?php echo get_author_posts_url($post->post_author); ?>" title="<?php _e('View all posts by ' . get_userdata($post->post_author)->display_name, Statistic_Info::$text_domain); ?>">
                            <?php echo get_userdata($post->post_author)->display_name; ?>
                        </a>
                    </div>
                    <?php
                }
                ?>  
            </div>
            <ul class="stats-author-list">
                <li class="stats-author-posts-count">
                    <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                        <span class="stats-label">
                            Total Posts
                        </span>
                    </a>
                    <span class="stats-value"><?php echo $this->statistic->get_author_all_posts_count($post->post_author, $blog_reg_date, $now); ?></span>
                </li>
                <li class="stats-author-comments-count">
                    <span class="stats-label">Total Comments</span>
                    <span class="stats-value"><?php echo $this->statistic->get_all_comment_count($post->post_author); ?></span>
                </li>
                <li class="stats-author-categories-count">
                    <span class="stats-label">Total Categories</span>
                    <span class="stats-value"><?php echo count($author_cats); ?></span>
                </li>
                <?php if (count($author_cats)) { ?>
                    <li class="stats-author-categories-list">
                        <span class="stats-label">Categories List</span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list">
                            <?php foreach ($author_cats as $key => $value) { ?>
                                <li>
                                    <a href="<?php echo get_category_link($key); ?>">
                                        <span class="stats-label"><?php echo $value['name']; ?></span>
                                    </a>
                                    <span class="stats-value"><?php echo $value['count']; ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php $author_tags = $this->statistic->get_author_posts_tags($post->post_author); ?>
                <?php if (count($author_tags)) { ?>
                    <li class="stats-author-tags-list">
                        <span class="stats-label">Tags List</span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list tags-list">                            
                            <?php foreach ($author_tags as $key => $value) { ?>
                                <li>
                                    <span class="stats-label">
                                        <a href="<?php echo get_tag_link($key); ?>">
                                            <?php echo $value; ?>&nbsp; 
                                        </a>
                                    </span>
                                    <span class="stats-value">&nbsp;</span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="tabs-2" class="tab-content">
            <span class="inner-title"><?php _e('Author Popular Posts ', Statistic_Info::$text_domain); ?></span>
            <ul class="stats-posts-list">
                <?php
                if ($this->options->is_popular_posts_by_post_views == 1) {
                    $author_popular_posts = $this->statistic->get_author_popular_posts_by_view_count($post->post_author, $blog_reg_date, $now, $posts_limit);
                    foreach ($author_popular_posts as $author_popular_post) {
                        $post_id = $author_popular_post['post_id'];
                        $post_title = $author_popular_post['p_title'];
                        $post_views_count = $author_popular_post['view_count'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php _e('View ' . $post_title); ?>">
                                <span class="stats-label">
                                    <?php echo Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo ($post_views_count == 1) ? __($post_views_count . ' view', Statistic_Info::$text_domain) : __($post_views_count . ' views', Statistic_Info::$text_domain); ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    $author_popular_posts = $this->statistic->get_author_popular_posts_by_commment_count($post->post_author, $blog_reg_date, $now, $posts_limit);
                    foreach ($author_popular_posts as $author_popular_post) {
                        $post_id = $author_popular_post['post_id'];
                        $post_title = $author_popular_post['p_title'];
                        $post_comments_count = $author_popular_post['c_count'];
                        $comment_status = $author_popular_post['c_status'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php _e('View ' . $post_title); ?>">
                                <span class="stats-label">
                                    <?php echo Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <?php if ($comment_status === "open") { ?>
                                <a href="<?php echo get_comments_link($post_id); ?>" title="<?php _e('Comment on ' . $post_title, Statistic_Info::$text_domain); ?>">                               
                                    <span class="stats-value">
                                        <?php echo ($post_comments_count == 1) ? __($post_comments_count . ' comment', Statistic_Info::$text_domain) : __($post_comments_count . ' comments', Statistic_Info::$text_domain); ?>
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php _e('Comments are closed on this post', Statistic_Info::$text_domain); ?>">
                                    <?php echo ($post_comments_count == 1) ? __($post_comments_count . ' comment', Statistic_Info::$text_domain) : __($post_comments_count . ' comments', Statistic_Info::$text_domain); ?>
                                </span>
                            <?php } ?>

                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php if ($this->options->is_simple_tabs_default) { ?>
        </div>
    <?php } ?>
</div>
<?php if (!$this->options->is_simple_tabs_default) { ?>
    <script>
        jQuery(function () {
            jQuery('.stats_tabs').tabs();
        });
    </script>
<?php } ?>