<?php

namespace App\Console\Commands\Generate;

use App\Models\Disbursement;
use App\Models\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class Reports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:generate:reports';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Disbursement::get(['amount', 'signed_at'])->groupBy(function ($disbursement) {
            return Carbon::parse($disbursement->signed_at)->format('d-m-Y');
        })->map(function ($value, $key) {
            return [
                'date'   => Carbon::parse($key),
                'count'  => $value->count(),
                'amount' => $value->sum('amount'),
                'fees'   => (0.1 * $value->count()) * 1e8,
            ];
        })->each(function ($report) {
            $this->line('Generating Report: <info>'.$report['date'].'</info>');

            Report::updateOrCreate(['date' => $report['date']], $report);
        });
    }
}
