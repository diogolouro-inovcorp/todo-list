<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('uma tarefa pode ser eliminada', function () {
    $task = Task::create([
        'title' => 'Tarefa a eliminar',
        'description' => 'Não vai durar muito...',
        'priority' => 'media',
        'due_date' => now()->addDays(2),
    ]);

    $task->delete();

    $this->assertDatabaseMissing('tasks', ['title' => 'Tarefa a eliminar']);
});

