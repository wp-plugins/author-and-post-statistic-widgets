<div class="separate-wrapper">   
    <?php
    $authors_limit = $this->apsw_options_serialized->popular_authors_limit;

    if (!$from) {
        $from = APSW_Helper::get_blog_reg_date();
    }
    if (!$to) {
        $to = APSW_Helper::get_now();
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
                        $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $author_id));
                        ?>
                        <li class="stats-author-posts-count">
                            <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                                <span class="stats-label">
                                    <?php echo $author_user_name; ?>
                                </span>
                            </a>
                            <span class="stats-value" title="<?php echo __('Posts count:', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $author_posts_count; ?>">
                                <?php echo $author_posts_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_posts.png') ?>" title="<?php _e('posts', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('posts', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-posts-img" />								
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', APSW_Core::$APSW_TEXT_DOMAIN); ?>
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
                            <span class="stats-value" title="<?php echo __('Posts views:', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $author_posts_views_count; ?>">
                                <?php echo $author_posts_views_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('views', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-views-img" />                                
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', APSW_Core::$APSW_TEXT_DOMAIN); ?>
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
                            <span class="stats-value" title="<?php echo __('Posts comments count:', APSW_Core::$APSW_TEXT_DOMAIN) . ' ' . $author_posts_comments_count; ?>">
                                <?php echo $author_posts_comments_count; ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" alt="<?php _e('comments', APSW_Core::$APSW_TEXT_DOMAIN) ?>" align="absmiddle" class="apsw-comments-img" />                                
                            </span>

                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span class="empty_data">
                        <?php _e('There are no data between selected dates', APSW_Core::$APSW_TEXT_DOMAIN); ?>
                    </span>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>