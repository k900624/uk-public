<?php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

    date_default_timezone_set('Asia/Yekaterinburg');

    /**
     * Формируем дату в удобный вид
     */
    if ( ! function_exists('format_date')) {
        function format_date($mysql_date, $case)
        {
            $date = '';
            if ($mysql_date && ($mysql_date != "0000-00-00 00:00:00")) {
                $array = explode(' ',$mysql_date); //Разбиваем MySQL на дату и время

                $array_date = explode('-',$array[0]); //Разбиваем дату на массив
                $array_time = explode(':',$array[1]); //Разбиваем время на массив

                //Создаем русские названия месяцев для последующей замены
                $month['01'] = 'января';
                $month['02'] = 'февраля';
                $month['03'] = 'марта';
                $month['04'] = 'апреля';
                $month['05'] = 'мая';
                $month['06'] = 'июня';
                $month['07'] = 'июля';
                $month['08'] = 'августа';
                $month['09'] = 'сентября';
                $month['10'] = 'октября';
                $month['11'] = 'ноября';
                $month['12'] = 'декабря';

                $month_light['01'] = 'янв';
                $month_light['02'] = 'фев';
                $month_light['03'] = 'мар';
                $month_light['04'] = 'апр';
                $month_light['05'] = 'май';
                $month_light['06'] = 'июн';
                $month_light['07'] = 'июл';
                $month_light['08'] = 'авг';
                $month_light['09'] = 'сен';
                $month_light['10'] = 'окт';
                $month_light['11'] = 'ноя';
                $month_light['12'] = 'дек';

                //Если день месяца меньше десяти, то убераем ноль перед числом
                if ($array_date[2]<10) {
                    $array_date[2] = str_replace(0, '', $array_date[2]);
                }

                $day = date('D', mktime(0,0,0,$array_date[1],$array_date[2],$array_date[0])); //Получаем день недели для данной даты

                $weekday['Mon'] = 'Понедельник';
                $weekday['Tue'] = 'Вторник';
                $weekday['Wed'] = 'Среда';
                $weekday['Thu'] = 'Четверг';
                $weekday['Fri'] = 'Пятница';
                $weekday['Sat'] = 'Суббота';
                $weekday['Sun'] = 'Воскресенье';

                // Пятница, 27 января 2006 года.
                if ($case == 1) {
                    $date = $weekday[$day] .', '. $array_date[2] .' '. $month[$array_date[1]] .' '. $array_date[0].' года';
                }

                // 27.01.2006
                if ($case == 2) {
                    $date = $array_date[2] .'.'. $array_date[1] .'.'. $array_date[0];
                }

                // 27.01.2006 в 17:15
                if ($case == 3) {
                    $date = $array_date[2] .'.'. $array_date[1] .'.'. $array_date[0] .' в '. $array_time[0] .':'. $array_time[1];
                }

                // 27 января 2006 в 17:15
                if ($case == 4) {
                    $date = $array_date[2] .' '. $month[$array_date[1]] .' '. $array_date[0].' в '.$array_time[0] .':'. $array_time[1];
                }

                // 27 января 2006
                if ($case == 5) {
                    $date = $array_date[2] .' '. $month[$array_date[1]] .' '. $array_date[0];
                }

                // 27 янв
                if ($case == 6) {
                    $date = $array_date[2] .' '. $month_light[$array_date[1]];
                }

                // Янв
                if ($case == 7) {
                    $date = mb_ucfirst($month_light[$array_date[1]]);
                }
            }
            //Возвращаем отформатированную дату
            return $date;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Принимает дд.мм.гггг на вход, и возвращает метку времени Unix
     */
    if ( ! function_exists('format_to_unix')) {
        function format_to_unix($datestr = '')
        {
            if ($datestr == '') {
                return false;
            }

            $datestr = trim($datestr);
            $datestr = preg_replace("/\040+/", ' ', $datestr);

            if ( ! preg_match('/^\d{2}[.]\d{2}[.]\d{4}$/', $datestr)) {
                return false;
            }

            $ex = explode(".", $datestr);

            $year  = $ex['2'];
            $month = $ex['1'];
            $day   = $ex['0'];

            return mktime(0, 0, 0, $month, $day, $year);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Вычисляет кол-во лет
     */
    if ( ! function_exists('get_age')) {
        function get_age($datestr = '')
        {
            if ($datestr == '') {
                return false;
            }

            $datestr = trim($datestr);
            $datestr = preg_replace("/\040+/", ' ', $datestr);

            if ( ! preg_match('/^\d{2}[.]\d{2}[.]\d{4}$/', $datestr)) {
                return false;
            }

            $date = new DateTime($datestr);
            $now  = new DateTime();
            $interval = $now->diff($date);

            return $interval->format('%Y');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Генерирует текущее время в формате "2012-03-19 17:11:55"
     */
    if ( ! function_exists('time_now')) {
        function time_now()
        {
            $now = time();

            return unix_to_human($now, true, 'eu');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Генерирует текущую дату в формате "2012-03-19"
     */
    if ( ! function_exists('date_now')) {
        function date_now()
        {
            return date('Y-m-d');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Возвращает время unixtime в формате 2 часа 23 минуты 30 секунд назад
     *
     */
    if ( ! function_exists('time_ago')) {
        function time_ago($time)
        {
            if ( ! is_int($time)) {
                $time = human_to_unix($time);
            }
            $time = time() - $time; // Calculate the time since that moment ago

            $tokens = array ( // Default time units.
                31536000 => array('год', 'года', 'лет'),
                2592000  => array('месяц', 'месяца', 'месяцев'),
                604800   => array('неделя', 'недели', 'недель'),
                86400  => array('день', 'дня', 'дней'),
                3600   => array('час', 'часа', 'часов'),
                60     => array('минуту', 'минуты', 'минут'),
                1    => array('секунду', 'секунды', 'секунд')
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = ceil($time / $unit);
                // Automatically de-pluralized if, say there is only 1 year.
                return $numberOfUnits .' '. plural_form($numberOfUnits, $text) .' назад';
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     *
     */
    if ( ! function_exists('normal_time')) {
        function normal_time($time)
        {
            $month_name = array(
                1 => 'января',
                2 => 'февраля',
                3 => 'марта',
                4 => 'апреля',
                5 => 'мая',
                6 => 'июня',
                7 => 'июля',
                8 => 'августа',
                9 => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря'
            );

            if ( ! is_int($time)) {
                $time = human_to_unix($time);
            }

            $month = $month_name[date('n', $time)];

            $day = date('j', $time);
            $year = date('Y', $time);
            $hour = date('G', $time);
            $min = date('i', $time);

            $date = $day . ' ' . $month . ' ' . $year . ' г. в ' . $hour . ':' . $min;

            $dif = time() - $time;

            if ($dif < 59) {
                return $dif . " сек. назад";
            } elseif ($dif / 60 > 1 and $dif / 60 < 59) {
                return round($dif / 60) . " мин. назад";
            } elseif ($dif / 3600 > 1 and $dif / 3600 < 23) {
                return round($dif / 3600) . " час. назад";
            } else {
                return $date;
            }
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('unix_to_human'))
    {
        /**
         * Unix to "Human"
         *
         * Formats Unix timestamp to the following prototype: 2006-08-21 11:35 PM
         *
         * @param	int	Unix timestamp
         * @param	bool	whether to show seconds
         * @param	string	format: us or euro
         * @return	string
         */
        function unix_to_human($time = '', $seconds = FALSE, $fmt = 'us')
        {
            $r = date('Y', $time).'-'.date('m', $time).'-'.date('d', $time).' ';

            if ($fmt === 'us') {
                $r .= date('h', $time).':'.date('i', $time);
            } else {
                $r .= date('H', $time).':'.date('i', $time);
            }

            if ($seconds) {
                $r .= ':'.date('s', $time);
            }

            if ($fmt === 'us') {
                return $r.' '.date('A', $time);
            }
            return $r;
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('human_to_unix'))
    {
        /**
         * Convert "human" date to GMT
         *
         * Reverses the above process
         *
         * @param	string	format: us or euro
         * @return	int
         */
        function human_to_unix($datestr = '')
        {
            if ($datestr === '') {
                return false;
            }

            $datestr = preg_replace('/\040+/', ' ', trim($datestr));

            if ( ! preg_match('/^(\d{2}|\d{4})\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr)) {
                return false;
            }

            sscanf($datestr, '%d-%d-%d %s %s', $year, $month, $day, $time, $ampm);
            sscanf($time, '%d:%d:%d', $hour, $min, $sec);
            isset($sec) OR $sec = 0;

            if (isset($ampm)) {
                $ampm = strtolower($ampm);

                if ($ampm[0] === 'p' && $hour < 12) {
                    $hour += 12;
                } elseif ($ampm[0] === 'a' && $hour === 12) {
                    $hour = 0;
                }
            }
            return mktime($hour, $min, $sec, $month, $day, $year);
        }
    }

    if ( ! function_exists('mysql_to_unix'))
    {
        /**
         * Converts a MySQL Timestamp to Unix
         *
         * @param	int	MySQL timestamp YYYY-MM-DD HH:MM:SS
         * @return	int	Unix timstamp
         */
        function mysql_to_unix($time = '')
        {
            // We'll remove certain characters for backward compatibility
            // since the formatting changed with MySQL 4.1
            // YYYY-MM-DD HH:MM:SS

            $time = str_replace(array('-', ':', ' '), '', $time);

            // YYYYMMDDHHMMSS
            return mktime(
                substr($time, 8, 2),
                substr($time, 10, 2),
                substr($time, 12, 2),
                substr($time, 4, 2),
                substr($time, 6, 2),
                substr($time, 0, 4)
            );
        }
    }

    function getCurrencyMonth()
    {
        $monthsList = array(
            "1"=>"январь","2"=>"февраль","3"=>"март",
            "4"=>"апрель","5"=>"май", "6"=>"июнь",
            "7"=>"июль","8"=>"август","9"=>"сентябрь",
            "10"=>"октябрь","11"=>"ноябрь","12"=>"декабрь");
             
        return $monthsList[date("n")];
    }