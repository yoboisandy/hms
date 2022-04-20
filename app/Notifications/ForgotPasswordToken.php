<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPasswordToken extends Notification
{
    use Queueable;

    private $forgotpassworddetails;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($forgotpassworddetails)
    {
        $this->forgotpassworddetails = $forgotpassworddetails;
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
        return (new MailMessage)
            ->greeting("Rise-n-Shine password reset")
            ->line('We heard that you lost your password. Sorry about that!')
            ->line('Enter the code below to change your password')
            ->line($this->forgotpassworddetails->token);
        // ->line('Thank you for using our application!');
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
