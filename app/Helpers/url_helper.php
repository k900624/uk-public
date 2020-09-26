<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    /**
     * is_active
     * Allows a string input that is
     * delimited with "/". If the current
     * params contain what is currently
     * being viewed, it will return true
     *
     * This function is order sensitive.
     * If the page is /view/lab/1 and you put
     * lab/view, this will return false.
     *
     * @author sjlu
     */
    if ( ! function_exists('is_active')) {
        function is_active($input_params = "")
        {
            //$uri_string = trim($_SERVER['REQUEST_URI'], '/');
            $uri_string = trim($_SERVER['REDIRECT_URL'], '/');

            // direct matching, faster than looping.
            if ($uri_string == trim($input_params, '/')) return true;

            $uri_params = preg_split("/\//", $uri_string);
            $input_params = preg_split("/\//", $input_params);

            $prev_key = -1;
            foreach ($input_params as $param) {
                $curr_key = array_search($param, $uri_params);

                // if it doesn't exist, return null
                if ($curr_key === false) return false;

                // this makes us order sensitive
                if ($curr_key < $prev_key) return false;

                $prev_key = $curr_key;
            }
            return true;
        }

       function active($route, $active = 'active')
       {
           return parse_url(\Request::url(), PHP_URL_PATH) == $route  ? $active : '';
       }
    }

    // --------------------------------------------------------------------

    /**
     * Returns the HTTP answer for one URL or FALSE if the URL wasn't found
     *
     */
    if( ! function_exists('check_url')) {
        function check_url($url)
        {
            if (function_exists('curl_init')) {
                $url = prep_url($url);
                $c = curl_init();
                curl_setopt($c, CURLOPT_URL, $url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($c, CURLOPT_NOBODY, true);
                $output = @curl_exec($c);

                if ($output !== false) {
                    $httpCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
                    curl_close($c);
                    return $httpCode;
                }
                return false;
            } else {
                return @fsockopen("$url", 80, $errno, $errstr, 30);
            }
            return false;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Validate URL address
     *
     */
    if ( ! function_exists('validate_url')) {
        function validate_url($url)
        {
            $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
            return (bool) preg_match($pattern, $url);
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('url_title'))
    {
        /**
         * Create URL Title
         *
         * Takes a "title" string as input and creates a
         * human-friendly URL string with a "separator" string
         * as the word separator.
         *
         * @param	string	$str		Input string
         * @param	string	$separator	Word separator
         *			(usually '-' or '_')
         * @param	bool	$lowercase	Whether to transform the output string to lowercase
         * @return	string
         */
        function url_title($str, $separator = '-', $lowercase = false)
        {
            if ($separator === 'dash') {
                $separator = '-';
            } elseif ($separator === 'underscore') {
                $separator = '_';
            }

            $q_separator = preg_quote($separator, '#');

            $trans = array(
                '&.+?;'			=> '',
                '[^\w\d _-]'		=> '',
                '\s+'			=> $separator,
                '('.$q_separator.')+'	=> $separator
            );

            $str = strip_tags($str);
            foreach ($trans as $key => $val) {
                $str = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $str);
            }

            if ($lowercase === true) {
                $str = strtolower($str);
            }

            return trim(trim($str, $separator));
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('prep_url'))
    {
        /**
         * Prep URL
         *
         * Simply adds the http:// part if no scheme is included
         *
         * @param   string  the URL
         * @return  string
         */
        function prep_url($str = '')
        {
            if ($str === 'http://' || $str === '') {
                return '';
            }

            $url = parse_url($str);

            if ( ! $url || ! isset($url['scheme'])) {
                return 'http://'. $str;
            }

            return $str;
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('remove_http'))
    {
        /**
         * Remove HTTP from URL
         *
         * Simply adds the http:// part if no scheme is included
         *
         * @param   string  the URL
         * @return  string
         */
        function remove_http($url = '')
        {
            // $disallowed = ['http://', 'https://'];
            // foreach ($disallowed as $d) {
            //     if (strpos($url, $d) === 0) {
            //         return str_replace($d, '', $url);
            //     }
            // }
            // return $url;
            return preg_replace("(^https?://)", "", $url);
        }
    }
