<?php

class Serialize_Options {

    public $stats_option_page_slug = 'stats_options';

    /*
     * show author and post statistics in one 
     * or separate blocks      
     */
    public $is_stats_together;

    /* ===== POST TYPES SETTINGS ===== */

    /*
     * post types for statistics
     */
    public $post_types = array('post', 'page');


    /* ===== MOST POPULAR AUTHOR SETTINGS ===== */

    /**
     * Display author name 
     */
    public $is_display_author_name;

    /**
     * Display author avatar 
     */
    public $is_display_author_avatar;

    /*
     * define author popularity by 
     * posts/pages count or post/page views
     * 1 => by posts count
     * 2 => by posts views
     * 3 => by posts comments count
     */
    public $is_author_popular_by_post_count;

    /*
     * popular authors limit in widgets
     */
    public $popular_authors_limit;


    /* ===== MOST POPULAR POST SETTINGS ===== */


    /*
     * define posts popularity by 
     * posts/pages count or post/page views
     * 1 => by views
     * 2 => by comment count
     */
    public $is_popular_posts_by_post_views;

    /*
     * popular posts limit in widgets
     */
    public $popular_posts_limit;

    /*
     * how to count post wiew by ip or page reload
     * 1 => by ip (default)
     * 2 => by page reload
     */
    public $is_post_view_by_ip;

    /* ===== STYLES SETTINGS ===== */
    public $active_theme_name;
    public $custom_css;

    function __construct() {
        $this->addOptions();
        $this->initOptions(get_option($this->stats_option_page_slug));
    }

    public function addOptions() {
        $options = array(
            'is_stats_together' => '1', // default - show together
            'post_types' => $this->post_types, // include all post types
            'is_display_author_name' => '1', // default display name
            'is_display_author_avatar' => '1', // default display avatar
            'is_author_popular_by_post_count' => '1', // default - by count
            'is_popular_posts_by_post_views' => '1', // default - by count
            'popular_authors_limit' => '10', // by default display 10 authors
            'popular_posts_limit' => '10', // by default display 10 posts
            'is_post_view_by_ip' => '1', // default - by ip
            'active_theme_name' => 'smoothness', // default - by ip
            'custom_css' => '', // default - by ip
        );
        add_option($this->stats_option_page_slug, serialize($options));
    }

    public function initOptions($serialize_options) {
        $options = unserialize($serialize_options);
        $this->is_stats_together = $options['is_stats_together'];
        $this->post_types = $options['post_types'];
        $this->is_display_author_name = $options['is_display_author_name'];
        $this->is_display_author_avatar = $options['is_display_author_avatar'];
        $this->is_author_popular_by_post_count = $options['is_author_popular_by_post_count'];
        $this->is_popular_posts_by_post_views = $options['is_popular_posts_by_post_views'];
        $this->popular_authors_limit = $options['popular_authors_limit'];
        $this->popular_posts_limit = $options['popular_posts_limit'];
        $this->is_post_view_by_ip = $options['is_post_view_by_ip'];
        $this->active_theme_name = $options['active_theme_name'];
        $this->custom_css = $options['custom_css'];
    }

    public function updateOptions() {
        update_option($this->stats_option_page_slug, serialize($this->toArray()));
    }

    public function toArray() {
        $options = array(
            'is_stats_together' => $this->is_stats_together,
            'post_types' => $this->post_types,
            'is_display_author_name' => $this->is_display_author_name,
            'is_display_author_avatar' => $this->is_display_author_avatar,
            'is_author_popular_by_post_count' => $this->is_author_popular_by_post_count,
            'is_popular_posts_by_post_views' => $this->is_popular_posts_by_post_views,
            'popular_authors_limit' => $this->popular_authors_limit,
            'popular_posts_limit' => $this->popular_posts_limit,
            'is_post_view_by_ip' => $this->is_post_view_by_ip,
            'active_theme_name' => $this->active_theme_name,
            'custom_css' => $this->custom_css
        );
        return $options;
    }

    public function set_post_types($post_types) {
        $this->post_types = $post_types;
    }

}

?>