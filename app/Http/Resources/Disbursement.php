<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Disbursement extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'wallet'         => $this->wallet->address,
            'transaction_id' => $this->transaction_id,
            'amount'         => $this->amount,
            'purpose'        => $this->purpose,
        ];
    }
}
