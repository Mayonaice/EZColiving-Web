<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DbMonitor extends Command
{
    protected $signature = 'db:monitor {--timeout=5}';
    protected $description = 'Monitor database connection';

    public function handle()
    {
        try {
            $connection = DB::connection();
            $connection->getPdo();
            
            Log::info('Database connection successful', [
                'host' => config('database.connections.mysql.host'),
                'database' => config('database.connections.mysql.database'),
                'port' => config('database.connections.mysql.port')
            ]);
            
            return 0;
        } catch (\Exception $e) {
            Log::error('Database connection failed', [
                'error' => $e->getMessage(),
                'host' => config('database.connections.mysql.host'),
                'database' => config('database.connections.mysql.database'),
                'port' => config('database.connections.mysql.port')
            ]);
            
            $this->error("Database connection failed: {$e->getMessage()}");
            return 1;
        }
    }
} 