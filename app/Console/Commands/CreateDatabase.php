<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CreateDatabase extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create the database if it does not exist';

    public function handle()
    {
        $dbName = Config::get('database.connections.mysql.database');

        // Ganti koneksi ke MySQL server tanpa database
        Config::set('database.connections.mysql.database', null);

        $query = "CREATE DATABASE IF NOT EXISTS `$dbName`";

        try {
            DB::statement($query);
            $this->info("Database '$dbName' created successfully or already exists.");
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }

        // Balikin nama database (optional)
        Config::set('database.connections.mysql.database', $dbName);
    }
}
