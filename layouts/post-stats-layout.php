<div class="separate-wrapper">
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = current_time($date_format);

    $posts_limit = $this->apsw_options_serialized->popular_posts_limit;

    if (empty($from)) {
        $from = $blog_reg_date;
    }
    if (empty($to)) {
        $to = $now;
    }
    ?>
    <div class="stats-block stats-post-block">        
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
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <span class="stats-value">
                            	<?php echo $post_views_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', APSW_Core::$text_domain); ?>
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
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <?php if ($comment_status === "open") { ?>
                                <a href="<?php echo get_comments_link($post_id); ?>" title="<?php echo __('Comment on', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                    <span class="stats-value">
                                        <?php echo $post_comment_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$text_domain) ?>" alt="<?php _e('comments', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-comments-img" />
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php echo __('Comments are closed on this post', APSW_Core::$text_domain); ?>">
                                    <?php echo $post_comment_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$text_domain) ?>" alt="<?php _e('comments', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-comments-img" />
                                </span>
                            <?php } ?>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', APSW_Core::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>