<?php

namespace App\Http\ViewComposers\App;

use App\Models\Disbursement;
use App\Models\Wallet;
use Illuminate\View\View;

class OverviewComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $view->with('countVoters', Wallet::notBanned()->count());
        $view->with('countDisbursements', Disbursement::count());

        $view->with('totalEarnings', format_arktoshi(Wallet::sum('earnings'), 8));
        $view->with('totalPaid', format_arktoshi(Disbursement::sum('amount'), 8));
        $view->with('totalVotes', format_arktoshi(Wallet::sum('balance'), 8));
    }
}
