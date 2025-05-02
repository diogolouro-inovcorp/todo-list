<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('uma tarefa pode ser criada', function () {
    $task = Task::create([
        'title' => 'Estudar Laravel e Vue',
        'description' => 'Aprender Eloquent e Tests',
        'priority' => 'alta',
        'due_date' => now()->addDays(3),
    ]);

    expect($task)->toBeInstanceOf(Task::class);
    expect($task->title)->toBe('Estudar Laravel e Vue');
    $this->assertDatabaseHas('tasks', ['title' => 'Estudar Laravel e Vue']);
});


