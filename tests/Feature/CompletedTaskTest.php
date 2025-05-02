<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('uma tarefa pode ser marcada como concluída', function () {
    $task = Task::create([
        'title' => 'Tarefa a concluir',
        'description' => 'Está quase...',
        'priority' => 'alta',
        'due_date' => now()->addDay(),
        'completed' => false,
    ]);

    $task->update(['completed' => true]);

    expect($task->fresh()->completed)->toBeTrue();
});
