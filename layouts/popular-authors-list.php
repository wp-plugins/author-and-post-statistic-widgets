<?php
$date_format = 'Y-m-d';
$interval = APSW_Helper::get_dynamic_date_intervals($last, $date_format);
$from = $interval['from'];
$to = $interval['to'];
?>

<div class="separate-wrapper">
    <div class="stats-block popular-authors-list-block">
        <ul class="stats-popular-authors-list">
            <?php
            $authors_limit = $this->apsw_options_serialized->popular_authors_limit;
            $popular_authors = $this->apsw_db_helper->get_popular_authors_list($from, $to, $authors_limit);
            
            foreach ($popular_authors as $popular_author) {
                $author_id = $popular_author['author_id'];
                $author_user_name = $popular_author['user_name'];
                $author_posts_count = $popular_author['posts_count'];
                $author_comments_count = $popular_author['comments_count'];
                $author_profile_url = APSW_Helper::get_profile_url(get_user_by('id', $author_id));
                ?>
                <li class="stats-popular-author-list">
                    <a href="<?php echo $author_profile_url; ?>" title="<?php echo __('View user profile page', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                        <span class="stats-label">
                            <?php echo $author_user_name; ?>
                        </span>
                    </a>
					
                    <div class="stats-value stats-comments-count" title="<?php echo __('Comments count', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                    	<img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_comments.png') ?>" align="absmiddle" class="apsw-comments-img" /><span class="apsw-comments-num"><?php echo ($author_comments_count) ? $author_comments_count : 0; ?></span>
                    </div>

                    <div class="stats-value stats-posts-count" title="<?php echo __('Posts count', APSW_Core::$APSW_TEXT_DOMAIN); ?>">
                    	<img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon_posts.png') ?>" align="absmiddle" class="apsw-posts-img" /><span class="apsw-comments-num"><?php echo ($author_posts_count) ? $author_posts_count : 0; ?></span>
                        &nbsp;
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>