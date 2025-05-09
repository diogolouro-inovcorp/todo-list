<x-mail::message>
    # Olá {{ $user->name }}

    Estas são as suas tarefas pendentes até hoje:

    @foreach ($user->tasks as $task)
        - **{{ $task->title }}** – Vence: {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
    @endforeach

<x-mail::button :url="''">
    Aceder à aplicação
</x-mail::button>

    Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
