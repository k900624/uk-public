<?php

namespace App\Http\Controllers\Admin\System;

use App\Services\LogViewer;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class LogController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        view()->share(['heading' => 'Логи', 'title' => 'Список логов']);
    }

    public function index(Request $request)
    {
        if ($request->input('log')) {
            LogViewer::setFile(base64_decode($request->input('log')));
        }

        if ($request->input('download')) {
            return $this->download(LogViewer::pathToLogFile(base64_decode($request->input('download'))));
        } elseif ($request->has('del')) {
            app('files')->delete(LogViewer::pathToLogFile(base64_decode($request->input('del'))));

            return $this->redirect($request->url().'?logs=true')->with([
                'message'    => 'Успешно удален файл логов:' . ' ' . base64_decode($request->input('del')),
                'alert-type' => 'success',
            ]);
        } elseif ($request->has('delall')) {
            foreach (LogViewer::getFiles(true) as $file) {
                app('files')->delete(LogViewer::pathToLogFile($file));
            }

            return $this->redirect($request->url().'?logs=true')->with([
                'message'    => 'Успешно удалены все лог файлы',
                'alert-type' => 'success',
            ]);
        }

        $logs = LogViewer::all();
        $files = LogViewer::getFiles(true);
        $current_file = LogViewer::getFileName();

        return view('admin.system.logs.index', compact('logs', 'files', 'current_file'));
    }

    private function redirect($to)
    {
        if (function_exists('redirect')) {
            return redirect($to);
        }

        return app('redirect')->to($to);
    }

    private function download($data)
    {
        if (function_exists('response')) {
            return response()->download($data);
        }

        // For laravel 4.2
        return app('\Illuminate\Support\Facades\Response')->download($data);
    }

}


