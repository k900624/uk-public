<?php

namespace App\Http\Controllers\Admin\System;

use Artisan;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Http\Controllers\Admin\BaseController;

class CommandController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        view()->share(['heading' => 'Команды Artisan', 'title' => 'Список команд']);
    }

    public function index(Request $request)
    {
        $artisan_output = '';
        if ($request->isMethod('post')) {
            $command = $request->command;
            $args = $request->args;
            $args = (isset($args)) ? ' '. $args : '';

            try {
                $process = new Process('cd '. base_path() .' && php artisan '. $command . $args);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                $artisan_output = $process->getOutput();

            } catch (Exception $e) {
                $artisan_output = $e->getMessage();
            }
        }

        $commands = $this->getArtisanCommands();

        return view('admin.system.commands.index', compact('commands', 'artisan_output'));
    }

    private function getArtisanCommands()
    {
        Artisan::call('list');

        // Get the output from the previous command
        $artisan_output = Artisan::output();
        $artisan_output = $this->cleanArtisanOutput($artisan_output);
        $commands = $this->getCommandsFromOutput($artisan_output);

        return $commands;
    }

    private function cleanArtisanOutput($output)
    {

        // Add each new line to an array item and strip out any empty items
        $output = array_filter(explode("\n", $output));

        // Get the current index of: "Available commands:"
        $index = array_search('Available commands:', $output);

        // Remove all commands that precede "Available commands:", and remove that
        // Element itself -1 for offset zero and -1 for the previous index (equals -2)
        $output = array_slice($output, $index - 2, count($output));

        return $output;
    }

    private function getCommandsFromOutput($output)
    {
        $commands = [];

        foreach ($output as $output_line) {
            if (empty(trim(substr($output_line, 0, 2)))) {
                $parts = preg_split('/  +/', trim($output_line));
                $command = (object) ['name' => trim(@$parts[0]), 'description' => trim(@$parts[1])];
                array_push($commands, $command);
            }
        }

        return $commands;
    }
}
