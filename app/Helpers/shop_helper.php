<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    /**
     * Убирает лишние ноли до и после запятой
     *
     */
    if ( ! function_exists('floattostr')) {
        function floattostr($val)
        {
            preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
            return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
        }
    }
