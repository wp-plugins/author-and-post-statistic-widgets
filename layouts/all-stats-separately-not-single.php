<div class="separate-wrapper">
    <?php
    $from = APSW_Helper::get_blog_reg_date();
    $to = APSW_Helper::get_now();

    $authors_limit = $this->apsw_options_serialized->popular_authors_limit;
    $posts_limit = $this->apsw_options_serialized->popular_posts_limit;
    ?>
    <div class="stats-block stats-author-block">
        <span class="inner-title"><?php _e('Popular Authors', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>
        <ul class="stats-author-list">
            <?php
            if ($this->apsw_options_serialized->is_author_popular_by_post_count == 1) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_count($from, $to, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_count = $author_data['posts_count'];
                        $author_user_name = $author_data['user_name'];
                        $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $author_id));
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo $author_posts_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_posts.png') ?>" title="<?php _e('posts', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('posts', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-posts-img" />
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            } elseif ($this->apsw_options_serialized->is_author_popular_by_post_count == 2) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_views_count($from, $to, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_views_count = $author_data['view_count'];
                        $author_user_name = $author_data['user_name'];
                        $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $author_id));
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo $author_posts_views_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-views-img" />
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            } else {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_comments_count($from, $to, $authors_limit);
                if (count($authors_data)) {
                    foreach ($authors_data as $author_data) {
                        $author_id = $author_data['author_id'];
                        $author_posts_comments_count = $author_data['c_count'];
                        $author_user_name = $author_data['user_name'];
                        $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $author_id));
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo $author_posts_comments_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-comments-img" />
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>

    <div class="stats-block stats-post-block">
        <span class="inner-title"><?php _e('Popular Posts', APSW_Core::$APSW_TEXT_DOMAIN); ?></span>           
        <ul class="stats-posts-list">
            <?php
            if ($this->apsw_options_serialized->is_popular_posts_by_post_views == 1) {
                $posts_data = $this->apsw_db_helper->get_popular_posts_by_view_count($from, $to, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['post_id'];
                        $post_views_count = $post_data['v_count'];
                        $post_title = $post_data['p_title'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 15); ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php _e('Post views count:', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $post_views_count; ?>">
                                <?php echo $post_views_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-views-img" />
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            } else {
                $posts_data = $this->apsw_db_helper->get_popular_posts_by_commment_count($from, $to, $posts_limit);
                if (count($posts_data)) {
                    foreach ($posts_data as $post_data) {
                        $post_id = $post_data['post_id'];
                        $post_comment_count = $post_data['c_count'];
                        $post_title = $post_data['p_title'];
                        $comment_status = $post_data['c_status'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 15); ?>
                                </span>
                            </a>
                            <?php if ($comment_status === "open") { ?>
                                <a href="<?php echo get_comments_link($post_id); ?>" title="<?php echo __('Comment on', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $post_title; ?>">
                                    <span class="stats-value">
                                        <?php echo $post_comment_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-comments-img" />
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php _e('Comments are closed on this post', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                                    <?php echo $post_comment_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-comments-img" />
                                </span>
                            <?php } ?>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>