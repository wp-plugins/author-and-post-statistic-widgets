<div class="separate-wrapper">
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = current_time($date_format);

    $authors_limit = $this->apsw_options_serialized->popular_authors_limit;
    $posts_limit = $this->apsw_options_serialized->popular_posts_limit;
    ?>
    <div class="stats-block stats-author-block">
        <span class="inner-title"><?php _e('Popular Authors', APSW_Core::$text_domain); ?></span>
        <ul class="stats-author-list">
            <?php
            if ($this->apsw_options_serialized->is_author_popular_by_post_count == 1) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_count($blog_reg_date, $now, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_count = $author_data['posts_count'];
                        $author_user_name = $author_data['user_name'];
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . $author_user_name; ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                            	<?php echo $author_posts_count ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_posts.png') ?>" title="<?php _e('posts', APSW_Core::$text_domain) ?>" alt="<?php _e('posts', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-posts-img" />
                                <?php //echo ($author_posts_count == 1) ? $author_posts_count . ' ' . __('post', APSW_Core::$text_domain) : $author_posts_count . ' ' . __('posts', APSW_Core::$text_domain); ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            } elseif ($this->apsw_options_serialized->is_author_popular_by_post_count == 2) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_views_count($blog_reg_date, $now, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_views_count = $author_data['view_count'];
                        $author_user_name = $author_data['user_name']
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . $author_user_name; ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                            	<?php echo $author_posts_views_count ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />
                                <?php echo ($author_posts_views_count == 1) ? $author_posts_views_count . ' ' . __('view', APSW_Core::$text_domain) : $author_posts_views_count . ' ' . __('views', APSW_Core::$text_domain); ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            } else {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_comments_count($blog_reg_date, $now, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_comments_count = $author_data['c_count'];
                        $author_user_name = $author_data['user_name'];
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . $author_user_name; ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo ($author_posts_comments_count == 1) ? $author_posts_comments_count . ' ' . __('comment', APSW_Core::$text_domain) : $author_posts_comments_count . ' ' . __('comments', APSW_Core::$text_domain) ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>

    <div class="stats-block stats-post-block">
        <span class="inner-title"><?php _e('Popular Posts', APSW_Core::$text_domain); ?></span>           
        <ul class="stats-posts-list">
            <?php
            if ($this->apsw_options_serialized->is_popular_posts_by_post_views == 1) {
                $posts_data = $this->apsw_db_helper->get_popular_posts_by_view_count($blog_reg_date, $now, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['post_id'];
                        $post_views_count = $post_data['v_count'];
                        $post_title = $post_data['p_title'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e('Post views count:', APSW_Core::$text_domain) . ' ' . $post_views_count; ?>">
                            	<?php echo $post_views_count ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />
                                <?php //echo ($post_views_count == 1) ? $post_views_count . ' ' . __('view', APSW_Core::$text_domain) : $post_views_count . ' ' . __('views', APSW_Core::$text_domain) ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            } else {
                $posts_data = $this->apsw_db_helper->get_popular_posts_by_commment_count($blog_reg_date, $now, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['post_id'];
                        $post_comment_count = $post_data['c_count'];
                        $post_title = $post_data['p_title'];
                        $comment_status = $post_data['c_status'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <?php if ($comment_status === "open") { ?>
                                <a href="<?php echo get_comments_link($post_id); ?>" title="<?php echo __('Comment on', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                    <span class="stats-value">
                                        <?php echo ($post_comment_count == 1) ? $post_comment_count . ' ' . __('comment', APSW_Core::$text_domain) : $post_comment_count . ' ' . __('comments', APSW_Core::$text_domain) ?>
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php _e('Comments are closed on this post', APSW_Core::$text_domain); ?>">
                                    <?php echo ($post_comment_count == 1) ? $post_comment_count . ' ' . __('comment', APSW_Core::$text_domain) : $post_comment_count . ' ' . __('comments', APSW_Core::$text_domain) ?>
                                </span>
                            <?php } ?>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>