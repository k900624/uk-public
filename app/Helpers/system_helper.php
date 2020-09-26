<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2020
     */

    /**
     * Маленький и быстрый дебаггер
     * Завершает работу скрипта
     *
     * @param mixed   $array
     * @param boolean $var_dump
     */
    if ( ! function_exists('debug')) {
        function debug($data, $var_dump = false, $die = true)
        {
            if ( ! $var_dump && (is_array($data) || is_object($data))) {
                echo '<pre>';
                print_r($data);
                echo '</pre>';
            } else {
                var_dump($data);
            }
            if ($die) {
                die();
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Форма множественного числа
     *
     */
    if ( ! function_exists('plural_form')) {
        function plural_form($num, $array)
        {
            $q = ($num % 10 == 1 && $num % 100 != 11 ? 0 : ($num % 10 >= 2 && $num % 10 <= 4 &&

            ($num % 100 < 10 or $num % 100 >= 20) ? 1 : 2));

            return ($q == 0 ? $array[0] : ($q == 1 ? $array[1] : ($q == 2 ? $array[2] : null)));
        }
    }

    // --------------------------------------------------------------------

    /**
     * Объединение get-запросов
     * в урл адресе
     */
    if ( ! function_exists('modify_url')) {
        function modify_url($mod)
        {
            // The variable $_SERVER['HTTP_HOST'] only work on browser, not PHP-CLI, so when you run command php artisan $_SERVER['HTTP_HOST'] will not exists, you can check here Undefined index HTTP_HOST
            // https://stackoverflow.com/questions/45156159/laravel-5-1-gives-undefined-index-http-host-when-run-php-artisan-serve
            if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
                $url = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

                if ( ! $_SERVER['QUERY_STRING']) {
                    $queryStart = '?';
                } else {
                    $query = explode('&', $_SERVER['QUERY_STRING']);
                    $queryStart = '&';
                }

                // modify data
                if (isset($query)) {
                    foreach ($query as $q) {
                        list($key, $value) = explode('=', $q);
                        if (array_key_exists($key, $mod)) {

                            if ($mod[$key])  {
                                $url = preg_replace('/'. $key .'='. $value .'/', $key .'='. $mod[$key], $url);
                            } else {
                                $url = preg_replace('/&?'. $key .'='. $value .'/', '', $url);
                            }
                        }
                    }
                }

                // add new data
                foreach ($mod as $key => $value) {
                    if ($value && ! preg_match('/'. $key .'=/', $url)) {
                        $url .= $queryStart . $key .'='. $value;
                        $queryStart = '&';
                    }
                }
                return $url;
            }
        }
    }

    // --------------------------------------------------------------------

    if ( ! function_exists('url_get_contents')) {
        function url_get_contents($url, $ctx = '')
        {
            if (empty($ctx)) {
                $opts = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $context = stream_context_create($opts);
            } else {
                $context = $ctx;
            }
            if (ini_get('allow_url_fopen')) {
                try {
                    $tmp = @file_get_contents($url, false,$context);
                    if ($tmp != false) {
                        return $tmp;
                    }
                } catch(ErrorException $e) {}
            } else if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                return $output;
            }
            return @file_get_contents($url, false,$context);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Returns a file size limit in bytes based on the PHP upload_max_filesize
     * and post_max_size
     */
    if ( ! function_exists('file_upload_max_size')) {
        function file_upload_max_size()
        {
            static $max_size = -1;

            if ($max_size < 0) {
                // Start with post_max_size.
                $max_size = parse_size(ini_get('post_max_size'));

                // If upload_max_size is less, then reduce. Except if upload_max_size is
                // zero, which indicates no limit.
                $upload_max = parse_size(ini_get('upload_max_filesize'));
                if ($upload_max > 0 && $upload_max < $max_size) {
                    $max_size = $upload_max;
                }
            }
            return $max_size;
        }
    }

    // --------------------------------------------------------------------

    /**
     * echo parse_size('2kb'); => 2048
     * @param  string
     * @return number of byte
     */
    if ( ! function_exists('parse_size')) {
        function parse_size($size)
        {
            $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
            $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
            if ($unit) {
                // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
                return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
            } else {
                return round($size);
            }
        }
    }

    // --------------------------------------------------------------------

    if ( ! function_exists('base64_data_to_image')) {
        function base64_data_to_image($imgBase64)
        {
            $img = $imgBase64;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            return base64_decode($img);
        }
    }

    // --------------------------------------------------------------------

    if ( ! function_exists('get_realIp_address')) {
        function get_realIp_address()
        {
            if ( ! empty($_SERVER['HTTP_CLIENT_IP'])) { // check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
    }

    // --------------------------------------------------------------------
    
    if ( ! function_exists('get_autoincrement')) {
        function get_autoincrement($table = null)
        {
            if ($table) {
                $statement = \DB::select("SHOW TABLE STATUS LIKE '". $table ."'");
                return $statement[0]->Auto_increment;
            } else {
                return 1;
            }
            
        }
    }

    // --------------------------------------------------------------------

    /**
     * Возвращает рандомную строку
     *
     */
    if ( ! function_exists('sx_uniqid')) {
        function sx_uniqid($length = 16)
        {
            if ($length > 32) {
                $chars = 'abcdefghijkmnpqrstuvwxyz123456789_';
                $numChars = strlen($chars);
                $str = '';
                for ($i = 0; $i < $length; $i++) {
                    $str .= substr($chars, rand(1, $numChars) - 1, 1);
                }
                return $str;
            } else {
                return substr(md5(uniqid()), 0, $length);
            }
        }
    }
    
    // --------------------------------------------------------------------

    /**
     * Notify
     *
     * @param string $message
     * @param string $type
     * @return App\Services\Notify
     */
    if ( ! function_exists('copyright')) {
        function notifyAdd($content, $type = null) {
            
            $notify = new App\Services\Notify();
            
            if (! is_null($message)) {
                return $notify->message($content, $type);
            }

            return $notify;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Автоматически выводит copyright
     *
     */
    if ( ! function_exists('copyright')) {
        function copyright($year = 'auto')
        {
            if (intval($year) == 'auto') {
                $year = date('Y');
            }
            if (intval($year) == date('Y')) {
                $result = intval($year);
            }
            if (intval($year) < date('Y')) {
                $result = intval($year) .' - '. date('Y');
            }
            if (intval($year) > date('Y')) {
                $result = date('Y');
            }
            return $result;
        }
    }

