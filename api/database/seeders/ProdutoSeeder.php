<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insere produtos no banco
        DB::table('produtos')->insert([
            [
                'nome' => 'Smartphone XYZ',
                'descricao' => 'Smartphone de última geração com 128GB de armazenamento.',
                'preco' => 1999.99,
                'data_validade' => '2026-12-31',
                'imagem' => 'imagem_produto_1.jpg',
                'categoria_id' => 1, // ID da categoria 'Eletrônicos'
            ],
            [
                'nome' => 'Camiseta Estampada',
                'descricao' => 'Camiseta com estampa exclusiva e moderna.',
                'preco' => 89.90,
                'data_validade' => '2025-12-31',
                'imagem' => 'imagem_produto_2.jpg',
                'categoria_id' => 2, // ID da categoria 'Roupas'
            ],
            [
                'nome' => 'Livro de Programação',
                'descricao' => 'Livro completo sobre desenvolvimento de software.',
                'preco' => 59.90,
                'data_validade' => '2025-12-31',
                'imagem' => 'imagem_produto_3.jpg',
                'categoria_id' => 4, // ID da categoria 'Livros'
            ],
        ]);
    }
}
