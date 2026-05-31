<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@productosapp.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('admin123'),
                'rol'      => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'demo@productosapp.com'],
            [
                'name'     => 'Usuario Demo',
                'password' => Hash::make('demo123'),
                'rol'      => 'user',
            ]
        );

        $this->command->info('✔ Usuarios creados: admin@productosapp.com / admin123');
    }
}
