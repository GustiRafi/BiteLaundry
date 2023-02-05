<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\outlet::create([
            'nama' => 'central',
            'alamat' => 'Pandak,Bantul',
            'telp' => '09564647457575'
        ]);

        \App\Models\User::create([
            'name' => 'Rafi Gusti',
            'username' => 'mugiwara',
            'email' => 'gustirafi@gmail.com',
            'password' => Hash::make('password'),
            'id_outlet' => '1',
            'role' => 'admin',
        ]);
    }
}
