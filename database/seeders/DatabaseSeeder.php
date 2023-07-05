<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Carrera::factory(25)->create();

        User::factory()->create([
            'name' => 'administrador',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('administrador'),
        ]);
        User::factory()->create([
            'name' => 'Ing Henry',
            'email' => 'henryr@gmail.com',
            'password' => bcrypt('henryr@gmail.com'),
        ]);
        User::factory()->create([
            'name' => 'Ing Marga',
            'email' => 'marga@gmail.com',
            'password' => bcrypt('marga@gmail.com'),
        ]);

        \App\Models\Curso::factory(15)->create();
    }
}
