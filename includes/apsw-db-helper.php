<?php

include_once(APSW_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'options' . DIRECTORY_SEPARATOR . 'apsw-options-serialized.php');

class APSW_DB_Helper {

    private $ips_table;
    private $stats_table;
    private $db;
    private $apsw_options_serialized;
    private $post_types;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->ips_table = $this->db->prefix . 'sw_ips';
        $this->stats_table = $this->db->prefix . 'sw_statistics';
        $this->apsw_options_serialized = new APSW_Options_Serialize();
        $this->post_types = APSW_Helper::init_string_from_array($this->apsw_options_serialized->post_types);
    }

    /**
     * create table in db on activation if not exists
     */
    public function create_tables() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
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
        $select_query = 'SELECT posts.`comment_count` AS `c_count`, posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, posts.`comment_status` AS `c_status` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'comments` AS `comments` ON posts.`ID` = comments.`comment_post_ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(comments.`comment_date`) >= %s AND DATE(comments.`comment_date`) <= %s GROUP BY `post_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return popular post id's by view count between two dates
     */
    public function get_popular_posts_by_view_count($start_time, $end_time, $limit = null) {
        $select_query = 'SELECT stats.`post_id`, SUM(stats.`view_count`) AS `v_count`, posts.`post_title` AS `p_title` FROM  `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(stats.`statistic_date`) >= %s AND DATE(stats.`statistic_date`) <= %s GROUP BY `post_id` ORDER BY `v_count` DESC LIMIT %d;';
        if ($limit == null || !is_numeric($limit) || $limit <= 0) {
            $limit = 10;
        }
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return popular post id's by view count between two dates
     */
    public function get_popular_posts_list($start_time, $end_time, $limit = null) {
        $query_post_view_count = 'SELECT stats.`post_id` AS `post_id`, SUM(stats.`view_count`) AS `v_count`, posts.`post_title` AS `p_title`, `posts`.`comment_count` AS `c_count` FROM  `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(stats.`statistic_date`) >= %s AND DATE(stats.`statistic_date`) <= %s GROUP BY `post_id` ORDER BY `v_count` DESC LIMIT %d;';
        if ($limit == null || !is_numeric($limit) || $limit <= 0) {
            $limit = 10;
        }
        $query_post_view_count = $this->db->prepare($query_post_view_count, $start_time, $end_time, $limit);
        $popular_posts_list = $this->db->get_results($query_post_view_count, ARRAY_A);
        return $popular_posts_list;
    }

    /**
     * get post views count by date interval
     */
    public function get_post_views_count($post_id, $from, $to) {
        $query_post_view_count = $this->db->prepare("SELECT SUM(`view_count`) AS `post_views` FROM `" . $this->stats_table . "` WHERE `post_id` = %d AND DATE(`statistic_date`) >= %s AND DATE(`statistic_date`) <= %s;", $post_id, $from, $to);
        $post_views_count = $this->db->get_var($query_post_view_count);
        return $post_views_count;
    }

    /**
     * add view count for post
     */
    public function add_view_count($post_id, $date, $ip) {
        $select_query = $this->db->prepare('SELECT stats.`s_id` AS `stats_id` , stats.`view_count` AS `view_count` FROM `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN (' . $this->post_types . ') AND stats.`post_id` = %d AND DATE( stats.`statistic_date` ) = %s', $post_id, $date);
        $result = $this->db->get_row($select_query, ARRAY_A);
        if ($result) {
            $s_id = $result['stats_id'];
            $view_count = $result['view_count'];
            if ($this->apsw_options_serialized->is_post_view_by_ip == '1') {
                $query1 = $this->db->prepare('SELECT stats.`s_id` AS `stats_id`, stats.`view_count` AS `view_count` FROM `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` INNER JOIN `' . $this->ips_table . '` AS `ips` ON ips.`s_id` = stats.`s_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND stats.`post_id` = %d AND DATE(stats.`statistic_date`) = %s AND ips.`ip` = %s;', $post_id, $date, $ip);
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
        $select_query = 'SELECT posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, SUM(stats.`view_count`) AS `view_count` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->stats_table . '` AS `stats` ON posts.`ID` = stats.`post_id` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND posts.`post_author` = %d AND DATE(posts.`post_date`) >= %s AND DATE(posts.`post_date`) <= %s GROUP BY stats.`post_id` ORDER BY `view_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    /**
     * return current author popular posts by comments count
     */
    public function get_author_popular_posts_by_commment_count($author_id, $start_time, $end_time, $limit) {
        $select_query = 'SELECT posts.`comment_count` AS `c_count`, posts.`ID` AS `post_id`, posts.`post_title` AS `p_title`, posts.`comment_status` AS `c_status` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->prefix . 'comments` AS `comments` ON posts.`ID` = comments.`comment_post_ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND posts.`post_author` = %d AND DATE(comments.`comment_date`) >= %s AND DATE(comments.`comment_date`) <= %s GROUP BY `post_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time, $limit);
        $result = $this->db->get_results($select_query, ARRAY_A);
        return $result;
    }

    public function get_popular_authors_list($start_time, $end_time, $limit = null) {
        $limit = ($limit) ? $limit : 10;
        $query_posts_count = $this->db->prepare('SELECT `posts`.`post_author` AS `author_id`, COUNT(`posts`.`post_author`) AS `posts_count`, `users`.`display_name` AS `user_name`, `users`.`user_email` AS `email` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->base_prefix . 'users` AS `users` ON `posts`.`post_author` = `users`.`ID` WHERE `posts`.`post_status` = "publish" AND `posts`.`post_type` IN(' . $this->post_types . ') AND DATE(`posts`.`post_date`) >= %s AND DATE(`posts`.`post_date`) <= %s GROUP BY `author_id` ORDER BY `posts_count` DESC LIMIT %d;', $start_time, $end_time, $limit);
        $authors_data = $this->db->get_results($query_posts_count, ARRAY_A);
        $popular_authors_list = array();
        foreach ($authors_data as $author_data) {
            $author_comments_count = $this->get_comments_count_by_author($author_data['author_id']);
            $author_data['comments_count'] = $author_comments_count;
            $popular_authors_list[] = $author_data;
        }
        return $popular_authors_list;
    }

    /**
     * return popular authors id's by author posts count
     */
    public function get_popular_authors_by_posts_count($start_time, $end_time, $limit = null) {
        $select_query = 'SELECT posts.`post_author` AS `author_id`, COUNT(posts.`post_author`) AS `posts_count`, users.`display_name` as `user_name` FROM `' . $this->db->prefix . 'posts` AS `posts` INNER JOIN `' . $this->db->base_prefix . 'users` AS `users` ON posts.`post_author` = users.`ID` WHERE posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(posts.`post_date`) >= %s AND DATE(posts.`post_date`) <= %s GROUP BY author_id ORDER BY posts_count DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $author_data = $this->db->get_results($select_query, ARRAY_A);
        return $author_data;
    }

    /**
     * return popular authors by author posts views count
     */
    public function get_popular_authors_by_posts_views_count($start_time, $end_time, $limit) {
        $select_query = 'SELECT SUM(stats.`view_count`) AS `view_count`, users.`display_name` AS `user_name`, posts.`post_author` AS `author_id` FROM `' . $this->stats_table . '` AS `stats` INNER JOIN `' . $this->db->prefix . 'posts` AS `posts` ON posts.`ID` = stats.`post_id` INNER JOIN `' . $this->db->base_prefix . 'users` AS `users` ON users.`ID` = posts.`post_author` WHERE stats.`view_count` >= 1 AND posts.`post_status` = "publish" AND posts.`post_type` IN(' . $this->post_types . ') AND DATE(posts.`post_date`) >= %s AND DATE(posts.`post_date`) <= %s GROUP BY `author_id` ORDER BY `view_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $author_data = $this->db->get_results($select_query, ARRAY_A);
        return $author_data;
    }

    /**
     * return popular authors id's by author posts comments count
     */
    public function get_popular_authors_by_comments_count($start_time, $end_time, $limit) {
        $select_query = 'SELECT `comments`.`user_id` AS `author_id`, `users`.`display_name` AS `user_name`, COUNT(`comments`.`comment_id`) AS `c_count` FROM `' . $this->db->prefix . 'comments` AS `comments` INNER JOIN (SELECT `id` FROM `' . $this->db->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` IN(' . $this->post_types . ')) AS `posts` ON `comments`.`comment_post_id` = `posts`.`id` INNER JOIN `' . $this->db->prefix . 'users` AS `users` ON `comments`.`user_id`=`users`.`ID` WHERE `comments`.`user_id` > 0 AND `comments`.`comment_approved` = 1 AND DATE(`comments`.`comment_date`) >= %s AND DATE(`comments`.`comment_date`) <= %s GROUP BY `comments`.`user_id` ORDER BY `c_count` DESC LIMIT %d;';
        $select_query = $this->db->prepare($select_query, $start_time, $end_time, $limit);
        $popular_authors_data = $this->db->get_results($select_query, ARRAY_A);
        return $popular_authors_data;
    }

    /**
     * return author's posts count between two dates
     */
    public function get_author_all_posts_count($author_id, $start_time, $end_time) {
        $select_query = 'SELECT COUNT(posts.`ID`)AS `posts_count` FROM `' . $this->db->prefix . 'posts` AS `posts` WHERE `posts`.`post_author` = %d AND `posts`.`post_status` = "publish" AND `posts`.`post_type` IN(' . $this->post_types . ') AND DATE(`posts`.`post_date`) >= %s AND DATE(`posts`.`post_date`) <= %s';
        $select_query = $this->db->prepare($select_query, $author_id, $start_time, $end_time);
        return $this->db->get_var($select_query);
    }

    /**
     * return author posts count and categories names by author id 
     */
    public function get_author_posts_categories($author_id) {
        $selected_post_types = $this->apsw_options_serialized->post_types;
        wp_reset_query();
        query_posts(array(
            'orderby' => 'id',
            'order' => 'asc',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_type' => $selected_post_types,
            'author' => $author_id
        ));
        $post_ids = array();
        $cat_statistic = array();
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $post_ids[] = get_the_ID();
            }
        }
        foreach ($post_ids as $id) {
            $categories = get_the_category($id);
            foreach ($categories as $cat) {
                if (array_key_exists($cat->term_id, $cat_statistic)) {
                    $count = $cat_statistic[$cat->term_id]['count'];
                    $count++;
                    $cat_statistic[$cat->term_id]['count'] = $count;
                } else {
                    $cat_statistic[$cat->term_id] = array('name' => $cat->name, 'count' => 1);
                }
            }
        }
        wp_reset_query();
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

    public function get_author_posts_taxonomies($author_id) {
        $selected_post_types = $this->apsw_options_serialized->post_types;
        $selected_taxonomies = $this->apsw_options_serialized->custom_taxonomy_types;
        wp_reset_query();
        query_posts(array(
            'orderby' => 'id',
            'order' => 'asc',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_type' => $selected_post_types,
            'author' => $author_id
        ));
        $post_ids = array();
        $tax_statistic = array();
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $post_ids[] = get_the_ID();
            }
        }
        foreach ($post_ids as $id) {
            foreach ($selected_taxonomies as $sel_taxonomy) {
                $taxonomies = get_the_terms($id, $sel_taxonomy);
                if ($taxonomies && !is_wp_error($taxonomies)) {
                    foreach ($taxonomies as $tax) {
                        if ($tax->term_id && array_key_exists($tax->term_id, $tax_statistic)) {
                            $count = $tax_statistic[$tax->term_id]['count'];
                            $count++;
                            $tax_statistic[$tax->term_id]['count'] = $count;
                        } else {
                            $tax_statistic[$tax->term_id] = array('name' => $tax->name, 'count' => 1, 'taxonomy' => $sel_taxonomy);
                        }
                    }
                }
            }
        }
        wp_reset_query();
        return $tax_statistic;
    }

    /**
     * return author posts comment count
     */
    public function get_comments_count_by_author($author_id) {
        $select_query = 'SELECT COUNT(`comments`.`comment_ID`) AS `comments_count` FROM `' . $this->db->prefix . 'comments` AS `comments` WHERE `comments`.`comment_approved` = 1 AND `comments`.`user_id` = %d';
        $select_query = $this->db->prepare($select_query, $author_id);
        $result = $this->db->get_var($select_query);
        return $result;
    }

    /**
     * return author posts comment count
     */
    public function get_author_all_posts_comments_count($author_id) {
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
            $delete_query1 = 'DELETE FROM `' . $this->ips_table . '` WHERE `' . $this->ips_table . '`.`s_id` IN(SELECT stats.`s_id` FROM `' . $this->stats_table . '` AS `stats` WHERE DATE(stats.`statistic_date`) >= %s AND DATE(stats.`statistic_date`) <= %s);';
            $delete_query1 = $this->db->prepare($delete_query1, $start_time, $end_time);

            $delete_query2 = 'DELETE FROM `' . $this->stats_table . '` WHERE DATE(`statistic_date`) >= %s AND DATE(`statistic_date`) <= %s;';
            $delete_query2 = $this->db->prepare($delete_query2, $start_time, $end_time);
            return $this->db->query($delete_query1) && $this->db->query($delete_query2);
        }
    }

    /**
     * get post types from db which has been already published
     */
    public function get_published_post_types() {
        $query_post_types = "SELECT `posts`.`id` AS `post_id`, `posts`.`post_type` AS `post_type` FROM `" . $this->db->prefix . "posts` AS `posts` WHERE `posts`.`post_type` NOT IN('attachment', 'revision', 'nav_menu_item') AND `posts`.`post_status` LIKE 'publish' GROUP BY `posts`.`post_type` ORDER BY `posts`.`id`;";
        $post_types = $this->db->get_results($query_post_types, ARRAY_A);
        $post_and_taxonomies_types = array();
        foreach ($post_types as $post_type) {
            $post_type['taxonomies'] = $this->get_post_type_taxonomies($post_type['post_id']);
            $post_and_taxonomies_types[] = $post_type;
        }
        return $post_and_taxonomies_types;
    }

    private function get_post_type_taxonomies($post_id) {
        $query_post_type_taxonomies = $this->db->prepare("SELECT `term_tax`.`term_id` AS `term_id`, `term_tax`.`taxonomy` AS `taxonomy` FROM `" . $this->db->prefix . "term_taxonomy` AS `term_tax` INNER JOIN `" . $this->db->prefix . "term_relationships` AS `term_rel` ON `term_tax`.`term_taxonomy_id` = `term_rel`.`term_taxonomy_id` WHERE `term_tax`.`taxonomy` NOT IN('link_category', 'post_format', 'category', 'post_tag') AND `term_rel`.`object_id` = %d GROUP BY `taxonomy`;", $post_id);
        $post_type_taxonomies = $this->db->get_results($query_post_type_taxonomies, ARRAY_A);
        return $post_type_taxonomies;
    }

}

?>