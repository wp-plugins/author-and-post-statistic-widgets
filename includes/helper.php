<?php

class Helper {

    public static function sub_string_by_space($text, $count) {
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

}

?>