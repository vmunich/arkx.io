<?php

namespace App\Listeners;

use App\Events\DisbursementCreated;
use App\Notifications\DisbursementSent;

class SendDisbursementNotification
{
    /**
     * Handle the event.
     *
     * @param DisbursementCreated $event
     *
     * @return void
     */
    public function handle(DisbursementCreated $event)
    {
        $disbursement = $event->disbursement;
        $wallet = $event->disbursement->wallet;

        $wallet->user->notify(new DisbursementSent($disbursement));
    }
}
