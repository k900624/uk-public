<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Users\User;
 
class NewMessage extends Notification implements ShouldQueue
{
    use Queueable;
    public $notifyData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notifyData)
    {
        $this->notifyData = $notifyData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return $notifiable->prefers_sms ? ['nexmo'] : ['mail'];
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Уведомление от сервиса Управляющей Компании “Ламбери”')
                    ->greeting('Здравствуйте %s!', $notifiable->name)
                    ->line($this->notifyData['body']);
    }

    public function toDatabase($notifiable)
    {
        return [
           'data' => $this->notifyData['body']
        ];
    }

    /**
     * Получить представления уведомления в виде Nexmo / SMS.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
      return (new NexmoMessage)
                ->content('Содержимое вашего SMS сообщения')
                ->from('15554443333');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
