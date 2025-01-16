<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder; // Importar o seeder AdminUserSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chama o seeder do AdminUser
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
