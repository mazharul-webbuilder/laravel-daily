<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CallControllerMethod extends Command
{
    protected $signature = 'call:controller-action {controller} {method}';
    protected $description = 'Call a controller action';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = $this->argument('controller');
        $method = $this->argument('method');

        // Create an instance of the controller and call the method
        app()->call("$controller@$method");

        $this->info("Controller [$controller] method [$method] has been called.");
    }

}
