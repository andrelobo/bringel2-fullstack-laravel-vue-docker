<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insere algumas categorias padrão no banco
        DB::table('categorias')->insert([
            ['nome' => 'Eletrônicos'],
            ['nome' => 'Roupas'],
            ['nome' => 'Alimentos'],
            ['nome' => 'Livros'],
            ['nome' => 'Beleza e Cuidados'],
        ]);
    }
}
