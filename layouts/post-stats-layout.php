<div class="separate-wrapper">
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = date($date_format);

    $posts_limit = $this->options->popular_posts_limit;

    if (empty($from)) {
        $from = $blog_reg_date;
    }
    if (empty($to)) {
        $to = $now;
    }
    ?>
    <div class="stats-block stats-post-block">
        <!--<span class="inner-title"><?php _e('Popular posts', Statistic_Info::$text_domain); ?></span>-->
        <ul class="stats-posts-list">
            <?php
            if ($this->options->is_popular_posts_by_post_views == 1) {
                $posts_data = $this->statistic->get_popular_posts_by_view_count($from, $to, $posts_limit);
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
                            <span class="stats-value" title="<?php _e($post_title . ' has ', Statistic_Info::$text_domain); ?>">
                                <?php echo ($post_views_count == 1) ? __($post_views_count . ' view', Statistic_Info::$text_domain) : __($post_views_count . ' views', Statistic_Info::$text_domain) ?>
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            } else {
                $posts_data = $this->statistic->get_popular_posts_by_commment_count($from, $to, $posts_limit);
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
                        <?php _e('There are no data between selected dates', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>