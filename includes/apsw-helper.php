<?php

class APSW_Helper {

    /**
     * return words substringed by letters count
     */
    public static function sub_string_by_space($text, $count) {
        $text_arr = explode(' ', $text);
        $new_text = '';
        if (count($text_arr) > 2) {
            for ($i = 0; $i < count($text_arr); $i++) {
                $new_text .= $text_arr[$i] . ' ';
            }
            $new_text = mb_substr($new_text, 0, $count);
            if (strlen($text) >= $count) {
                $new_text .= '...';
            }
            $text = $new_text;
        }
        return $text;
    }

    public static function init_string_from_array($array) {
        $result = '';
        $count = 0;
        if (is_array($array)) {
            if (!$array || count($array) == 0) {
                return '"post","page"';
            } else {
                foreach ($array as $value) {
                    $result .= '"' . $value . '"';
                    if ($count < count($array) - 1) {
                        $result .= ',';
                    }
                    $count++;
                }
                return $result;
            }
        } else {
            return '"post","page"';
        }
    }

    public static function get_real_ip_addr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function get_date_intervals($date_interval, $date_format) {
        $interval = array();
        switch ($date_interval) {
            case '1':
                $interval['from'] = current_time($date_format);
                $datetime = new DateTime($interval['from']);
                $datetime->modify('+1 day');
                $interval['to'] = $datetime->format($date_format);
                break;
            case '2':
                $datetime = new DateTime(current_time($date_format));
                $datetime->modify('-1 day');
                $interval['from'] = $datetime->format($date_format);
                $interval['to'] = current_time($date_format);
                break;
            case '3':
                $datetime = new DateTime(current_time($date_format));
                $datetime->modify('-7 day');
                $interval['from'] = $datetime->format($date_format);
                $interval['to'] = current_time($date_format);
                break;
            case '4':
                $datetime = new DateTime(current_time($date_format));
                $datetime->modify('-30 day');
                $interval['from'] = $datetime->format($date_format);
                $interval['to'] = current_time($date_format);
                break;
            case '5':
                $datetime = new DateTime(current_time($date_format));
                $datetime->modify('-90 day');
                $interval['from'] = $datetime->format($date_format);
                $interval['to'] = current_time($date_format);
                break;
            case '6':
                $datetime = new DateTime(current_time($date_format));
                $datetime->modify('-365 day');
                $interval['from'] = $datetime->format($date_format);
                $interval['to'] = current_time($date_format);
                break;
            default:
                $blogusers = get_users('orderby=registered&order=asc');
                $first_user = $blogusers[0];
                $date_format = 'Y-m-d';
                $time = get_user_option('user_registered', $first_user->ID);
                $interval['from'] = date($date_format, strtotime($time));
                $interval['to'] = current_time($date_format);
                break;
        }
        return $interval;
    }

    /**
     * get profile url for certain user
     */
    public static function get_profile_url($user) {
        $wc_profile_url = '';
        $wc_profile_url_filter = '';
        if ($user) {
            if (class_exists('BuddyPress')) {
                $wc_profile_url = bp_core_get_user_domain($user->ID);
            } else if (class_exists('XooUserUltra')) {
                global $xoouserultra;
                $wc_profile_url = $xoouserultra->userpanel->get_user_profile_permalink($user->ID);
            } else if (class_exists('userpro_api')) {
                global $userpro;
                $wc_profile_url = $userpro->permalink($user->ID);
            } else if (class_exists('UM_API')) {
                $wc_profile_url = apply_filters('get_comment_author_link', $wc_profile_url);
                $dom = new DOMDocument;
                $dom->loadHTML($wc_profile_url);
                $node = $dom->getElementsByTagName('a')->item(0);
                $wc_profile_url = $node->getAttribute( 'href' );
            } else {
                if (count_user_posts($user->ID)) {
                    $wc_profile_url = get_author_posts_url($user->ID);
                }
            }
            $user_id = $user->ID;
            $wc_profile_url_data = apply_filters('apsw_profil_url', array('user_id' => $user_id, 'permalink' => ''));

            $wc_profile_url_filter = $wc_profile_url_data['permalink'];
        }
        return $wc_profile_url_filter ? $wc_profile_url_filter : $wc_profile_url;
    }

}

?>