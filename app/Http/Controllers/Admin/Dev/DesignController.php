<?php

namespace App\Http\Controllers\Admin\Dev;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;


class DesignController extends BaseController
{
    public function index()
    {
        return view('admin.dev.design.index')->with(['heading' => 'Design', 'title' => 'Design']);
    }
}
