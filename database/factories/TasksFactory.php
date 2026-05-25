<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(3),
            'description'=>fake()->paragraph(),
            'status'=>fake()->randomElement([
                'Pendiente',
                'En proceso',
                'Completada'
            ]),

            'due_date'=>fake()->date(),
            'project_id'=> \App\Models\Project::inRandomOrder()->first()->id
        ];
    }
}
