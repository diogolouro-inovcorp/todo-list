<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        //Filtros pelo Estado, Prioridade ou Data
        if($request->has('status')){
            if ($request->status === 'pendente'){
                $query->where('completed', false);
            } elseif ($request->status === 'concluida') {
                $query->where('completed', true);
            }
        }
        if ($request->has('priority')){
            $query->where('priority', $request->priority);
        }
        if ($request->has('due_date')){
            $query->where('due_date', $request->due_date);
        }

        return response()->json($query->orderBy('due_date')->get());
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullable|string',
           'priority' => 'in:alta,media,baixa',
           'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }


    public function show(Task $task)
    {
        return response()->json($task);
    }


    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'in:alta,média,baixa',
            'due_date' => 'nullable|date',
            'completed' => 'boolean',
        ]);

        $task->update($validated);

        return response()->json($task);
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Tarefa eliminada com sucesso.']);
    }

}
