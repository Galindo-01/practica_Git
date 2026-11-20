<?php

namespace Database\Factories;

use App\Models\Bodega;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bodega>
 */
class BodegaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> $this->faker->word(),
            'descripion'=>$this->faker->sentence(2),
            'codigo' => 'BOD-' . $this->faker->numerify(),
        ];
    }
}
