<?php

namespace App\Events;

use App\Models\Disbursement;
use Illuminate\Queue\SerializesModels;

class DisbursementCreated
{
    use SerializesModels;

    public $disbursement;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Disbursement $disbursement
     *
     * @return void
     */
    public function __construct(Disbursement $disbursement)
    {
        $this->disbursement = $disbursement;
    }
}
