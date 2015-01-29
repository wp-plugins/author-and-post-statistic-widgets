<?php

//if uninstall not called from WordPress exit
if (!defined('WP_UNINSTALL_PLUGIN'))
    exit();

$option_name = 'stats_options';
$ips_table = '';
$stats_table = '';

global $wpdb;

$ips_table = $wpdb->prefix . 'sw_ips';
$stats_table = $wpdb->prefix . 'sw_statistics';

delete_option($option_name);
$drop_query1 = "DROP TABLE IF EXISTS `$ips_table`;";
$drop_query2 = "DROP TABLE IF EXISTS `$stats_table`;";
$wpdb->query($wpdb->prepare($drop_query1));
$wpdb->query($wpdb->prepare($drop_query2));
?>
