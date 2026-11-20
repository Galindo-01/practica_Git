<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' =>Cliente::inRandomOrder()->first()->id,
            'empleado_id'=>Empleado::inRandomOrder()->first()->id,
            'numero_pedido'=> 'PED' . $this->faker->numerify('####'),
            'fecha_pedido'=>$this->faker->date(),
            'fecha_entrega'=>$this->faker->date(),
            'total'=>$this->faker->randomFloat(2, 500, 90000),
            'estado'=>$this->faker->randomElement(['pendiente', 'completado', 'progreso']),
            'observaciones'=>$this->faker->sentence(10),
        ];
    }
}
