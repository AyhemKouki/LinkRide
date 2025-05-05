<?php

// app/Notifications/ReservationRejected.php
namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationRejected extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    /**
     * Create a new notification instance.
     *
     * @param Reservation $reservation
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            ->subject('⚠️ Your Ride Reservation Could Not Be Confirmed')
            ->greeting('Hello ' . $this->reservation->user->name . ',')
            ->line('We regret to inform you that your reservation request for the ride from ' .
                $this->reservation->ride->origin . ' to ' .
                $this->reservation->ride->destination . ' could not be confirmed.')
            ->line('The driver has declined your reservation request.')
            ->line('Details of your request:')
            ->line('- Departure: ' . $this->reservation->ride->departure_time->format('l, F j, Y \a\t g:i A'))
            ->line('- Seats Requested: ' . $this->reservation->seats)
            ->line('We encourage you to search for other available rides that match your travel plans.')
            ->action('Search for Other Rides', route('ride.search'))
            ->line('Thank you for using our ride sharing service!');
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
            'message' => 'Your reservation for ride from ' .
                $this->reservation->ride->origin . ' to ' .
                $this->reservation->ride->destination . ' has been declined.',
            'reservation_id' => $this->reservation->id,
            'ride_id' => $this->reservation->ride_id,
            'driver_id' => $this->reservation->ride->driver_id,
            'type' => 'reservation_rejected'
        ];
    }
}
