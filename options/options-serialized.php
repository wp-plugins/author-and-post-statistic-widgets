<?php

class Serialize_Options {

    public $stats_option_page_slug = 'stats_options';

    /* ===== GENERAL SETTINGS ===== */

    /* ===== TABS TOGHETER SETTINGS ===== */

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

    /**
     * is jquery tabs by default
     */
    public $is_simple_tabs_default;


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

    /* ===== SIMPLE TABS CSS ===== */
    public $apsw_tab_active_bg_color;
    public $apsw_tab_bg_color;
    public $apsw_tab_border_color;
    public $apsw_tab_active_text_color;
    public $apsw_tab_text_color;
    public $apsw_tab_hover_text_color;

    function __construct() {
        $this->addOptions();
        $this->initOptions(get_option($this->stats_option_page_slug));
    }

    public function addOptions() {
        $options = array(
            'is_stats_together' => '1', // default - show together
            'post_types' => $this->post_types, // include all post types
            'is_simple_tabs_default' => '0', // default - simple tabs
            'is_display_author_name' => '1', // default display name
            'is_display_author_avatar' => '1', // default display avatar
            'is_author_popular_by_post_count' => '1', // default - by count
            'is_popular_posts_by_post_views' => '1', // default - by count
            'popular_authors_limit' => '10', // by default display 10 authors
            'popular_posts_limit' => '10', // by default display 10 posts
            'is_post_view_by_ip' => '1', // default - by ip
            'active_theme_name' => 'smoothness', // default - by ip
            'custom_css' => '', // default - by ip
            'apsw_tab_active_bg_color' => '#fff',
            'apsw_tab_bg_color' => '#ccc',
            'apsw_tab_border_color' => '#d4d4d1',
            'apsw_tab_active_text_color' => '#2e7da3',
            'apsw_tab_text_color' => '#fff',
            'apsw_tab_hover_text_color' => '#21759b',
        );
        add_option($this->stats_option_page_slug, serialize($options));
    }

    public function initOptions($serialize_options) {
        $options = unserialize($serialize_options);
        $this->is_stats_together = $options['is_stats_together'];
        $this->post_types = $options['post_types'];
        $this->is_simple_tabs_default = $options['is_simple_tabs_default'];
        $this->is_display_author_name = $options['is_display_author_name'];
        $this->is_display_author_avatar = $options['is_display_author_avatar'];
        $this->is_author_popular_by_post_count = $options['is_author_popular_by_post_count'];
        $this->is_popular_posts_by_post_views = $options['is_popular_posts_by_post_views'];
        $this->popular_authors_limit = $options['popular_authors_limit'];
        $this->popular_posts_limit = $options['popular_posts_limit'];
        $this->is_post_view_by_ip = $options['is_post_view_by_ip'];
        $this->active_theme_name = $options['active_theme_name'];
        $this->custom_css = $options['custom_css'];
        $this->apsw_tab_active_bg_color = $options['apsw_tab_active_bg_color'];
        $this->apsw_tab_bg_color = $options['apsw_tab_bg_color'];
        $this->apsw_tab_border_color = $options['apsw_tab_border_color'];
        $this->apsw_tab_active_text_color = $options['apsw_tab_active_text_color'];
        $this->apsw_tab_text_color = $options['apsw_tab_text_color'];
        $this->apsw_tab_hover_text_color = $options['apsw_tab_hover_text_color'];
    }

    public function updateOptions() {
        update_option($this->stats_option_page_slug, serialize($this->toArray()));
    }

    public function toArray() {
        $options = array(
            'is_stats_together' => $this->is_stats_together,
            'post_types' => $this->post_types,
            'is_simple_tabs_default' => $this->is_simple_tabs_default,
            'is_display_author_name' => $this->is_display_author_name,
            'is_display_author_avatar' => $this->is_display_author_avatar,
            'is_author_popular_by_post_count' => $this->is_author_popular_by_post_count,
            'is_popular_posts_by_post_views' => $this->is_popular_posts_by_post_views,
            'popular_authors_limit' => $this->popular_authors_limit,
            'popular_posts_limit' => $this->popular_posts_limit,
            'is_post_view_by_ip' => $this->is_post_view_by_ip,
            'active_theme_name' => $this->active_theme_name,
            'custom_css' => $this->custom_css,
            'apsw_tab_active_bg_color' => $this->apsw_tab_active_bg_color,
            'apsw_tab_bg_color' => $this->apsw_tab_bg_color,
            'apsw_tab_border_color' => $this->apsw_tab_border_color,
            'apsw_tab_active_text_color' => $this->apsw_tab_active_text_color,
            'apsw_tab_text_color' => $this->apsw_tab_text_color,
            'apsw_tab_hover_text_color' => $this->apsw_tab_hover_text_color
        );
        return $options;
    }

    public function set_post_types($post_types) {
        $this->post_types = $post_types;
    }

}

?>