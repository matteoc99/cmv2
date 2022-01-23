<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteUserNotification extends Notification
{
    use Queueable;

    protected $password;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password,$email)
    {
        $this->password = $password;
        $this->email = $email;
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


    public function toMail($notifiable)
    {

        $url = route("login");

        return (new MailMessage)
            ->line('You have been Invited to the Condominium Manager Ticket System')
            ->line('Username: '. $this->email)
            ->line('Password: '. $this->password)
            ->action('Join Now', url($url));
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
