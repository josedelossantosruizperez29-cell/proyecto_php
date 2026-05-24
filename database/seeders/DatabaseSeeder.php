<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Tasks;
use Database\Factories\TasksFactory;
use Database\Factories\ProjectFactory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
                User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        //creamos 10 proyectos y 30 tareas para ese proyecto
       Project::factory(10)->create();
       Tasks::factory(50)->create();



       
    }
}
