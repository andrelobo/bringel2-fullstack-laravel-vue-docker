<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria um usuário admin
        User::create([
            'name' => 'Teste de seeder',
            'email' => 'teste@hotmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
