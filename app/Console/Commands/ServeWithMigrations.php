<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ServeWithMigrations extends Command
{
    protected $signature = 'serve:migrate';
    protected $description = 'Run migrations and then start the server';

    public function handle()
    {
        $this->info('Running migrations...');
        
        try {
            Artisan::call('migrate', ['--force' => true]);
            $this->info('Migrations completed successfully.');
        } catch (\Exception $e) {
            $this->error('Migration failed: ' . $e->getMessage());
            return 1;
        }

        $this->info('Starting server...');
        $port = env('PORT', 8000);
        $command = "php artisan serve --host=0.0.0.0 --port={$port}";
        
        // Replace the current process with the server
        exec($command);
    }
}
