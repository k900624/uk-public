<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */


    /**
     * Outputs the html checked attribute.
     *
     * Compares the first two arguments and if identical marks as checked
     *
     * @since 1.0.0
     *
     * @param mixed $checked One of the values to compare
     * @param mixed $current (true) The other value to compare if not just true
     * @param bool  $echo    Whether to echo or just return the string
     * @return string html attribute or empty string
     */
    function checked($checked, $current = true, $echo = true) {
        return __checked_selected_helper($checked, $current, $echo, 'checked');
    }

    /**
     * Outputs the html selected attribute.
     *
     * Compares the first two arguments and if identical marks as selected
     *
     * @since 1.0.0
     *
     * @param mixed $selected One of the values to compare
     * @param mixed $current  (true) The other value to compare if not just true
     * @param bool  $echo     Whether to echo or just return the string
     * @return string html attribute or empty string
     */
    function selected($selected, $current = true, $echo = true) {
        return __checked_selected_helper($selected, $current, $echo, 'selected');
    }

    /**
     * Outputs the html disabled attribute.
     *
     * Compares the first two arguments and if identical marks as disabled
     *
     * @since 3.0.0
     *
     * @param mixed $disabled One of the values to compare
     * @param mixed $current  (true) The other value to compare if not just true
     * @param bool  $echo     Whether to echo or just return the string
     * @return string html attribute or empty string
     */
    function disabled($disabled, $current = true, $echo = true) {
        return __checked_selected_helper($disabled, $current, $echo, 'disabled');
    }

    /**
     * Outputs the html readonly attribute.
     *
     * Compares the first two arguments and if identical marks as readonly
     *
     * @since 4.9.0
     *
     * @param mixed $readonly One of the values to compare
     * @param mixed $current  (true) The other value to compare if not just true
     * @param bool  $echo     Whether to echo or just return the string
     * @return string html attribute or empty string
     */
    function readonly($readonly, $current = true, $echo = true) {
        return __checked_selected_helper($readonly, $current, $echo, 'readonly');
    }

    /**
     * Private helper function for checked, selected, disabled and readonly.
     *
     * Compares the first two arguments and if identical marks as $type
     *
     * @since 2.8.0
     * @access private
     *
     * @param mixed  $helper  One of the values to compare
     * @param mixed  $current (true) The other value to compare if not just true
     * @param bool   $echo    Whether to echo or just return the string
     * @param string $type    The type of checked|selected|disabled|readonly we are doing
     * @return string html attribute or empty string
     */
    function __checked_selected_helper($helper, $current, $echo, $type) {
        if ( (string) $helper === (string) $current) {
            $result = " $type='$type'";
        } else {
            $result = '';
        }

        if ($echo) {
            echo $result;
        }
        return $result;
    }