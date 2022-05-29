<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmed extends Notification
{
    use Queueable;
    private $book;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->greeting('Hello ' . $this->book->user->name)
            ->line('Your Booking for a ' . $this->book->roomtype->type_name . ' has been confirmed and you\'re assigned Room No.' . $this->book->room->room_no)
            ->action('View Bookings', url('/'))
            ->line('Thank you for booking a room!');
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
            'message' => ucwords('Your Booking Request for Room No. ' . $this->book->room->room_no  . " of type: " . $this->book->roomtype->type_name .  ' has been confirmed'),
            'url-text' => 'View Bookings',
            'url' => '/mybookings',
            'theme' => 'success'
        ];
    }
}
