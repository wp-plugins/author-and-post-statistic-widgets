<?php

class APSW_Helper {

    public static function sub_string_by_space($text, $count = 2) {
        $text_arr = explode(' ', $text);
        $new_text = '';
        if (count($text_arr) > 2) {
            for ($i = 0; $i < $count; $i++) {
                $new_text .= $text_arr[$i] . ' ';
            }
            return $new_text . '...';
        } else {
            return $text;
        }
    }

    public static function init_string_from_array($array) {
        $result = '';
        $count = 0;
        if (empty($array))
            return $result;
        foreach ($array as $value) {
            $result .= '"' . $value . '"';
            if ($count < count($array) - 1) {
                $result .= ',';
            }
            $count++;
        }
        return $result;
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

}

?>