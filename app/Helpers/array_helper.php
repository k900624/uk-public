<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    /**
     * Возвращает уникальные значения многомерного массива
     */
    if ( ! function_exists('unique_multidim_array')) {
        function unique_multidim_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val) {
                if ( ! in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
            unset($array);
            return $temp_array;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Создает дерево
     */
    if ( ! function_exists('map_tree')) {
        function map_tree($dataset)
        {
            $tree = array(); // Создаем новый массив
            /*
              Проходим в цикле по массиву $dataset, который был передан в качестве аргумента.
              в $id будет попадать уникальный id комментария,
              &$node - обратите внимание, работаем со значением по ссылке!
            */
            foreach ($dataset as $id => &$node) {
                if ( empty($node['parent_id'] )) {
                    // Если не имеет родителя, т.е. корневой элемент
                    $tree[$id] = &$node;
                } else {
                    /*
                     Иначе это чей-то потомок
                     этого потомка переносим в родительский элемент,
                     при этом у родителя внутри элемента создастся массив childs, в котором и будут вложены его потомки
                    */
                    $dataset[$node['parent_id']]['childs'][$id] = &$node;
                    $dataset[$node['parent_id']]['childs_count'] = count($dataset[$node['parent_id']]['childs']);
                }
            }
            unset($dataset);
            return $tree;
        }
    }

    // --------------------------------------------------------------------

    if (!function_exists('is_true_array')) {
        /**
         *
         * @param array $array
         * @return boolean
         */
        function is_true_array($array)
        {
            if ($array == false) {
                return false;
            }
            $arraySize = count($array);
            return $arraySize > 0;
        }
    }

    // --------------------------------------------------------------------

    if (!function_exists('user_function_sort')) {
        /**
         *
         * @param array $arr
         * @param string $key
         * @return array
         */
        function user_function_sort($arr, $key = 'value')
        {
            usort(
                $arr,
                function ($a, $b) use ($key) {
                    return strnatcmp($a[$key], $b[$key]);
                }
            );
            return $arr;
        }
    }

    // --------------------------------------------------------------------

    if (!function_exists('array_key_exists_recursive')) {
        /**
         * Recursive search key in associative array (depth does not matter)
         * @param string $key
         * @param array $array
         * @param boolean $return (optional) if true then result will be returned (false default)
         * @return boolean|mixed
         */
        function array_key_exists_recursive($key, $array, $return = false)
        {
            foreach ($array as $key_ => $value_) {
                if (is_array($value_) && $key_ !== $key) {
                    if (false !== $value = array_key_exists_recursive($key, $value_, $return)) {
                        return $return === false ? true : $value;
                    }
                } else {
                    if ($key_ == $key) {
                        return $return === false ? true : $array[$key_];
                    }
                }
            }
            return false;
        }
    }

    // --------------------------------------------------------------------

    if (!function_exists('in_multiarray')) {
        /**
         * Search in multidimensional array
         *
         * @param $elem
         * @param $array
         * @return bool
         */
        function in_multiarray($elem, $array) {
            foreach ($array as $key => $value) {
                if ($value == $elem){
                    return true;
                } elseif (is_array($value)){
                    if (in_multiarray($elem, $value))
                        return true;
                }
            }

            return false;
        }
    }

    // --------------------------------------------------------------------

    if ( ! function_exists('array_key_first')) {
        /**
         * Return first key from multidimensional array (Added in 7.3 php version)
         * Polifill for array_key_first
         * 
         * @param $array
         * @return bool
         */
        function array_key_first($array) {
            if (is_array($array)) {
                foreach ($array as $key => $value) {
                    return $key;
                }
            }
            return null;
        }
    }

    // --------------------------------------------------------------------

    if ( ! function_exists('array_key_last')) {
        /**
         * Return last key from multidimensional array (Added in 7.3 php version)
         * Polifill for array_key_last
         * 
         * @param $array
         * @return bool
         */
        function array_key_last($array) {
            $key = null;

            if (is_array($array)) {
                end($array);
                $key = key($array);
            }
            return $key;
        }
    }
