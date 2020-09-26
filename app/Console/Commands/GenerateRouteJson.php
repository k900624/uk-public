<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Router;
use \File;

class GenerateRouteJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:json';

    protected $router;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate RouteList to json object';

    /**
     * Create a new command instance.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        parent::__construct();

        $this->router = $router;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = [];

        foreach ($this->router->getRoutes() as $route) {
            $routes[$route->getName()] = $route->uri();
        }

        File::put('resources/assets/js/app/routes.json', json_encode($routes));

        $this->info('Json object for routes generated.');
    }
}
