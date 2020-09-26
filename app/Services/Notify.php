<?php

/**
 * @author SillexLab (sillexlab@gmail.com)
 * @copyright 2019
 */

namespace App\Services;

class Notify
{
    private $types = [
        'info',
        'error',
        'warning',
        'success'
    ];

    function __construct()
    {
        $messages = session('messages');

        if (empty($messages)) {
            $this->clear();
        }
    }

    public function message($message = null, $type = 'info')
    {
        $messages = session('messages');

        // set the type to message if the user specified a type that's unknown
        if (!in_array($type, $this->types)) {
            $type = 'info';
        }

        if (is_array($message)) {
            foreach ($message as $messageItem) {
                // don't repeat messages!
                if (!in_array($messageItem, $messages[$type])) {
                    $messages[$type][] = $messageItem;
                }
            }
        } else {
            // don't repeat messages!
            if (!in_array($message, $messages[$type])) {
                $messages[$type][] = $message;
            }
        }

        return $messages = session()->put('messages', $messages);
    }

    public function get($type = null)
    {
        $messages = session('messages');

        if ( ! empty($type)) {
            if (count($messages[$type]) == 0) {
                return false;
            }
            return $messages[$type];
        }

        // return false if there actually are no messages in the session
        $i = 0;
        foreach ($this->types as $type) {
            $i += count($messages[$type]);
        }
        if ($i == 0) {
            return false;
        }

        $return = [];
        // order return by order of type array above
        // i.e. success, error, warning and then informational messages last
        foreach ($this->types as $type) {
            $return[$type] = $messages[$type];
        }
        $this->clear();
        return $return;
    }

    public function info($message)
    {
        return $this->message($message, 'info');
    }

    public function success($message)
    {
        return $this->message($message, 'success');
    }

    public function error($message)
    {
        return $this->message($message, 'error');
    }

    public function warning($message)
    {
        return $this->message($message, 'warning');
    }

    private function clear()
    {
        $messages = [];

        foreach ($this->types as $type) {
            $messages[$type] = [];
        }
        session()->put('messages', $messages);
    }
}