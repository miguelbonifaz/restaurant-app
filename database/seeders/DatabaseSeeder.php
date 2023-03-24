<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(['email' => 'bonifaz@gmail.com']);

        Menu::factory()->createMany([
            [
                'name' => 'Ensalada César', 'description' => 'Una deliciosa ensalada de lechuga, pollo asado, queso parmesano y croutones, todo ello aliñado con una salsa cremosa de anchoas.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Tacos de pescado', 'description' => 'Una delicia mexicana, los tacos de pescado son tortillas rellenas de pescado frito, cebolla, cilantro y una salsa picante.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Spaghetti alla carbonara', 'description' => 'Una pasta cremosa y deliciosa, hecha con panceta, queso parmesano, huevo y pimienta negra.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Sopa de pollo', 'description' => 'Una sopa reconfortante hecha con pollo, verduras, fideos y hierbas aromáticas, perfecta para los días fríos.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Pizza Margherita', 'description' => 'Una pizza clásica italiana, con una base de tomate, mozzarella fresca y hojas de albahaca.', 'quantity' => rand(1, 8)
            ],
            [
                'name' =>  'Bistec a la parrilla', 'description' => 'Un filete de carne a la parrilla, sazonado con sal y pimienta y servido con una guarnición de patatas fritas.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Sushi', 'description' => 'Una deliciosa comida japonesa hecha con arroz y pescado crudo, enrollada en una hoja de algas nori.', 'quantity' => rand(1, 8),
            ],
            [
                'name' => 'Pollo a la naranja', 'description' => 'Un plato chino que combina pollo frito en una salsa dulce y picante de naranja, servido con arroz blanco.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Cazuela de pollo', 'description' => 'Una mezcla de pollo, arroz, verduras y caldo, todo horneado junto para crear un plato sabroso y reconfortante.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Hot Dogs', 'description' => 'Un clásico americano, los hot dogs son salchichas calientes en un panecillo, servido con ketchup, mostaza y/o cebolla.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Paella', 'description' => 'Una deliciosa comida española, hecha con arroz, mariscos, pollo y chorizo, todo ello cocido junto en un caldo sabroso.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Costillas BBQ', 'description' => 'Costillas de cerdo cocidas lentamente y luego cubiertas con una salsa barbacoa dulce y picante.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Poutine', 'description' => 'Un plato canadiense que consiste en patatas fritas cubiertas con queso y salsa de carne.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Falafel', 'description' => 'Una comida vegetariana del Medio Oriente, hecha con garbanzos, hierbas y especias, y servida en un pan de pita con salsa tzatziki.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Pollo al curry', 'description' => 'Un plato de la cocina india, hecho con pollo, especias y una salsa cremosa de curry, servido con arroz basmati.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Arroz con frijoles', 'description' => 'Un plato latinoamericano, hecho con arroz y frijoles negros, con cebolla, ajo y especias.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Burritos', 'description' => 'Un plato mexicano, hecho con una tortilla de harina rellena de carne, arroz, frijoles, queso y salsa.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Sopa de miso', 'description' => 'Una sopa japonesa hecha con caldo de dashi, pasta de soja, tofu y algas.', 'quantity' => rand(1, 8)
            ],
            [
                'name' => 'Churrasco', 'description' => 'Un plato sudamericano, hecho con carne asada, servido con arroz, frijoles y ensalada.', 'quantity' => rand(1, 8)
            ]
        ]);
    }
}
