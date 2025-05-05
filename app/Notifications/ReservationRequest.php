<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationRequest extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Ride Request')
            ->line('You have a new ride request from '.$this->reservation->user->name)
            ->action('View Request', url('/reservations'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'New ride request from '.$this->reservation->user->name,
            'reservation_id' => $this->reservation->id,
            'ride_id' => $this->reservation->ride_id,
            'user_id' => $this->reservation->user_id
        ];
    }
}
