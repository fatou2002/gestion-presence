<?php

namespace App\Notifications;


use App\Models\Presence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class PresenceEnregistree extends Notification
{
    use Queueable;

    public $presence;
    public function __construct(Presence $presence)
    {
        $this->presence = $presence;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle présence enregistrée')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Votre présence du ' . $this->presence->date . ' à ' . $this->presence->heure_arrivee . ' a été enregistrée avec succès.')
            ->line('Merci pour votre ponctualité.')
            ->salutation('À bientôt !');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
