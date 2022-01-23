<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    protected $author;
    protected $ticket;
    protected $condominium;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($author,$ticket,$condominium)
    {
        $this->author = $author;
        $this->ticket = $ticket;
        $this->condominium = $condominium;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
        $url = route("login");

        return (new MailMessage)
            ->line('A new Ticket has been created by '. $this->author)
            ->line('Condominium: '. $this->condominium->name)
            ->line($this->ticket->title)
            ->line($this->ticket->desc)
            ->action('Manage', url(route("ticket",$this->ticket->id)));
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
