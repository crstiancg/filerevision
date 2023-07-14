<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Curso '.fake()->colorName(),
            'estado' => 'activo',
            'descripcion' => fake()->text(),
            'user_id' => fake()->numberBetween(1,3),
            'carrera_id'=> fake()->numberBetween(1,25),
        ];
    }
}
