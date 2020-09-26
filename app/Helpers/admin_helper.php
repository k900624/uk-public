<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    if ( ! function_exists('adminShowRate')) {
        function adminShowRate($rate, $icon = 'fa fa-star')
        {
            $rate_max = 5;
            $icons = '';
            for ($i = 1; $i <= $rate_max; $i++) {
                if ($i <= $rate) {
                    $icons .= '<i class="'. $icon .' text-warning"></i>';
                } else {
                    $icons .= '<i class="'. $icon .' text-grey-lighten-1"></i>';
                }
            }
            return $icons;
        }
    }

    if ( ! function_exists('access')) {
        /**
         * Access (lol) the Access:: facade as a simple function.
         */
        function access()
        {
            return auth()->user();
        }
    }
