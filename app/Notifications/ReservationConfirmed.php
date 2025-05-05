<?php

// app/Notifications/ReservationConfirmed.php
namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationConfirmed extends Notification implements ShouldQueue
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
            ->subject('🎉 Your Ride Reservation Has Been Confirmed!')
            ->greeting('Hello ' . $this->reservation->user->name . ',')
            ->line('Your reservation request for the ride from ' .
                $this->reservation->ride->origin . ' to ' .
                $this->reservation->ride->destination . ' has been confirmed by the driver.')
            ->line('Details:')
            ->line('- Departure: ' . $this->reservation->ride->departure_time->format('l, F j, Y \a\t g:i A'))
            ->line('- Seats Booked: ' . $this->reservation->seats)
            ->line('- Total Price: $' . number_format($this->reservation->seats * $this->reservation->ride->price_per_seat, 2))
            ->action('View Ride Details', route('ride.show', $this->reservation->ride_id))
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
                $this->reservation->ride->destination . ' has been confirmed.',
            'reservation_id' => $this->reservation->id,
            'ride_id' => $this->reservation->ride_id,
            'driver_id' => $this->reservation->ride->driver_id,
            'type' => 'reservation_confirmed'
        ];
    }
}
