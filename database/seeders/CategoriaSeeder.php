<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Desactiva las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpia la tabla antes de insertar (evita duplicados)
        Categoria::truncate();

        $categorias = [
            ['descripcion' => 'Electrónica'],
            ['descripcion' => 'Ropa y Accesorios'],
            ['descripcion' => 'Alimentos y Bebidas'],
            ['descripcion' => 'Hogar y Jardín'],
            ['descripcion' => 'Deportes'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }

        // Reactiva las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✔ Categorías insertadas: ' . count($categorias));
    }
}
