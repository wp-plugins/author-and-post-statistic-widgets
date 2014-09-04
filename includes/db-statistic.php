<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'options' . DIRECTORY_SEPARATOR . 'options-serialized.php');

class Statistic {

    private $ips_table;
    private $stats_table;
    private $db;
    private $options_serialized;
    private $post_types;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->ips_table = $this->db->prefix . 'sw_ips';
        $this->stats_table = $this->db->prefix . 'sw_statistics';
        $this->options_serialized = new Serialize_Options();
        $this->post_types = Helper::init_string_from_array($this->options_serialized->post_types);
    }

    /**
     * create table in db on activation if not exists
     */
    public function create_tables() {
        if ($this->db->get_var("SHOW TABLES LIKE '$this->stats_table'") != $this->stats_table) {
            $sql1 = "CREATE TABLE `$this->stats_table`(`s_id` INT NOT NULL AUTO_INCREMENT, `post_id` INT NOT NULL, `view_count` INT NOT NULL DEFAULT '0', `statistic_date` DATE NOT NULL, PRIMARY KEY (`s_id`));";
            dbDelta($sql1);
        }

        if ($this->db->get_var("SHOW TABLES LIKE '$this->ips_table'") != $this->ips_table) {
            $sql2 = "CREATE TABLE `$this->ips_table`(`id` INT NOT NULL AUTO_INCREMENT, `s_id` INT NOT NULL, `ip` VARCHAR(32), PRIMARY KEY (`id`));";
            dbDelta($sql2);
        }
    }

    /* ====================================== POST ========================================================= */

    /**
     * return popular posts by comment count between two dates
     */
    public function get_popular_posts_by_commment_count($start_time, $end_time, $limit) {
        $select_query = 'SELECT posts.`comment_count` AS `c_count`, posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, posts.`comment_status` AS `c_status` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'comments` AS `comments` ON posts.`ID` = comments.`comment_post_ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(comments.`comment_date`) BETWEEN %s AND %s GROUP BY `post_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return popular post id's by view count between two dates
     */
    public function get_popular_posts_by_view_count($start_time, $end_time, $limit = null) {
        $select_query = 'SELECT stats.`post_id`, SUM(stats.`view_count`) AS `v_count`, posts.`post_title` AS `p_title` FROM  `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(stats.`statistic_date`) BETWEEN %s AND %s GROUP BY `post_id` ORDER BY `v_count` DESC LIMIT %d;';
        if ($limit == null || !is_numeric($limit) || $limit <= 0) {
            $limit = 10;
        }
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * add view count for post
     */
    public function add_view_count($post_id, $date, $ip) {

        $select_query = $this->db->prepare(
                'SELECT stats.`s_id` AS `stats_id` , stats.`view_count` AS `view_count`
                FROM `' . $this->stats_table . '` AS `stats`
                INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id`
                WHERE posts.`post_status` = "publish" AND posts.`post_type` IN (' . $this->post_types . ')
                AND stats.`post_id` = %d AND DATE( stats.`statistic_date` ) = %s', $post_id, $date);
        $result = $this->db->get_row($select_query, ARRAY_A);
        if ($result) {
            $s_id = $result['stats_id'];
            $view_count = $result['view_count'];
            if ($this->options_serialized->is_post_view_by_ip == '1') {
                $query1 = $this->db->prepare(
                        'SELECT stats.`s_id` AS `stats_id`, stats.`view_count` AS `view_count` 
                    FROM `' . $this->stats_table . '` AS `stats` 
                    INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` 
                    ON posts.`ID` = stats.`post_id` 
                    INNER JOIN `' . $this->ips_table . '` AS `ips` 
                    ON ips.`s_id` = stats.`s_id` 
                    WHERE posts.`post_status` = "publish" AND 
                    posts.`post_type` IN(' . $this->post_types . ') AND 
                    stats.`post_id` = %d AND DATE(stats.`statistic_date`) = %s AND 
                    ips.`ip` = %s;', $post_id, $date, $ip);
                $result2 = $this->db->query($query1);
                if (!$result2) {
                    $query3 = $this->db->prepare('UPDATE `' . $this->stats_table . '` SET `view_count` = %d  WHERE `s_id` = %d;', ++$view_count, $s_id);
                    $this->db->query($query3);
                    $query4 = $this->db->prepare('INSERT INTO `' . $this->ips_table . '` (`s_id`, `ip`) VALUES (%d, %s)', $s_id, $ip);
                    $this->db->query($query4);
                }
            } else {
                $query2 = $this->db->prepare('UPDATE `' . $this->stats_table . '` SET `view_count` = %d  WHERE `s_id` = %d;', ++$view_count, $s_id);
                $this->db->query($query2);
            }
        } else {
            $query1 = $this->db->prepare('INSERT INTO `' . $this->stats_table . '`(`post_id`,`view_count`,`statistic_date`) VALUES (%d,1,%s)', $post_id, $date);
            $this->db->query($query1);
            $query2 = $this->db->prepare('INSERT INTO `' . $this->ips_table . '` (`s_id`, `ip`) VALUES ((SELECT MAX(`s_id`) FROM `' . $this->stats_table . '`), %s)', $ip);
            $this->db->query($query2);
        }
    }

    /* ======================================  AUTHOR ========================================================= */

    /**
     * return current author popular posts by views count
     */
    public function get_author_popular_posts_by_view_count($author_id, $start_time, $end_time, $limit) {
        $select_query = 'SELECT posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, SUM(stats.`view_count`) AS `view_count` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->stats_table . '` AS `stats` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND posts.`post_author` = %d AND DATE(posts.`post_date`) BETWEEN %s AND %s GROUP BY stats.`post_id` ORDER BY `view_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return current author popular posts by comments count
     */
    public function get_author_popular_posts_by_commment_count($author_id, $start_time, $end_time, $limit) {
        $select_query = 'SELECT posts.`comment_count` AS `c_count`, posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, posts.`comment_status` AS `c_status` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'comments` AS `comments` ON posts.`ID` = comments.`comment_post_ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND posts.`post_author` = %d AND DATE(comments.`comment_date`) BETWEEN %s AND %s GROUP BY `post_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return popular authors id's by author posts count
     */
    public function get_popular_authors_by_posts_count($start_time, $end_time, $limit = null) {
        $select_query = 'SELECT posts.`post_author` AS `author_id`, COUNT(posts.`post_author`) AS `posts_count`, users.`display_name` as `user_name` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'users` AS `users` ON posts.`post_author` = users.`ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(posts.`post_date`) BETWEEN %s AND %s GROUP BY author_id ORDER BY posts_count DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
//        exit($select_query);
        $author_data = $this->db->get_results($select_query, ARRAY_A);
        return $author_data;
    }

    /**
     * return popular authors by author posts views count
     */
    public function get_popular_authors_by_posts_views_count($start_time, $end_time, $limit) {
        $select_query = 'SELECT SUM(stats.`view_count`) AS `view_count`, users.`display_name` AS `user_name`, posts.`post_author` AS `author_id` FROM `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` INNER JOIN `' . $this->db->prefix . 'users` AS `users` ON users.`ID` = posts.`post_author` WHERE stats.`view_count` >= 1 AND posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(posts.`post_date`) BETWEEN %s AND %s GROUP BY `author_id` ORDER BY `view_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $author_data = $this->db->get_results($select_query, ARRAY_A);
        return $author_data;
    }

    /**
     * return popular authors id's by author posts comments count
     */
    public function get_popular_authors_by_comments_count($start_time, $end_time, $limit) {
        $select_query = 'SELECT posts.`post_author` AS `author_id`, users.`display_name` AS `user_name`, COUNT(comments.`comment_ID`) AS c_count FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'users` AS `users` ON users.`ID` = posts.`post_author` INNER JOIN `' . $this->db->prefix . 'comments` AS `comments` ON posts.`ID` = comments.`comment_post_ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND comments.`comment_approved` = 1 AND DATE(comments.`comment_date`) BETWEEN %s AND %s GROUP BY `author_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $popular_authors_data = $this->db->get_results($select_query, ARRAY_A);
        return $popular_authors_data;
    }

    /**
     * return author's posts count between two dates
     */
    public function get_author_all_posts_count($author_id, $start_time, $end_time) {
        $select_query = 'SELECT COUNT(posts.`ID`)AS `posts_count` FROM `' . $this->db->prefix . 'posts` AS `posts` WHERE posts.`post_author` = %d AND posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(`post_date`) BETWEEN %s AND %s';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time);
        return $this->db->get_var($select_query);
    }

    /**
     * return author posts count and categories names by author id 
     */
    public function get_author_posts_categories($author_id) {

        $the_query = new WP_Query("author=$author_id");
        $post_ids = array();
        $cat_statistic = array();
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $post_ids[] = get_the_ID();
            }
            foreach ($post_ids as $id) {
                $categorys = get_the_category($id);

                foreach ($categorys as $cat) {
                    if (array_key_exists($cat->term_id, $cat_statistic)) {
                        $count = $cat_statistic[$cat->term_id]['count'];
                        $count++;
                        $cat_statistic[$cat->term_id]['count'] = $count;
                    } else {
                        $cat_statistic[$cat->term_id] = array('name' => $cat->name, 'count' => 1);
                    }
                }
            }
        }
        return $cat_statistic;
    }

    /**
     * return array of tags in which author has posts
     */
    public function get_author_posts_tags($author_id) {
        $the_query = new WP_Query("author=$author_id");
        $post_ids = array();
        $tag_statistic = array();
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $post_ids[] = get_the_ID();
            }
            foreach ($post_ids as $id) {
                $tags = wp_get_post_tags($id);
                foreach ($tags as $tag) {
                    if (!array_key_exists($tag->term_id, $tag_statistic)) {
                        $tag_statistic[$tag->term_id] = $tag->name;
                    }
                }
            }
        }
        return $tag_statistic;
    }

    /**
     * return author posts comment count
     */
    public function get_all_comment_count($author_id) {
        $select_query = 'SELECT SUM(posts.`comment_count`) AS `c_count` FROM `' . $this->db->prefix . 'posts` AS `posts` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND posts.`post_author` = %d;';
        $select_query = $this->db->prepare($select_query, $author_id);
        $result = $this->db->get_var($select_query);
        return $result;
    }

    /* ==============================================  DELETE ============================================= */

    /**
     * delete post statistics if post was deleted
     */
    public function delete_post_statistics($post_id) {
        $delete_query = "DELETE FROM `$this->stats_table` WHERE `post_id` = $post_id;";
        $this->db->query($this->db->prepare($delete_query));
    }

    /**
     * delete all statistics between two dates
     */
    public function delete_statistics($all, $start_time, $end_time) {
        if ($all) {
            $delete_query1 = 'TRUNCATE TABLE `' . $this->ips_table . '`';
            $delete_query2 = 'TRUNCATE TABLE `' . $this->stats_table . '`';
            return $this->db->query($delete_query1) && $this->db->query($delete_query2);
        } else {
            $delete_query1 = 'DELETE FROM `' . $this->ips_table . '` WHERE `' . $this->ips_table . '`.`s_id` IN(SELECT stats.`s_id` FROM `' . $this->stats_table . '` AS `stats` WHERE DATE(stats.`statistic_date`) BETWEEN %s AND %s);';
            $delete_query1 = $this->db->prepare($delete_query1, $start_time, $end_time);

            $delete_query2 = 'DELETE FROM `' . $this->stats_table . '` WHERE DATE(`statistic_date`) BETWEEN %s AND %s;';
            $delete_query2 = $this->db->prepare($delete_query2, $start_time, $end_time);
            return $this->db->query($delete_query1) && $this->db->query($delete_query2);
        }
    }

}

?>