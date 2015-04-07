<?php

class APSW_Options_Serialize {

    public $apsw_options_page_slug = 'stats_options';

    /*
     * show author and post statistics in one 
     * or separate blocks      
     */
    public $is_stats_together;

    /**
     * display author/user statistics on all pages if logged-in 
     */
    public $is_stats_on_all_pages;

    /*
     * post types for statistics
     */
    public $post_types = array('post', 'page');

    /*
     * Custom taxonomies for statistics
     */
    public $custom_taxonomy_types = array();

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

    /**
     * allow to use custom html for:
     *      before / after widget title
     *      before / after widget content
     *      before / after widget
     */
    public $is_display_custom_html_for_widgets;

    /**
     * custom CSS code to include in header
     */
    public $custom_css;

    function __construct() {
        $this->add_options();
        $this->init_options(get_option($this->apsw_options_page_slug));
    }

    public function add_options() {
        $options = array(
            'is_stats_together' => '1', // default - show together
            'is_stats_on_all_pages' => '1', // default - display on all pages
            'post_types' => $this->post_types, // include all post types
            'custom_taxonomy_types' => $this->custom_taxonomy_types, // default empty
            'is_display_author_name' => '1', // default display name
            'is_display_author_avatar' => '1', // default display avatar
            'is_author_popular_by_post_count' => '1', // default - by count
            'is_popular_posts_by_post_views' => '1', // default - by count
            'popular_authors_limit' => '10', // by default display 10 authors
            'popular_posts_limit' => '10', // by default display 10 posts
            'is_post_view_by_ip' => '1', // default - by ip
            'is_display_daily_views' => '1', // default - display daily views count            
            'is_display_custom_html_for_widgets' => '1', // default - display custom html for widgets
            'custom_css' => '', // default - empty
        );
        add_option($this->apsw_options_page_slug, $options);
    }

    public function init_options($serialize_options) {
        $options = $serialize_options;
        $this->is_stats_together = isset($options['is_stats_together']) ? $options['is_stats_together'] : 1;
        $this->is_stats_on_all_pages = isset($options['is_stats_on_all_pages']) ? $options['is_stats_on_all_pages'] : 0;
        $this->post_types = isset($options['post_types']) ? $options['post_types'] : array("post", "page");
        $this->custom_taxonomy_types = isset($options['custom_taxonomy_types']) ? $options['custom_taxonomy_types'] : array();
        $this->is_display_author_name = $options['is_display_author_name'];
        $this->is_display_author_avatar = $options['is_display_author_avatar'];
        $this->is_author_popular_by_post_count = $options['is_author_popular_by_post_count'];
        $this->is_popular_posts_by_post_views = $options['is_popular_posts_by_post_views'];
        $this->popular_authors_limit = $options['popular_authors_limit'];
        $this->popular_posts_limit = $options['popular_posts_limit'];
        $this->is_post_view_by_ip = isset($options['is_post_view_by_ip']) ? $options['is_post_view_by_ip'] : 1;
        $this->is_display_daily_views = isset($options['is_display_daily_views']) ? $options['is_display_daily_views'] : 0;
        $this->is_display_custom_html_for_widgets = isset($options['is_display_custom_html_for_widgets']) ? $options['is_display_custom_html_for_widgets'] : 0;
        $this->custom_css = $options['custom_css'];
    }

    public function update_options() {
        update_option($this->apsw_options_page_slug, $this->to_array());
    }

    public function to_array() {
        $options = array(
            'is_stats_together' => $this->is_stats_together,
            'is_stats_on_all_pages' => $this->is_stats_on_all_pages,
            'post_types' => $this->post_types,
            'custom_taxonomy_types' => $this->custom_taxonomy_types,
            'is_display_author_name' => $this->is_display_author_name,
            'is_display_author_avatar' => $this->is_display_author_avatar,
            'is_author_popular_by_post_count' => $this->is_author_popular_by_post_count,
            'is_popular_posts_by_post_views' => $this->is_popular_posts_by_post_views,
            'popular_authors_limit' => $this->popular_authors_limit,
            'popular_posts_limit' => $this->popular_posts_limit,
            'is_post_view_by_ip' => $this->is_post_view_by_ip,
            'is_display_daily_views' => $this->is_display_daily_views,
            'is_display_custom_html_for_widgets' => $this->is_display_custom_html_for_widgets,
            'custom_css' => $this->custom_css
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