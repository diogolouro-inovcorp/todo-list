<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('uma tarefa pode ser atualizada', function () {
    $task = Task::create([
        'title' => 'Tarefa original',
        'description' => 'Descrição original',
        'priority' => 'baixa',
        'due_date' => now()->addDay(),
    ]);

    $task->update([
        'title' => 'Tarefa editada',
        'priority' => 'alta',
    ]);

    expect($task->fresh()->title)->toBe('Tarefa editada');
    expect($task->priority)->toBe('alta');
});

