<div style="padding-bottom:10px;" id="allStatisticSTab" class="stats_tabs">
    <ul class="css-tabs tabs-menu resp-tabs-list hor_1">
        <li><?php _e('Author', APSW_Core::$text_domain); ?></li>
        <?php if (!in_array('subscriber', $apsw_user->roles)) { ?>
            <li><?php _e('Posts', APSW_Core::$text_domain) ?></li>
        <?php } ?>
    </ul>
    <?php
    $blogusers = get_users('orderby=registered&order=asc');
    $first_user = $blogusers[0];
    $date_format = 'Y-m-d';
    $time = get_user_option('user_registered', $first_user->ID);
    $blog_reg_date = date($date_format, strtotime($time));
    $now = current_time($date_format);

    $author_cats = $this->apsw_db_helper->get_author_posts_categories($apsw_user_id);
    $author_tags = $this->apsw_db_helper->get_author_posts_tags($apsw_user_id);
    $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $apsw_user_id));
    
    $author_taxonomies = array();
    if ($this->apsw_options_serialized->custom_taxonomy_types) {
        $author_taxonomies = $this->apsw_db_helper->get_author_posts_taxonomies($apsw_user_id);
    }

    $posts_limit = $this->apsw_options_serialized->popular_posts_limit;
    ?>
    <div class="resp-tabs-container hor_1">
        <div><!-- Author Tab -->
            <?php if (in_array('subscriber', $apsw_user->roles) || ($this->apsw_options_serialized->is_stats_on_all_pages && is_user_logged_in())) { ?>
                <span class="inner-title"><?php _e('Current User Statistic', APSW_Core::$text_domain); ?></span>
            <?php } else { ?>
                <span class="inner-title"><?php _e('Post Author Statistic', APSW_Core::$text_domain); ?></span>
            <?php } ?>
            <div class="sw_author_info">
                <?php
                if ($this->apsw_options_serialized->is_display_author_avatar) {
                    ?>
                    <div class="sw_author_avatar">
                        <?php if (!in_array('subscriber', $apsw_user->roles)) { ?>
                            <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$text_domain); ?>">
                                <?php echo get_avatar($apsw_user_id, 48); ?>
                            </a>
                            <?php
                        } else {
                            echo get_avatar($apsw_user_id, 48);
                        }
                        ?>
                    </div>
                    <?php
                }

                if ($this->apsw_options_serialized->is_display_author_name) {
                    ?>
                    <div class="sw_author_name">
                        <span class="inner-title">
                            <?php if (!in_array('subscriber', $apsw_user->roles)) { ?>
                                <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$text_domain); ?>">
                                    <?php echo get_userdata($apsw_user_id)->display_name; ?>
                                </a>
                                <?php
                            } else {
                                echo get_userdata($apsw_user_id)->display_name;
                            }
                            ?>
                        </span>
                    </div>
                    <?php
                }
                ?>  
            </div>
            <ul class="stats-author-list">
                <li class="stats-author-posts-count">
                    <?php if (!in_array('subscriber', $apsw_user->roles)) { ?>
                        <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$text_domain); ?>">
                            <span class="stats-label">
                                <?php _e('Total Posts', APSW_Core::$text_domain); ?>
                            </span>
                        </a>
                    <?php } else { ?>
                        <span class="stats-label">
                            <?php _e('Total Posts', APSW_Core::$text_domain); ?>
                        </span>
                    <?php } ?>
                    <span class="stats-value"><?php echo $this->apsw_db_helper->get_author_all_posts_count($apsw_user_id, $blog_reg_date, $now); ?></span>
                </li>
                <li class="stats-author-comments-count">
                    <span class="stats-label"><?php _e('Total Comments', APSW_Core::$text_domain); ?></span>
                    <span class="stats-value"><?php echo $this->apsw_db_helper->get_comments_count_by_author($apsw_user_id); ?></span>
                </li>
                <li class="stats-author-categories-count">
                    <span class="stats-label"><?php _e('Total Categories', APSW_Core::$text_domain); ?></span>
                    <span class="stats-value"><?php echo count($author_cats); ?></span>
                </li>
                <?php if ($author_cats) { ?>
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
                <?php if ($author_tags) { ?>
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
                <?php if ($author_taxonomies) { ?>
                    <li class="stats-author-taxonomies-list">
                        <span class="stats-label"><?php _e('Custom Taxonomies List', APSW_Core::$text_domain); ?></span>
                        <span class="stats-value">&nbsp;</span>
                        <ul class="nested-list">
                            <?php foreach ($author_taxonomies as $key => $value) { ?>
                                <li>
                                    <span class="stats-label">
                                        <a href="<?php echo get_term_link($key, $value['taxonomy']); ?>" title="<?php echo __('View all posts under', APSW_Core::$text_domain) . ' ' . $value['name']; ?>">
                                            <?php echo APSW_Helper::sub_string_by_space($value['name'], 15); ?>&nbsp; 
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
        <?php if (!in_array('subscriber', $apsw_user->roles)) { ?>
            <div><!-- Post Tab -->
                <span class="inner-title"><?php _e('Author Popular Posts', APSW_Core::$text_domain); ?></span>
                <ul class="stats-posts-list">
                    <?php
                    if ($this->apsw_options_serialized->is_popular_posts_by_post_views == 1) {
                        $author_popular_posts = $this->apsw_db_helper->get_author_popular_posts_by_view_count($apsw_user_id, $blog_reg_date, $now, $posts_limit);
                        foreach ($author_popular_posts as $author_popular_post) {
                            $post_id = $author_popular_post['post_id'];
                            $post_title = $author_popular_post['p_title'];
                            $post_views_count = $author_popular_post['view_count'];
                            ?>
                            <li class="stats-post-views-count">
                                <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                    <span class="stats-label">
                                        <?php echo APSW_Helper::sub_string_by_space($post_title, 15); ?>
                                    </span>
                                </a>
                                <span class="stats-value">
                                    <?php echo $post_views_count ?> <img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_views.png') ?>" title="<?php _e('views', APSW_Core::$text_domain) ?>" alt="<?php _e('views', APSW_Core::$text_domain) ?>" align="absmiddle" class="apsw-views-img" />                                
                                </span>
                            </li>
                            <?php
                        }
                    } else {
                        $author_popular_posts = $this->apsw_db_helper->get_author_popular_posts_by_commment_count($apsw_user_id, $blog_reg_date, $now, $posts_limit);
                        foreach ($author_popular_posts as $author_popular_post) {
                            $post_id = $author_popular_post['post_id'];
                            $post_title = $author_popular_post['p_title'];
                            $post_comments_count = $author_popular_post['c_count'];
                            $comment_status = $author_popular_post['c_status'];
                            ?>
                            <li class="stats-post-views-count">
                                <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo __('View', APSW_Core::$text_domain) . ' ' . $post_title; ?>">
                                    <span class="stats-label">
                                        <?php echo APSW_Helper::sub_string_by_space($post_title, 15); ?>
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
        <?php } ?>
    </div>
</div>
<script>
    jQuery(function ($) {
        $('#allStatisticSTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1' // The tab groups identifier
        });
    });
</script>