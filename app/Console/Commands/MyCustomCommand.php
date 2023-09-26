<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyCustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:my-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'My demo artisan command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'This is my custom command';
    }
}
