<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            [
                'title' => 'Estudar Laravel',
                'description' => 'Rever Eloquent, migrations e seeders',
                'priority' => 'alta',
                'due_date' => Carbon::now()->addDays(2),
                'completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fazer backup do projeto',
                'description' => 'Guardar cópia no GitHub',
                'priority' => 'media',
                'due_date' => Carbon::now()->addDays(5),
                'completed' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Refatorar componentes Vue',
                'description' => null,
                'priority' => 'baixa',
                'due_date' => Carbon::now()->addDays(7),
                'completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
