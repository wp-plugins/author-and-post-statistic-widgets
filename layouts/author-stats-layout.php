<div class="separate-wrapper">   
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = current_time($date_format);

    $authors_limit = $this->apsw_options_serialized->popular_authors_limit;

    if (empty($from)) {
        $from = $blog_reg_date;
    }
    if (empty($to)) {
        $to = $now;
    }
    ?>
    <div class="stats-block stats-author-block">        
        <ul class="stats-author-list">
            <?php
            if ($this->apsw_options_serialized->is_author_popular_by_post_count == 1) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_count($from, $to, $authors_limit);
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
                            <span class="stats-value" title="<?php echo __('Posts count:', APSW_Core::$text_domain) . ' ' . $author_posts_count; ?>">
                                <?php echo $author_posts_count ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_posts.png') ?>" title="<?php _e('posts', APSW_Core::$text_domain) ?>" alt="<?php _e('posts', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-posts-img" />								
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
            } elseif ($this->apsw_options_serialized->is_author_popular_by_post_count == 2) {
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_posts_views_count($from, $to, $authors_limit);
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
                            <span class="stats-value" title="<?php echo __('Posts views:', APSW_Core::$text_domain) . ' ' . $author_posts_views_count; ?>">
                            	<?php echo $author_posts_views_count ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />                                
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
                $authors_data = $this->apsw_db_helper->get_popular_authors_by_comments_count($from, $to, $authors_limit);
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
                            <span class="stats-value" title="<?php echo __('Posts comments count:', APSW_Core::$text_domain) . ' ' . $author_posts_comments_count; ?>">
                                <?php echo $author_posts_comments_count; ?> <img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$text_domain) ?>" alt="<?php _e('comments', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-comments-img" />                                
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
            }
            ?>
        </ul>
    </div>
</div>