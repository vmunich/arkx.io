<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DisbursementsExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    /**
     * The excel sheet filename.
     *
     * @var string
     */
    private $fileName = 'disbursements.xlsx';

    /**
     * Get the data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return auth()->user()->disbursements()->get([
            'transaction_id', 'amount', 'wallet_id', 'signed_at', 'purpose',
        ])->map(function ($disbursement) {
            $disbursement->amount = $disbursement->amount / 1e8;

            return $disbursement;
        });
    }

    /**
     * Get the headings for the exported data.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Transaction ID',
            'Amount',
            'Recipient',
            'Date',
            'Purpose',
        ];
    }
}
