<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id'=>Categoria::inRandomOrder()->first()->id,
            'codigo'=> 'P-' . $this->faker->unique()->numerify('####'),
            'nombre'=>$this->faker->word(),
            'descripcion'=>$this->faker->sentence(),
            'precio'=>$this->faker->randomFloat(2, 10, 3500),
            'stock'=>$this->faker->numberBetween(0, 100),
            'estado'=>$this->faker->randomElement(['activo', 'inactivo']),

        ];
    }
}
