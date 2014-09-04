<?php

include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'options' . DIRECTORY_SEPARATOR . 'options-serialized.php');
include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'db-statistic.php');
include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'helper.php');

class Statistic_Widget extends WP_Widget {

    public $options;
    public $statistic;

    public function __construct() {


        $this->options = new Serialize_Options();
        $this->statistic = new Statistic();
        /**
         * the widget class name and description
         */
        $widget_ops = array(
            'classname' => 'all_stats_widget',
            'description' => __('This Widget displays author and post statistic information.', Statistic_Info::$text_domain)
        );

        $control_ops = array();
        $this->WP_Widget('a_stats_widget', __('APSW - Author &amp; Post Statistics', Statistic_Info::$text_domain), $widget_ops, $control_ops);
    }

    /**
     * Initialize The Widget
     */
    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $body = $instance['body'];
        $widget_custom_args = $instance['widget_custom_args'] ? 'true' : 'false';
        $title_custom_args = $instance['title_custom_args'] ? 'true' : 'false';

        if ($instance['widget_custom_args'] == 'on') :
            $before_widget = $instance['before_widget'];
            $after_widget = $instance['after_widget'];
        else :
            $before_widget = $args['before_widget'];
            $after_widget = $args['after_widget'];
        endif;

        if ($instance['title_custom_args'] == 'on') :
            $before_title = $instance['before_title'];
            $after_title = $instance['after_title'];
        else :
            $before_title = $args['before_title'];
            $after_title = $args['after_title'];
        endif;

        if ($instance['body_custom_args'] == 'on') :
            $before_body = $instance['before_body'];
            $after_body = $instance['after_body'];
        else:
            $before_body = '';
            $after_body = '';
        endif;


        // Widget 
        echo $before_widget;

        if (!empty($title)) {
            echo $before_title . strip_tags($title) . $after_title;
        };

        global $post;

        echo $before_body;

        if ($this->options->is_stats_together == 1) {
            if (is_singular()) {
                include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-tabbed-single.php');
            } else {
                include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-tabbed-not-single.php');
            }
        } else {
            if (is_singular()) {
                include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-separately-single.php');
            } else {
                include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'all-stats-separately-not-single.php');
            }
        }
        echo $after_body;

        echo $after_widget;
        // end Widget
    }

    /**
     * Update the widget options
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body'] = strip_tags($new_instance['body']);
        $instance['widget_custom_args'] = $new_instance['widget_custom_args'];
        $instance['title_custom_args'] = $new_instance['title_custom_args'];
        $instance['body_custom_args'] = $new_instance['body_custom_args'];
        $instance['before_widget'] = $new_instance['before_widget'];
        $instance['after_widget'] = $new_instance['after_widget'];
        $instance['before_title'] = $new_instance['before_title'];
        $instance['after_title'] = $new_instance['after_title'];
        $instance['before_body'] = $new_instance['before_body'];
        $instance['after_body'] = $new_instance['after_body'];
        return $instance;
    }

    /**
     * Create a form for widget
     */
    function form($instance) {
        //Set up some default widget settings.
        $defaults = array(
            'title' => __('Author &amp; Post Statistics', Statistic_Info::$text_domain),
            'body' => __('The Widget Body', Statistic_Info::$text_domain),
            'widget_custom_args' => 'off',
            'title_custom_args' => 'off',
            'body_custom_args' => 'off'
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        include 'form/all-statistics-widget-form.php';
    }

}

?>