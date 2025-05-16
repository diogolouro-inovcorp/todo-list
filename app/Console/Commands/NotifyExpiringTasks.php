<?php

namespace App\Console\Commands;

use App\Mail\TaskExpiringSoonMail;
use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\TaskExpiringSoon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica utilizadores sobre tarefas que expiram amanhã';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $tasks = Task::whereDate('due_date', $tomorrow)->get();

        foreach ($tasks as $task) {
            if ($task->user) {
                // Notificação (badge do sino)
                $task->user->notify(new TaskExpiringSoon($task));

                // Email
                Mail::to($task->user->email)->send(new TaskExpiringSoonMail($task));
            }
        }

        $this->info("Notificações enviadas para tarefas com prazo até amanhã.");
    }
}
