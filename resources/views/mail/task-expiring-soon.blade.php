<x-mail::message>
    # Aviso: Tarefa Prestes a Expirar

    Olá {{ $user->name }},

    A tarefa **{{ $task->title }}** está prestes a expirar no dia **{{ \Illuminate\Support\Facades\Date::parse($task->due_date)->format('d/m/Y') }}**.

    <x-mail::button :url="url('/tasks/'.$task->id)">
        Ver Tarefa
    </x-mail::button>

    Por favor, certifique-se de que a tarefa seja concluída a tempo.

    Obrigado,<br>
    {{ config('app.name') }}
</x-mail::message>

