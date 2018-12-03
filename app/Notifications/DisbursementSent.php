<?php

namespace App\Notifications;

use App\Models\Disbursement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DisbursementSent extends Notification
{
    use Queueable;

    /**
     * The recently created disbursement.
     *
     * @var \App\Models\Disbursement
     */
    public $disbursement;

    /**
     * Create a new notification instance.
     */
    public function __construct(Disbursement $disbursement)
    {
        $this->disbursement = $disbursement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        $link = route('disbursement', $this->disbursement);

        return [
            'message' => "View your disbursement for {$this->disbursement->signed_at->toFormattedDateString()} at [$link]($link).",
        ];
    }
}
