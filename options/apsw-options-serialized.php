<?php

class APSW_Options_Serialize {

    public $apsw_options_page_slug = 'stats_options';

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

    /*
     * Custom taxonomies for statistics
     */
    public $custom_taxonomy_types = array();

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

    /**
     * show post views count below the post content;
     */
    public $is_display_daily_views;

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
        $this->add_options();
        $this->init_options(get_option($this->apsw_options_page_slug));
    }

    public function add_options() {
        $options = array(
            'is_stats_together' => '1', // default - show together
            'post_types' => $this->post_types, // include all post types
            'custom_taxonomy_types' => $this->custom_taxonomy_types, // default empty
            'is_simple_tabs_default' => '1', // default - simple tabs
            'is_display_author_name' => '1', // default display name
            'is_display_author_avatar' => '1', // default display avatar
            'is_author_popular_by_post_count' => '1', // default - by count
            'is_popular_posts_by_post_views' => '1', // default - by count
            'popular_authors_limit' => '10', // by default display 10 authors
            'popular_posts_limit' => '10', // by default display 10 posts
            'is_post_view_by_ip' => '1', // default - by ip
            'is_display_daily_views' => '1', // default - display views count
            'active_theme_name' => 'smoothness', // default - smoothness
            'custom_css' => '', // default - empty
            'apsw_tab_active_bg_color' => '#fff',
            'apsw_tab_bg_color' => '#ccc',
            'apsw_tab_border_color' => '#d4d4d1',
            'apsw_tab_active_text_color' => '#2e7da3',
            'apsw_tab_text_color' => '#fff',
            'apsw_tab_hover_text_color' => '#21759b',
        );
        add_option($this->apsw_options_page_slug, $options);
    }

    public function init_options($serialize_options) {
        $options = $serialize_options;
        $this->is_stats_together = $options['is_stats_together'];
        $this->post_types = $options['post_types'];
        $this->custom_taxonomy_types = isset($options['custom_taxonomy_types']) ? $options['custom_taxonomy_types'] : array();
        $this->is_simple_tabs_default = $options['is_simple_tabs_default'];
        $this->is_display_author_name = $options['is_display_author_name'];
        $this->is_display_author_avatar = $options['is_display_author_avatar'];
        $this->is_author_popular_by_post_count = $options['is_author_popular_by_post_count'];
        $this->is_popular_posts_by_post_views = $options['is_popular_posts_by_post_views'];
        $this->popular_authors_limit = $options['popular_authors_limit'];
        $this->popular_posts_limit = $options['popular_posts_limit'];
        $this->is_post_view_by_ip = $options['is_post_view_by_ip'];
        $this->is_display_daily_views = isset($options['is_display_daily_views']) ? $options['is_display_daily_views'] : 0;
        $this->active_theme_name = isset($options['active_theme_name']) ? $options['active_theme_name'] : 'smoothness';
        $this->custom_css = $options['custom_css'];
        $this->apsw_tab_active_bg_color = isset($options['apsw_tab_active_bg_color']) ? $options['apsw_tab_active_bg_color'] : '#fff';
        $this->apsw_tab_bg_color = isset($options['apsw_tab_bg_color']) ? $options['apsw_tab_bg_color'] : '#ccc';
        $this->apsw_tab_border_color = isset($options['apsw_tab_border_color']) ? $options['apsw_tab_border_color'] : '#d4d4d1';
        $this->apsw_tab_active_text_color = isset($options['apsw_tab_active_text_color']) ? $options['apsw_tab_active_text_color'] : '#2e7da3';
        $this->apsw_tab_text_color = isset($options['apsw_tab_text_color']) ? $options['apsw_tab_text_color'] : '#fff';
        $this->apsw_tab_hover_text_color = isset($options['apsw_tab_hover_text_color']) ? $options['apsw_tab_hover_text_color'] : '#21759b';
    }

    public function update_options() {
        update_option($this->apsw_options_page_slug, $this->to_array());
    }

    public function to_array() {
        $options = array(
            'is_stats_together' => $this->is_stats_together,
            'post_types' => $this->post_types,
            'custom_taxonomy_types' => $this->custom_taxonomy_types,
            'is_simple_tabs_default' => $this->is_simple_tabs_default,
            'is_display_author_name' => $this->is_display_author_name,
            'is_display_author_avatar' => $this->is_display_author_avatar,
            'is_author_popular_by_post_count' => $this->is_author_popular_by_post_count,
            'is_popular_posts_by_post_views' => $this->is_popular_posts_by_post_views,
            'popular_authors_limit' => $this->popular_authors_limit,
            'popular_posts_limit' => $this->popular_posts_limit,
            'is_post_view_by_ip' => $this->is_post_view_by_ip,
            'is_display_daily_views' => $this->is_display_daily_views,
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

    public function set_taxonomy_types($taxonomy_types) {
        $this->custom_taxonomy_types = $taxonomy_types;
    }

}

?>