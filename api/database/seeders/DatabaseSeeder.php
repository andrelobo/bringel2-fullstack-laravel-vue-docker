<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\CategoriaSeeder;
use Database\Seeders\ProdutoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Chama os Seeders
        $this->call([
            AdminUserSeeder::class,
            CategoriaSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
