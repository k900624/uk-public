<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    /**
     * @param string $str
     * @return string
     */
    if ( ! function_exists('html_encode')) {
        function html_encode($str)
        {
            return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
        }
    }

    // --------------------------------------------------------------------

    /**
     * @param string $str
     * @return string
     */
    if ( ! function_exists('html_decode')) {
        function html_decode($str)
        {
            return html_entity_decode($str, ENT_QUOTES, "UTF-8");
        }
    }

    // --------------------------------------------------------------------

    /**
     * Берет первый абзац
     */
    if ( ! function_exists('first_paragraph')) {
        function first_paragraph($str)
        {
            mb_internal_encoding("UTF-8");
            $pos2 = 0;
            $haystack = $str;
            $needle = preg_match("/<\/p>/", $haystack) ? "</p>" : "</div>";
            $meta_og = mb_substr($haystack, 0, mb_strpos($haystack, $needle));

            while (mb_strlen(trim(strip_tags($meta_og))) < 20) {
                $pos1 = mb_strpos($haystack, $needle, $pos2);
                $pos2 = mb_strpos($haystack, $needle, $pos1 + mb_strlen($needle));
                $meta_og = mb_substr($haystack, $pos1, $pos2 - $pos1);
            }
            return $meta_og;
        }
    }
    
    if ( ! function_exists('ellipsize')) {
        /**
         * Ellipsize String
         *
         * This function will strip tags from a string, split it at its max_length and ellipsize
         *
         * @param    string    string to ellipsize
         * @param    int    max length of string
         * @param    mixed    int (1|0) or float, .5, .2, etc for position to split
         * @param    string    ellipsis ; Default '...'
         * @return    string    ellipsized string
         */
        function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;')
        {
            // Strip tags
            $str = trim(strip_tags($str));

            // Is the string long enough to ellipsize?
            if (mb_strlen($str) <= $max_length) {
                return $str;
            }

            $beg = mb_substr($str, 0, floor($max_length * $position));
            $position = ($position > 1) ? 1 : $position;

            if ($position === 1) {
                $end = mb_substr($str, 0, -($max_length - mb_strlen($beg)));
            } else {
                $end = mb_substr($str, -($max_length - mb_strlen($beg)));
            }
            return $beg.$ellipsis.$end;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * ucfirst for cirilic
     */
    if ( ! function_exists('mb_ucfirst') && function_exists('mb_substr')) {
        function mb_ucfirst($string)
        {
            return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
        }
    }