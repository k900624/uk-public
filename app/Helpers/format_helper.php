<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    if ( ! function_exists('telephone2print')) {
        function telephone2print($tel)
        {
            $result = $tel;
            if (strlen($tel) == 11) {
                $part2 = substr($tel, 1, 3);
                $part3 = substr($tel, 4, 3);
                $part4 = substr($tel, 7, 2);
                $part5 = substr($tel, 9, 2);
                $result = "8-" . $part2 . "-" . $part3 . "-" . $part4 . "-" . $part5;
            }
            return $result;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Очищает все символы в номере телефона, кроме цифр
     * clearPhone('8 (963) 87-60-737') -> 79638760737
     *
     */
    if ( ! function_exists('clearPhone')) {
        function clearPhone($phone)
        {
            $arr_phone = array(' ', '(', ')', '+', '-', '_');
            $phone = str_replace($arr_phone, '', $phone);

            if (strlen($phone) == 11) {
                if ($phone[0] == '8') {
                    $phone[0] = 7;
                }
            }
            return $phone;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Очищает все символы в номере телефона, кроме цифр и "+"
     * tel('+7 (963) 87-60-737') -> +79638760737
     *
     */
    if ( ! function_exists('tel')) {
        function tel($phone)
        {
            return preg_replace('#[^0-9+]+#', '', $phone);
        }
    }