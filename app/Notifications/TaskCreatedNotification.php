<?php

namespace App\Notifications;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TaskCreatedNotification extends Notification
{
    use Queueable;
    public Task $task;
    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', WebPushChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->task->title,
            'description' => $this->task->description,
            'priority' => ucfirst($this->task->priority),
            'due_date' => Carbon::parse($this->task->due_date)->format('d/m/Y'),
        ];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Nova tarefa criada')
            ->body("{$this->task->title} (prioridade: {$this->task->priority})")
            ->icon('/pwa-192x192.png')
            ->action('Ver tarefa', "/tasks/{$this->task->id}")
            ->data([
                'url' => "/tasks/{$this->task->id}",
            ]);
    }
}
