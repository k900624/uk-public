<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;

class AjaxController extends BaseController
{
    /**
     * Notify messages
     */
    public function loadMsg()
    {
        if (request()->ajax()) {

            $messages = $this->notify->get();

            if (is_array($messages) && count($messages) > 0) {
                $data = [
                    'status'   => 'on',
                    'messages' => $messages
                ];
            } else {
                $data = [
                    'status'   => 'off',
                    'messages' => ''
                ];
            }
            return response()->json($data);
        }
    }

}
