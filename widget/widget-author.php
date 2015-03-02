<?php

include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'options' . DIRECTORY_SEPARATOR . 'apsw-options-serialized.php');
include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'apsw-db-helper.php');
include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'apsw-helper.php');

class APSW_Author_Widget extends WP_Widget {

    public $apsw_options_serialized;
    public $apsw_db_helper;

    public function __construct() {

        $this->apsw_options_serialized = new APSW_Options_Serialize();
        $this->apsw_db_helper = new APSW_DB_Helper();
        /**
         * the widget class name and description
         */
        $widget_ops = array(
            'classname' => 'author_widget',
            'description' => __('This Widget displays popular authors statistic information', APSW_Core::$text_domain)
        );

        $control_ops = array();
        $this->WP_Widget('author_stats_widget', __('APSW - Popular Authors', APSW_Core::$text_domain), $widget_ops, $control_ops);
    }

    /**
     * Initialize The Widget
     */
    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $from = $instance['from'];
        $to = $instance['to'];
        
        if ($instance['apsw_widget_custom_args'] == '1') {
            $before_widget = $instance['before_widget'];
            $after_widget = $instance['after_widget'];
        } else {
            $before_widget = $args['before_widget'];
            $after_widget = $args['after_widget'];
        }

        if ($instance['apsw_title_custom_args'] == '1') {
            $before_title = $instance['before_title'];
            $after_title = $instance['after_title'];
        } else {
            $before_title = $args['before_title'];
            $after_title = $args['after_title'];
        }

        if ($instance['apsw_body_custom_args'] == '1') {
            $before_body = $instance['before_body'];
            $after_body = $instance['after_body'];
        } else {
            $before_body = '';
            $after_body = '';
        }


        // Widget 
        echo $before_widget;

        if (!empty($title)) {
            echo $before_title . strip_tags($title) . $after_title;
        }

        global $post;

        echo $before_body;

        include(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'author-stats-layout.php');

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
        $instance['from'] = $new_instance['from'];
        $instance['to'] = $new_instance['to'];
        $instance['apsw_widget_custom_args'] = $new_instance['apsw_widget_custom_args'];
        $instance['apsw_title_custom_args'] = $new_instance['apsw_title_custom_args'];
        $instance['apsw_body_custom_args'] = $new_instance['apsw_body_custom_args'];
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
            'title' => __('Popular Authors', APSW_Core::$text_domain),
            'from' => '',
            'to' => '',
            'apsw_widget_custom_args' => '',
            'apsw_title_custom_args' => '',
            'apsw_body_custom_args' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        include 'form/author-statistics-widget-form.php';
    }

}

?>