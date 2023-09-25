<?php

namespace App\Console\Commands;

use App\Http\Controllers\LaravelCollectionController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class collectionPractice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:collection-practice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('call:controller-action', [
            'controller' => LaravelCollectionController::class,
            'method' => 'index',
        ]);

    }
}
