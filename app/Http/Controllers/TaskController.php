<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        //Filtros pelo Estado
        if($request->has('status')){
            if ($request->status === 'pendente'){
                $query->where('completed', false);
            } elseif ($request->status === 'concluida') {
                $query->where('completed', true);
            }
        }
        //Filtro por Prioridade
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        //Filtro por Data
        if ($request->filled('due_date')) {
            $query->where('due_date', $request->due_date);
        }


        //Ordenação por prioridade e data
        if ($request->has('sort_by')) {
            if ($request->sort_by === 'priority') {
                $query->orderByRaw("FIELD(priority, 'alta', 'media', 'baixa')");
            } else {
                $query->orderBy($request->sort_by);
            }
        } else {
            $query->orderBy('due_date');
        }

        //Obter resultados
        $tasks = $query->get();

        //Contador para o Dashboard
        $totalTasks = $tasks->count();
        $pendingTasks = $tasks->where('completed', false)->count();
        $completedTasks = $tasks->where('completed', true)->count();

        if ($request->wantsJson()) {
            return response()->json($tasks);
        }

        return Inertia::render('Dashboard', [
            'tasks' => $tasks,
            'taskStats' => [
                'total' => $totalTasks,
                'pending' => $pendingTasks,
                'completed' => $completedTasks,
            ],
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'in:alta,media,baixa',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->back()->with('success', 'Tarefa criada com sucesso!');
//        return response()->json(['message' => __('messages.task_created')]);
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
            'priority' => 'in:alta,media,baixa',
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
