<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    /**
     * Очищаем title $text
     * Убираем все теги
     */
    if ( ! function_exists('filter_title')) {
        function filter_title($text)
        {
            // Преобразоваем кавычки в елочки
            $text = quotes_replace($text);
            return html_encode(strip_tags(trim($text)));
        }
    }

    // --------------------------------------------------------------------

    /**
     * Очищаем introtext $text
     * Убираем все теги
     */
    if ( ! function_exists('filter_intro')) {
        function filter_intro($text)
        {
            return html_encode(strip_tags(trim($text)));
        }
    }

    // --------------------------------------------------------------------

    /**
     * Очищаем fulltext $text
     * Убираем все теги, кроме разрешенных
     */
    if ( ! function_exists('filter_fulltext')) {
        function filter_fulltext($text)
        {
            if (empty($text)) {
                return null;
            }
            // Заменяем идущие подряд знаки препинания .,!?- на один знак.
            $text = preg_replace('#(\.|\?|!|-|,|\(|\.\)){2,}#', '\1', $text);

            // Заменяем сущность &nbsp; на пробел
            // $text = html_encode($text);
            $text = str_replace('&nbsp;', ' ', $text);
            $text = html_decode($text);

            // Заменяем повторяющиеся пробелы на один.
            $text = preg_replace('/ +/', ' ', $text);

            // Вырезаем все теги кроме...
            $text = strip_tags($text, '<h2><h3><h4><h5><h6><p><blockquote><span><b><strong><i><em><sup><sub><br><table><tr><td><th><hr><ul><ol><li><img><a>');

            return html_encode($text);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Функция форматирования строк
     *
     */
    if ( ! function_exists('clean')) {
        function clean($data)
        {
            if (is_array($data)) {
                foreach ($data as $key => $element) {
                    $data[$key] = clean($element);
                }
            } else {
                $data = html_encode(strip_tags(trim($data)));
                if (get_magic_quotes_gpc()) $data = stripslashes($data);
                $data = filter_var($data, FILTER_SANITIZE_STRING);
            }
            return $data;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Функция фильтрации url
     *
     */
    if ( ! function_exists('filter_url')) {
        function filter_url($url)
        {
            return prep_url(preg_replace('/[^A-Za-z0-9~&?%#.:_\/\-=+]/', '', filter_var(str_ireplace(' ', '%20', trim($url, '/')), FILTER_SANITIZE_URL)));
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('prep_url')) {
        /**
         * Prep URL
         *
         * Simply adds the http:// part if no scheme is included
         *
         * @param	string	the URL
         * @return	string
         */
        function prep_url($str = '')
        {
            if ($str === 'http://' OR $str === '') {
                return '';
            }

            $url = parse_url($str);

            if ( ! $url OR ! isset($url['scheme'])) {
                return 'http://'.$str;
            }

            return $str;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Функция форматирования целых числовых переменных
     *
     */
    if ( ! function_exists('int')) {
        function int($var)
        {
            return abs(intval($var));
        }
    }

    // --------------------------------------------------------------------

    /**
     * Функция поверки пароля
     *
     */
    if ( ! function_exists('sx_password_verify')) {
        function sx_password_verify($password, $hash)
        {
            return (sha1($password) === $hash) ? true : false;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Преобразоваем кавычки в елочки
     */
    if ( ! function_exists('quotes_replace')) {
        function quotes_replace($text)
        {
            return preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $text);
        }
    }