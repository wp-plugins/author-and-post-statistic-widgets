<div class="separate-wrapper">   
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = date($date_format);

    $authors_limit = $this->options->popular_authors_limit;

    if (empty($from)) {
        $from = $blog_reg_date;
    }
    if (empty($to)) {
        $to = $now;
    }
    ?>
    <div class="stats-block stats-author-block">        
        <!--<span class="inner-title"><?php _e('Popular Authors', Statistic_Info::$text_domain); ?></span>-->        
        <ul class="stats-author-list">
            <?php
            if ($this->options->is_author_popular_by_post_count == 1) {
                $authors_data = $this->statistic->get_popular_authors_by_posts_count($from, $to, $authors_limit);
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
                        <?php _e('There are no data between selected dates', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            } elseif ($this->options->is_author_popular_by_post_count == 2) {
                $authors_data = $this->statistic->get_popular_authors_by_posts_views_count($from, $to, $authors_limit);
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
                                <?php echo ($author_posts_count == 1) ? __($author_posts_views_count . ' view', Statistic_Info::$text_domain) : __($author_posts_views_count . ' views', Statistic_Info::$text_domain) ?>
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
                $authors_data = $this->statistic->get_popular_authors_by_comments_count($from, $to, $authors_limit);
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
                        <?php _e('There are no data between selected dates', Statistic_Info::$text_domain); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>