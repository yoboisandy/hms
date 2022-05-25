<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HallBookingRequestSent extends Notification
{
    use Queueable;
    private $bookingdetails;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bookingdetails)
    {
        $this->bookingdetails = $bookingdetails;
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
            ->greeting('Hello ' . auth()->user()->name)
            ->line($this->bookingdetails['body'])
            ->action('View Bookings', $this->bookingdetails['url'])
            ->line($this->bookingdetails['footer']);
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
