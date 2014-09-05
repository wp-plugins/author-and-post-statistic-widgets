<?php

/*
  Plugin Name: Author and Post Statistic Widgets
  Description: Adds awesome statistic widgets for displaying authors activity and posts popularity. This plugin displays adaptive statistical information depending on current opened category, post and page.
  Version: 1.1.1
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

include_once 'options/options-statistics.php';
include_once 'widget/widget-statistics.php';
include_once 'widget/widget-author.php';
include_once 'widget/widget-post.php';
include_once 'includes/db-statistic.php';
include_once 'includes/helper.php';

class Statistic_Info {

    public static $text_domain = 'stats-info';
    public $stats_options;
    public $options;
    public $statistic;
    public $w_author;

    function __construct() {
        add_action('plugins_loaded', array(&$this, 'load_sw_plugin_text_domain'));
        $this->stats_options = new Stats_Options();
        $this->options = $this->stats_options->get_default_options();
        $this->statistic = new Statistic();
        register_activation_hook(__FILE__, array($this, 'create_tables'));
        add_action('admin_enqueue_scripts', array(&$this, 'option_page_styles_scripts'));
        add_action('widgets_init', array(&$this, 'init_widgets'));
        add_action('wp_enqueue_scripts', array(&$this, 'front_end_styles_scripts'));
        add_action('admin_menu', array(&$this, 'add_plugin_options_page'));
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        add_action('wp_head', array(&$this, 'add_post_view_count'));

        if (function_exists('add_shortcode')) {
            add_shortcode('author_stats', array(&$this, 'author_statistics'));
            add_shortcode('post_stats', array(&$this, 'post_statistics'));
        }

        add_action('wp_ajax_delete_stats_key', array(&$this, 'delete_stats'));

        add_action('wp_enqueue_scripts', array(&$this, 'frontend_styles'), 1);
    }

    /*
     * load plugin text domain 
     */

    public function load_sw_plugin_text_domain() {
        load_plugin_textdomain(Statistic_Info::$text_domain, false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Register widgets
     */
    public function init_widgets() {
        register_widget('Statistic_Widget');
        register_widget('Author_Widget');
        register_widget('Post_Widget');
    }

    /**
     * add view count for post/page or custom post types     
     */
    public function add_post_view_count() {
        global $post;
        $post_id = '';
        if (!is_singular())
            return;
        if (empty($post_id)) {
            $post_id = $post->ID;
        }
        $ip = Helper::get_real_ip_addr();
        $this->statistic->add_view_count($post_id, date('Y-m-d'), $ip);
    }

    /**
     * Scripts and styles registration on administration pages
     */
    public function option_page_styles_scripts() {
        wp_register_style('sw-plugin-css', plugins_url('author-and-post-statistic-widgets/files/css/admin-css.css'));
        wp_enqueue_style('sw-plugin-css');
        wp_enqueue_script('option-scripts', plugins_url('author-and-post-statistic-widgets/files/js/admin-js.js'), array('jquery'), '1.0.0', false);

        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-datepicker');

        wp_enqueue_script('theme-switcher', plugins_url('author-and-post-statistic-widgets/files/js/jquery-ui/jquery.themeswitcher.js'), array('jquery', 'jquery-ui-core'), '1.0.0');
        wp_register_style('jquery-ui-theme', plugins_url('author-and-post-statistic-widgets/files/css/jquery-ui-themes/themes/') . $this->options->active_theme_name . '/jquery-ui.min.css');
        wp_enqueue_style('jquery-ui-theme');

        wp_enqueue_script('sw-ajax-js', plugins_url('author-and-post-statistic-widgets/files/js/ajax-delete.js'), array('jquery'), '1.0.0', false);
        wp_enqueue_script('sw-cookie-js', plugins_url('author-and-post-statistic-widgets/files/js/jquery.cookie.js'), array('jquery'), '1.4.1', false);
    }

    /**
     * Styles and scripts registration to use on front page
     */
    public function front_end_styles_scripts() {
        wp_register_style('sw-frontend-style', plugins_url('author-and-post-statistic-widgets/files/css/frontend-css.css'));
        wp_enqueue_style('sw-frontend-style');

        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');

        wp_register_style('jquery-ui-theme', plugins_url('author-and-post-statistic-widgets/files/css/jquery-ui-themes/themes/') . $this->options->active_theme_name . '/jquery-ui.min.css');
        wp_enqueue_style('jquery-ui-theme');
    }

    public function frontend_styles() {
        $style = '<style type="text/css">' . $this->options->custom_css . '</style>';
        echo $style;
    }

    /**
     * register options page for plugin
     */
    public function add_plugin_options_page() {
        if (function_exists('add_options_page')) {
            add_menu_page('Statistic Widgets', 'Statistic Widgets', 'manage_options', 'stats_options', array(&$this->stats_options, 'options_form'), plugins_url('author-and-post-statistic-widgets/files/img/plugin-icon/statistics-icon-20.png'), 4256);
        }
    }

    /*
     * cretae statistics tables in database on plugin activation
     */

    public function create_tables() {
        $this->statistic->create_tables();
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
        echo ($this->statistic->delete_statistics($all, $from, $to) ? _e('Statistical data has been removed', Statistic_Info::$text_domain) : _e('Failed to delete statistical data', Statistic_Info::$text_domain));
        exit();
    }

    public function show_stats($from, $to, $widget_type) {
        global $post;
        if ($widget_type === 'post') {
            include(APSW_PLUGIN_DIR . '/author-and-post-statistic-widgets/layouts/post-stats-layout.php');
        } else if ($widget_type === 'author') {
            include(APSW_PLUGIN_DIR . '/author-and-post-statistic-widgets/layouts/author-stats-layout.php');
        } else {
            if ($this->options->is_stats_together == 1) {
                if (is_singular()) {
                    include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'author-and-post-statistic-widgets' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-tabbed-single.php');
                } else {
                    include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'author-and-post-statistic-widgets' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-tabbed-not-single.php');
                }
            } else {
                if (is_singular()) {
                    include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'author-and-post-statistic-widgets' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-separately-single.php');
                } else {
                    include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'author-and-post-statistic-widgets' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-separately-not-single.php');
                }
            }
        }
    }

}

$statistic_info = new Statistic_Info();

function show_stats($from, $to, $widget_type) {
    global $statistic_info;
    $statistic_info->show_stats($from, $to, $widget_type);
}

?>