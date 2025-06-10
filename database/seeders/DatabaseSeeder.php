<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Zona;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'telefono' => '1234-5678',
            'permiso' => '0'
        ]);

        User::factory()->create([
            'name' => 'Empleado',
            'email' => 'empleado@empleado.com',
            'password' => bcrypt('12345678'),
            'telefono' => '1234-5678',
            'permiso' => '1'
        ]);

        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@cliente.com',
            'password' => bcrypt('12345678'),
            'telefono' => '1234-5678',
            'permiso' => '2'
        ]);

        Categoria::factory()->create([
            'nombre' => 'Postre',
        ]);

        Categoria::factory()->create([
            'nombre' => 'Bebida',
        ]);

        Zona::factory()->create([
            'nombre' => 'VIP',
            'numero_personas' => 5,
            'costo' => 5
        ]);

        Zona::factory()->create([
            'nombre' => 'Regular',
            'numero_personas' => 10,
            'costo' => 3
        ]);

        Producto::factory(4)->create([
            'nombre' => fake()->firstNameFemale(),
            'categoria_id' => 1,
            'precio' => 5,
            'descripcion' => fake()->paragraph(3),
            'imagen' => 'images/producto-placeholder.jpg'
        ]);

        Producto::factory(4)->create([
            'nombre' => fake()->firstNameFemale(),
            'categoria_id' => 2,
            'precio' => 3,
            'descripcion' => fake()->paragraph(3),
            'imagen' => 'images/producto-placeholder.jpg'
        ]);
    }
}
