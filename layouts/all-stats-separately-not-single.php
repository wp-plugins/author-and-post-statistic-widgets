<div class="separate-wrapper">
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = date($date_format);

    $authors_limit = $this->options->popular_authors_limit;
    $posts_limit = $this->options->popular_posts_limit;
    ?>
    <div class="stats-block stats-author-block">
        <span class="inner-title"><?php _e('Popular Authors', Statistic_Info::$text_domain); ?></span>        
        <ul class="stats-author-list">
            <?php
            if ($this->options->is_author_popular_by_post_count == 1) {
                $authors_data = $this->statistic->get_popular_authors_by_posts_count($blog_reg_date, $now, $authors_limit);                
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_count = $author_data['posts_count'];
                        $author_user_name = $author_data['user_name'];
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php _e('View all posts by ' . $author_user_name); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e(' Posts count: ' . $author_posts_count, Statistic_Info::$text_domain); ?>">                                
                                <?php echo ($author_posts_count == 1) ? $author_posts_count . __(' post', Statistic_Info::$text_domain) : $author_posts_count . __(' posts', Statistic_Info::$text_domain); ?>
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            } elseif ($this->options->is_author_popular_by_post_count == 2) {
                $authors_data = $this->statistic->get_popular_authors_by_posts_views_count($blog_reg_date, $now, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_views_count = $author_data['view_count'];
                        $author_user_name = $author_data['user_name']
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php _e('View all posts by ' . $author_user_name); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e('Posts views: ' . $author_posts_views_count, Statistic_Info::$text_domain); ?>">                         
                                <?php echo ($author_posts_count == 1) ? $author_posts_views_count . __(' view', Statistic_Info::$text_domain) : __($author_posts_views_count . ' views', Statistic_Info::$text_domain) ?>
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            } else {
                $authors_data = $this->statistic->get_popular_authors_by_comments_count($blog_reg_date, $now, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_comments_count = $author_data['c_count'];
                        $author_user_name = $author_data['user_name'];
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php _e('View all posts by ' . $author_user_name); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e('Posts comments count: ' . $author_posts_comments_count, Statistic_Info::$text_domain) ?>">                         
                                <?php echo ($author_posts_comments_count == 1) ? __($author_posts_comments_count . ' comment', Statistic_Info::$text_domain) : __($author_posts_comments_count . ' comments', Statistic_Info::$text_domain) ?>
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>

    <div class="stats-block stats-post-block">
        <span class="inner-title"><?php _e('Popular Posts', Statistic_Info::$text_domain); ?></span>           
        <ul class="stats-posts-list">
            <?php
            if ($this->options->is_popular_posts_by_post_views == 1) {
                $posts_data = $this->statistic->get_popular_posts_by_view_count($blog_reg_date, $now, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['post_id'];
                        $post_views_count = $post_data['v_count'];
                        $post_title = $post_data['p_title'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php _e('View ' . $post_title); ?>">
                                <span class="stats-label">
                                    <?php echo Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e('Post views count: ' . $post_views_count, Statistic_Info::$text_domain); ?>">
                                <?php echo ($post_views_count == 1) ? __($post_views_count . ' view', Statistic_Info::$text_domain) : __($post_views_count . ' views', Statistic_Info::$text_domain) ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            } else {
                $posts_data = $this->statistic->get_popular_posts_by_commment_count($blog_reg_date, $now, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['c_post'];
                        $post_comment_count = $post_data['c_count'];
                        $post_title = $post_data['p_title'];
                        $comment_status = $post_data['c_status'];
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
                                        <?php echo ($post_comment_count == 1) ? __($post_comment_count . ' comment', Statistic_Info::$text_domain) : __($post_comment_count . ' comments', Statistic_Info::$text_domain) ?>
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php _e('Comments are closed on this post', Statistic_Info::$text_domain); ?>">
                                    <?php echo ($post_comment_count == 1) ? __($post_comment_count . ' comment', Statistic_Info::$text_domain) : __($post_comment_count . ' comments', Statistic_Info::$text_domain) ?>
                                </span>
                            <?php } ?>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>