<?php
$date_format = 'Y-m-d';
$interval = APSW_Helper::get_date_intervals($date_interval, $date_format);
$from = $interval['from'];
$to = $interval['to'];
?>

<div class="separate-wrapper">
    <div class="stats-block popular-posts-list-block">
        <ul class="stats-popular-posts-list">
            <?php
            $posts_limit = $this->apsw_options_serialized->popular_posts_limit;
            $popular_posts = $this->apsw_db_helper->get_popular_posts_list($from, $to, $posts_limit);

            foreach ($popular_posts as $popular_post) {
                $post_id = $popular_post['post_id'];
                $post_title = $popular_post['p_title'];
                $post_views_count = $popular_post['v_count'];
                $post_comments_count = $popular_post['c_count'];
                ?>
                <li class="stats-popular-post-list">
                    <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View ', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                        <span class="stats-label">
                            <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                        </span>
                    </a>

                    <div class="stats-value stats-comments-count" title="<?php echo __('Post comments count', APSW_Core::$text_domain); ?>">
                    	<img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" align="absmiddle" class="apsw-comments-img" /><span class="apsw-comments-num"><?php echo ($post_comments_count) ? $post_comments_count : 0; ?></span>
                    </div>                    

                    <div class="stats-value stats-views-count" title="<?php echo __('Post views count', APSW_Core::$text_domain); ?>">
                        <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" /><span class="apsw-views-num"><?php echo ($post_views_count) ? $post_views_count : 0; ?></span>
                        &nbsp;
                    </div>

                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>