<?php

namespace App\Http\ViewComposers\Wallet;

use App\Models\Wallet;
use App\Services\Calculator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OverviewComposer
{
    /**
     * The profit share calculator.
     *
     * @var \App\Services\Calculator
     */
    private $calculator;

    /**
     * The active wallet.
     *
     * @var \App\Models\User
     */
    private $wallet;

    /**
     * The active wallets balance.
     *
     * @var int
     */
    private $balance;

    /**
     * Create a new composer instance.
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
        $this->wallet = request()->route('wallet');
        $this->balance = $this->wallet->balance;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $chart = $this->getDisbursementChart();
        $view->with('chartLabels', $chart->keys());
        $view->with('chartData', $chart->values());

        $view->with('dailyRevenue', $this->getDailyRevenue());
        $view->with('weeklyRevenue', $this->getWeeklyRevenue());
        $view->with('monthlyRevenue', $this->getMonthlyRevenue());
        $view->with('quarterlyRevenue', $this->getQuarterlyRevenue());
        $view->with('yearlyRevenue', $this->getYearlyRevenue());

        $view->with('voteWeight', $this->getVoteWeight());

        $gainOrLoss = $this->getGainOrLoss();
        $view->with('disbursementGain', $gainOrLoss['gain']);
        $view->with('disbursementDifference', $gainOrLoss['difference']);
    }

    /**
     * Get the daily revenue.
     *
     * @return string
     */
    private function getDailyRevenue(): string
    {
        return number_format($this->calculator->perDay($this->balance)->toHuman(), 4);
    }

    /**
     * Get the weekly revenue.
     *
     * @return string
     */
    private function getWeeklyRevenue(): string
    {
        return number_format($this->calculator->perWeek($this->balance)->toHuman(), 4);
    }

    /**
     * Get the monthly revenue.
     *
     * @return string
     */
    private function getMonthlyRevenue(): string
    {
        return number_format($this->calculator->perMonth($this->balance)->toHuman(), 4);
    }

    /**
     * Get the quarterly revenue.
     *
     * @return string
     */
    private function getQuarterlyRevenue(): string
    {
        return number_format($this->calculator->perQuarter($this->balance)->toHuman(), 4);
    }

    /**
     * Get the yearly revenue.
     *
     * @return string
     */
    private function getYearlyRevenue(): string
    {
        return number_format($this->calculator->perYear($this->balance)->toHuman(), 4);
    }

    /**
     * Get the vote weight.
     *
     * @return string
     */
    private function getVoteWeight(): float
    {
        return number_format($this->calculator->voteWeight($this->balance)->toFloat(), 4);
    }

    /**
     * Get the labels and data for ChartJS.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getDisbursementChart(): Collection
    {
        // range...
        $start = Carbon::now()->subWeek()->startOfDay();
        $end = Carbon::now()->subDay()->endOfDay();

        // records...
        $disbursements = $this
            ->wallet
            ->disbursements()
            ->whereBetween('disbursements.signed_at', [$start, $end])
            ->get(['amount', 'signed_at']);

        // sort...
        return $disbursements->mapWithKeys(function ($disbursement) {
            return [$disbursement->signed_at->format('j') => $disbursement->amount / 1e8];
        })->sortKeys();
    }

    /**
     * Get if the wallet made gains or losses.
     *
     * @return array
     */
    private function getGainOrLoss(): array
    {
        // records...
        $disbursements = $this->wallet->disbursements()->latest()->take(2)->get();

        if (2 !== $disbursements->count()) {
            return [
                'gain'       => true,
                'difference' => 0,
            ];
        }

        // amounts...
        $previous = $disbursements->last()->amount;
        $current = $this->wallet->earnings; // $disbursements->first()->amount;

        if (!$current) {
            return [
                'gain'       => true,
                'difference' => 0,
            ];
        }

        // percentage difference
        $difference = (1 - $previous / $current) * 100;

        return [
            'gain'       => $difference > 0,
            'difference' => number_format($difference, 4),
        ];
    }
}
