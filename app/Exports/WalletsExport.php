<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WalletsExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    /**
     * The excel sheet filename.
     *
     * @var string
     */
    private $fileName = 'wallets.xlsx';

    /**
     * Get the data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return auth()->user()->wallets()->get(['address', 'balance'])->map(function ($wallet) {
            $wallet->balance = $wallet->balance / 1e8;

            return $wallet;
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
            'Address',
            'Balance',
        ];
    }
}
