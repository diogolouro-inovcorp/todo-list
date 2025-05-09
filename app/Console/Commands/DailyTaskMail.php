<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyTaskSummary;

class DailyTaskMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-task-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resumo diário de tarefas pendentes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::with(['tasks' => function ($query) {
            $query->where('completed', false)
                ->whereDate('due_date', '<=', now());
        }])->get();

        foreach ($users as $user) {
            if ($user->tasks->isNotEmpty()) {
                Mail::to($user->email)->send(new DailyTaskSummary($user));
            }
        }

        $this->info('Resumo diário de tarefas enviado com sucesso!');
    }
}
