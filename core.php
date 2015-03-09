<?php

/*
  Plugin Name: Author and Post Statistic Widgets
  Description: Adds awesome statistic widgets for displaying authors activity and posts popularity. This plugin displays adaptive statistical information depending on current opened category, post and page.
  Version: 1.4.1
  Author: gVectors Team (Gagik Zakaryan & Hakob Martirosyan)
  Author URI: http://gvectors.com
  Plugin URI: http://gvectors.com/author-and-post-statistic-widgets/
 */

/*
  Copyright 2014 gVectors.com and Authors (Gagik Zakaryan & Hakob Martirosyan).
  Support email: support@gvectors.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define('APSW_PLUGIN_DIR', plugin_dir_path(__FILE__));

include_once 'options/apsw-options.php';
include_once 'widget/widget-statistics.php';
include_once 'widget/widget-active-users.php';
include_once 'widget/widget-post.php';
include_once 'widget/widget-popular-author-list.php';
include_once 'widget/widget-popular-post-list.php';
include_once 'includes/apsw-db-helper.php';
include_once 'includes/apsw-helper.php';
include_once 'apsw-css.php';

class APSW_Core {

    public static $text_domain = 'apsw';
    public $apsw_options;
    public $apsw_options_serialized;
    public $apsw_db_helper;
    public $w_author;
    public $apsw_css;
    public $apsw_version = 'apsw_version';
    public static $PLUGIN_DIRECTORY;

    function __construct() {
        add_action('admin_init', array(&$this, 'apsw_plugin_new_version'), 2);
        add_action('init', array(&$this, 'init_plugin_dir_name'), 1);
        add_action('plugins_loaded', array(&$this, 'load_apsw_text_domain'));
        $this->apsw_db_helper = new APSW_DB_Helper();
        $this->apsw_options = new APSW_Options($this->apsw_db_helper);
        $this->apsw_options_serialized = $this->apsw_options->get_default_options();
        register_activation_hook(__FILE__, array($this, 'create_tables'));
        add_action('admin_enqueue_scripts', array(&$this, 'option_page_styles_scripts'));
        add_action('widgets_init', array(&$this, 'init_widgets'));
        add_action('wp_enqueue_scripts', array(&$this, 'front_end_styles_scripts'));
        add_action('admin_menu', array(&$this, 'add_plugin_options_page'));
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        add_action('wp_head', array(&$this, 'add_post_view_count'));

        if ($this->apsw_options_serialized->is_simple_tabs_default) {
            $this->apsw_css = new APSW_CSS($this->apsw_options_serialized);
            add_action('wp_enqueue_scripts', array(&$this->apsw_css, 'load_custom_css'));
        }

        if (function_exists('add_shortcode')) {
            add_shortcode('author_stats', array(&$this, 'author_statistics'));
            add_shortcode('post_stats', array(&$this, 'post_statistics'));
        }

        if ($this->apsw_options_serialized->is_display_daily_views) {
            add_filter('the_content', array(&$this, 'apsw_display_daily_views'));
        }
        
        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$plugin", array(&$this, 'apsw_add_plugin_settings_link'));

        add_action('wp_ajax_delete_stats_key', array(&$this, 'delete_stats'));
        add_action('wp_enqueue_scripts', array(&$this, 'frontend_styles'), 1);
    }

    public function apsw_plugin_new_version() {
        $apsw_version = (!get_option($this->apsw_version) ) ? '1.0.0' : get_option($this->apsw_version);
        $apsw_plugin_data = get_plugin_data(__FILE__);
        if (version_compare($apsw_plugin_data['Version'], $apsw_version, '>')) {
            $this->apsw_add_new_options();
            if ($apsw_version === '1.0.0') {
                add_option($this->apsw_version, $apsw_plugin_data['Version']);
            } else {
                update_option($this->apsw_version, $apsw_plugin_data['Version']);
            }
        }
    }

    private function apsw_add_new_options() {
        $this->apsw_options_serialized->init_options(get_option($this->apsw_options_serialized->apsw_options_page_slug));
        $apsw_new_options = $this->apsw_options_serialized->to_array();
        update_option($this->apsw_options_serialized->apsw_options_page_slug, serialize($apsw_new_options));
    }

    /*
     * load plugin text domain 
     */

    public function load_apsw_text_domain() {
        load_plugin_textdomain('apsw', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * display posts' daily views count
     */
    public function apsw_display_daily_views($content) {
        global $post;
        if (!is_singular()) {
            return do_shortcode($content);
        }
        $date_format = 'Y-m-d';
        $alltime_interval = APSW_Helper::get_date_intervals(7, $date_format);
        $alltime_from = $alltime_interval['from'];
        $alltime_to = $alltime_interval['to'];
        $alltime_views = $this->apsw_db_helper->get_post_views_count($post->ID, $alltime_from, $alltime_to);

        $daily_interval = APSW_Helper::get_date_intervals(1, $date_format);
        $daily_from = $daily_interval['from'];
        $daily_to = $daily_interval['to'];
        $daily_views = $this->apsw_db_helper->get_post_views_count($post->ID, $daily_from, $daily_to);

        $html = '<div class="apsw_views_count_wrapper">';
        $html .= '<div class="apsw_views_all_time">';

        $html .= '<div class="apsw_post_views_title"><img src="' . plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon-stat.gif') . '" align="absmiddle" class="apsw-stat-img-views_all" /> ' . __('Views All Time', APSW_Core::$text_domain) . '</div>';
        $html .= '<div class="apsw_post_views_value">' . $alltime_views . '</div>';
        $html .= '<div style="clear:both"></div>';
        $html .= '</div>';
        $html .= '<div class="apsw_views_daily">';
        $html .= '<div class="apsw_post_views_title"><img src="' . plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/icon-stat-today.gif') . '" align="absmiddle" class="apsw-stat-img-views_today" /> ' . __('Views Today', APSW_Core::$text_domain) . '</div>';
        $html .= '<div class="apsw_post_views_value">' . $daily_views . '</div>';
        $html .= '<div style="clear:both"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return do_shortcode($content) . $html;
    }

    /**
     * Register widgets
     */
    public function init_widgets() {
        register_widget('APSW_Statistic_Widget');
        register_widget('APSW_Active_Users_Widget');
        register_widget('APSW_Post_Widget');
        register_widget('APSW_Popular_Author_List');
        register_widget('APSW_Popular_Posts_List');
    }

    /**
     * add view count for post/page or custom post types     
     */
    public function add_post_view_count() {
        global $post;
        $post_id = '';
        if (!is_singular()) {
            return;
        }
        if (empty($post_id)) {
            $post_id = $post->ID;
        }
        $ip = APSW_Helper::get_real_ip_addr();
        $this->apsw_db_helper->add_view_count($post_id, current_time('Y-m-d'), $ip);
    }

    /**
     * Scripts and styles registration on administration pages
     */
    public function option_page_styles_scripts() {
        wp_register_style('sw-plugin-css', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/css/admin-css.css'));
        wp_enqueue_style('sw-plugin-css');
        wp_enqueue_script('option-scripts', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/admin-js.js'), array('jquery'), '1.0.0', false);

        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-datepicker');

        wp_enqueue_script('theme-switcher', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/jquery-ui/jquery.themeswitcher.js'), array('jquery', 'jquery-ui-core'), '1.0.0');
        wp_register_style('jquery-ui-theme', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/css/jquery-ui-themes/themes/') . $this->apsw_options_serialized->active_theme_name . '/jquery-ui.min.css');
        wp_enqueue_style('jquery-ui-theme');

        wp_enqueue_script('sw-ajax-js', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/ajax-delete.js'), array('jquery'), '1.0.0', false);
        wp_enqueue_script('sw-cookie-js', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/jquery.cookie.js'), array('jquery'), '1.4.1', false);
        wp_enqueue_script('apsw-widgets-js', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/widgets-js.js'), array('jquery'), '1.0.0', false);

        if ($this->apsw_options_serialized->is_simple_tabs_default) {
            wp_register_style('apsw-modal-css', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box.css'));
            wp_enqueue_style('apsw-modal-css');
            wp_register_style('apsw-colorpicker-css', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/css/colorpicker.css'));
            wp_enqueue_style('apsw-colorpicker-css');
            wp_enqueue_script('apsw-colorpicker-js', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/third-party/colorpicker/js/colorpicker.js'), array('jquery'), '1.0.0', false);
            wp_enqueue_script('apsw-admin-colorpicker-js', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/admin-colorpicker.js'), array('jquery'), '1.0.0', false);


            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match('/MSIE/i', $u_agent)) {
                wp_register_style('apsw-modal-css-ie', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/third-party/modal-box/modal-box-ie.css'));
                wp_enqueue_style('apsw-modal-css-ie');
            }
        }
    }

    /**
     * Styles and scripts registration to use on front page
     */
    public function front_end_styles_scripts() {
        wp_register_style('sw-frontend-style', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/css/frontend-css.css'), null, get_option($this->apsw_version));
        wp_enqueue_style('sw-frontend-style');


        // option
        if ($this->apsw_options_serialized->is_simple_tabs_default) {
            wp_enqueue_script('apsw-simple-tabs', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/js/simple-tabs.js'), array('jquery'), '1.0.0', false);
        } else {
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-tabs');
            wp_register_style('jquery-ui-theme', plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/css/jquery-ui-themes/themes/') . $this->apsw_options_serialized->active_theme_name . '/jquery-ui.min.css');
            wp_enqueue_style('jquery-ui-theme');
        }
    }

    public function frontend_styles() {
        $style = '<style type="text/css">' . $this->apsw_options_serialized->custom_css . '</style>';
        echo $style;
    }

    /**
     * register options page for plugin
     */
    public function add_plugin_options_page() {
        if (function_exists('add_options_page')) {
            add_menu_page('Statistic Widgets', 'Statistic Widgets', 'manage_options', 'stats_options', array(&$this->apsw_options, 'options_form'), plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/statistics-icon-20.png'), 4256);
        }
    }

    /*
     * cretae statistics tables in database on plugin activation
     */

    public function create_tables() {
        $this->apsw_db_helper->create_tables();
    }

    /*
     * delete statistics between to date via ajax
     */

    public function delete_stats() {
        $all = 0;
        $from = 0;
        $to = 0;

        if (isset($_POST['all'])) {
            $all = $_POST['all'];
        }
        if (isset($_POST['from'])) {
            $from = $_POST['from'];
        }
        if (isset($_POST['to'])) {
            $to = $_POST['to'];
        }
        echo ($this->apsw_db_helper->delete_statistics($all, $from, $to) ? _e('Statistical data has been removed', APSW_Core::$text_domain) : _e('Failed to delete statistical data', APSW_Core::$text_domain));
        exit();
    }

    public function show_stats_post($from, $to) {
        global $post;
        include 'layouts/post-stats-layout.php';
    }

    public function show_stats_author($from, $to) {
        include 'layouts/author-stats-layout.php';
    }

    public function show_stats() {
        global $post;
        if ($this->apsw_options_serialized->is_stats_together == 1) {
            if (is_singular()) {
                include 'layouts/all-stats-tabbed-single.php';
            } else {
                include 'layouts/all-stats-tabbed-not-single.php';
            }
        } else {
            if (is_singular()) {
                include 'layouts/all-stats-separately-single.php';
            } else {
                include 'layouts/all-stats-separately-not-single.php';
            }
        }
    }

    public function init_plugin_dir_name() {
        $plugin_dir_path = plugin_dir_path(__FILE__);
        $path_array = array_values(array_filter(explode(DIRECTORY_SEPARATOR, $plugin_dir_path)));
        $path_last_part = $path_array[count($path_array) - 1];
        APSW_Core::$PLUGIN_DIRECTORY = untrailingslashit($path_last_part);
    }

    // Add settings link on plugin page
    public function apsw_add_plugin_settings_link($links) {
        $settings_link = '<a href="' . admin_url() . 'admin.php?page=stats_options">' . __('Settings', 'default') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

}

$statistic_info = new APSW_Core();

/**
 * @param type $from Date - 2010-05-16
 * @param type $to Date - 2014-05-16
 */
function show_stats_post($from, $to) {
    global $statistic_info;
    $statistic_info->show_stats_post($from, $to);
}

/**
 * @param type $from Date - 2010-05-16
 * @param type $to Date - 2014-05-16
 */
function show_stats_author($from, $to) {
    global $statistic_info;
    $statistic_info->show_stats_author($from, $to);
}

function show_stats() {
    global $statistic_info;
    $statistic_info->show_stats();
}

?>