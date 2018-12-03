<?php

namespace App\Notifications;

use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WalletVerified extends Notification
{
    use Queueable;

    /**
     * The verified wallet.
     *
     * @var \App\Models\Wallet
     */
    public $wallet;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Wallet $wallet
     */
    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
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
        return [
            'message' => "Your wallet {$this->wallet->address} has been verified.",
        ];
    }
}
