<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Events\ArtisanStarting;
use Illuminate\Support\Facades\Artisan;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myBackUp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for backup of DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call("backup:run --only-db --disable-notifications");
        dd(Artisan::output());
    }
}
