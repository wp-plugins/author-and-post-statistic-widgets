<div style="padding-bottom:10px;" id="" class="stats_tabs">
    <ul class="css-tabs tabs-menu">
        <li class="current"><a href="#tabs-1" class="current"><?php _e('Author', APSW_Core::$text_domain); ?></a></li>
        <li><a href="#tabs-2"><?php _e('Posts', APSW_Core::$text_domain) ?></a></li>
    </ul>
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = current_time($date_format);

    $author_cats = $this->apsw_db_helper->get_author_posts_categories($post->post_author);
    $author_tags = $this->apsw_db_helper->get_author_posts_tags($post->post_author);
    $author_taxonomies = array();
    if ($this->apsw_options_serialized->custom_taxonomy_types) {
        $author_taxonomies = $this->apsw_db_helper->get_author_posts_taxonomies($post->post_author);
    }

    $posts_limit = $this->apsw_options_serialized->popular_posts_limit;
    ?>
    <?php if ($this->apsw_options_serialized->is_simple_tabs_default) { ?>
        <div class="tab">
        <?php } ?>
        <div id="tabs-1" class="tab-content">
            <span class="inner-title"><?php _e('Post Author Statistic', APSW_Core::$text_domain); ?></span>
            <div class="sw_author_info">
                <?php
                if ($this->apsw_options_serialized->is_display_author_avatar) {
                    ?>
                    <div class="sw_author_avatar">
                        <a href="<?php echo get_author_posts_url($post->post_author); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . get_userdata($post->post_author)->display_name; ?>">
                            <?php echo get_avatar($post->post_author, 48); ?>
                        </a>
                    </div>
                    <?php
                }

                if ($this->apsw_options_serialized->is_display_author_name) {
                    ?>
                    <div class="sw_author_name">
                        <span class="inner-title">
                            <a href="<?php echo get_author_posts_url($post->post_author); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . get_userdata($post->post_author)->display_name; ?>">
                                <?php echo get_userdata($post->post_author)->display_name; ?>
                            </a>
                        </span>
                    </div>
                    <?php
                }
                ?>  
            </div>
            <ul class="stats-author-list">
                <li class="stats-author-posts-count">
                    <a href="<?php echo get_author_posts_url($post->post_author); ?>" title="<?php echo __('View all posts by', APSW_Core::$text_domain) . ' ' . get_userdata($post->post_author)->display_name; ?>">
                        <span class="stats-label">
                            <?php _e('Total Posts', APSW_Core::$text_domain); ?>
                        </span>
                    </a>
                    <span class="stats-value"><?php echo $this->apsw_db_helper->get_author_all_posts_count($post->post_author, $blog_reg_date, $now); ?></span>
                </li>
                <li class="stats-author-comments-count">
                    <span class="stats-label"><?php _e('Total Comments', APSW_Core::$text_domain); ?></span>
                    <span class="stats-value"><?php echo $this->apsw_db_helper->get_comments_count_by_author($post->post_author); ?></span>
                </li>
                <li class="stats-author-categories-count">
                    <span class="stats-label"><?php _e('Total Categories', APSW_Core::$text_domain); ?></span>
                    <span class="stats-value"><?php echo count($author_cats); ?></span>
                </li>
                <?php if (count($author_cats)) { ?>
                    <li class="stats-author-categories-list">
                        <span class="stats-label"><?php _e('Categories List', APSW_Core::$text_domain); ?></span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list">
                            <?php foreach ($author_cats as $key => $value) { ?>                            
                                <li>
                                    <a href="<?php echo get_category_link($key); ?>" title="<?php echo __('View all posts in category', APSW_Core::$text_domain) . ' ' . $value['name']; ?>">
                                        <span class="stats-label"><?php echo $value['name']; ?></span>
                                    </a>
                                    <span class="stats-value"><?php echo $value['count']; ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>                
                <?php if (count($author_tags)) { ?>
                    <li class="stats-author-tags-list">
                        <span class="stats-label"><?php _e('Tags List', APSW_Core::$text_domain); ?></span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list tags-list">                            
                            <?php foreach ($author_tags as $key => $value) { ?>
                                <li>
                                    <span class="stats-label">
                                        <a href="<?php echo get_tag_link($key); ?>" title="<?php echo __('View all posts tagged as', APSW_Core::$text_domain) . ' ' . $value; ?>">
                                            <?php echo $value; ?>&nbsp; 
                                        </a>
                                    </span>
                                    <span class="stats-value">&nbsp;</span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (count($author_taxonomies)) { ?>
                    <li class="stats-author-taxonomies-list">
                        <span class="stats-label"><?php _e('Custom Taxonomies List', APSW_Core::$text_domain); ?></span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list">
                            <?php foreach ($author_taxonomies as $key => $value) { ?>
                                <li>
                                    <span class="stats-label">
                                        <a href="<?php echo get_term_link($key, $value['taxonomy']); ?>" title="<?php echo __('View all posts under', APSW_Core::$text_domain) . ' ' . $value['name']; ?>">
                                            <?php echo APSW_Helper::sub_string_by_space($value['name'], 2); ?>&nbsp; 
                                        </a>
                                    </span>
                                    <span class="stats-value"><?php echo $value['count']; ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="tabs-2" class="tab-content">
            <span class="inner-title"><?php _e('Author Popular Posts', APSW_Core::$text_domain); ?></span>
            <ul class="stats-posts-list">
                <?php
                if ($this->apsw_options_serialized->is_popular_posts_by_post_views == 1) {
                    $author_popular_posts = $this->apsw_db_helper->get_author_popular_posts_by_view_count($post->post_author, $blog_reg_date, $now, $posts_limit);
                    foreach ($author_popular_posts as $author_popular_post) {
                        $post_id = $author_popular_post['post_id'];
                        $post_title = $author_popular_post['p_title'];
                        $post_views_count = $author_popular_post['view_count'];
                        ?>
                        <li class="stats-post-views-count">
                            <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                <span class="stats-label">
                                    <?php echo APSW_Helper::sub_string_by_space($post_title, 2); ?>
                                </span>
                            </a>
                            <span class="stats-value">
                                <?php echo $post_views_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />                                
                            </span>
                        </li>
                        <?php
                    }
                } else {
                    $author_popular_posts = $this->apsw_db_helper->get_author_popular_posts_by_commment_count($post->post_author, $blog_reg_date, $now, $posts_limit);
                    foreach ($author_popular_posts as $author_popular_post) {
                        $post_id = $author_popular_post['post_id'];
                        $post_title = $author_popular_post['p_title'];
                        $post_comments_count = $author_popular_post['c_count'];
                        $comment_status = $author_popular_post['c_status'];
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
                                        <?php echo $post_comments_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$text_domain) ?>" alt="<?php _e('comments', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-comments-img" />
                                    </span>
                                </a>
                            <?php } else { ?>
                                <span class="stats-value" title="<?php _e('Comments are closed on this post', APSW_Core::$text_domain); ?>">
                                    <?php echo $post_comments_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" title="<?php _e('comments', APSW_Core::$text_domain) ?>" alt="<?php _e('comments', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-comments-img" />
                                </span>
                            <?php } ?>

                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php if ($this->apsw_options_serialized->is_simple_tabs_default) { ?>
        </div>
    <?php } ?>
</div>
<?php if (!$this->apsw_options_serialized->is_simple_tabs_default) { ?>
    <script>
        jQuery(function () {
            jQuery('.stats_tabs').tabs();
        });
    </script>
<?php } ?>