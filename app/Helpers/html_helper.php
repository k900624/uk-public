<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    if ( ! function_exists('showRate')) {
        function showRate($rate, $icon = 'icon-star')
        {
            $rate_max = 5;
            $icons = '';
            for ($i = 1; $i <= $rate_max; $i++) {
                if ($i <= $rate) {
                    $icons .= '<i class="'. $icon .' text-warning"></i>';
                } else {
                    $icons .= '<i class="'. $icon .' text-black-50"></i>';
                }
            }
            return $icons;
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