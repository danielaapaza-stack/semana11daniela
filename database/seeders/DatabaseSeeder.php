<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,      // Primero usuarios
            CategoriaSeeder::class,  // Primero categorías
            ProductoSeeder::class,   // Luego productos
        ]);
    }
}

