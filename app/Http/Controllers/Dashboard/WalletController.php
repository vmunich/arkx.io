<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\WalletsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $wallets = auth()->user()->wallets()->simplePaginate();

        return view('dashboard.wallets.index', compact('wallets'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request, WalletRepository $wallets): View
    {
        $wallets = $wallets
            ->searchByUser($request->search)
            ->simplePaginate();

        return view('dashboard.wallets.index', compact('wallets'));
    }

    /**
     * Display the specified wallet.
     *
     * @param \App\Models\Wallet $wallet
     *
     * @return \Illuminate\View\View
     */
    public function show(Wallet $wallet): View
    {
        $this->authorize('view', $wallet);

        return view('dashboard.wallets.show', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet       $wallet
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Wallet $wallet): RedirectResponse
    {
        $this->authorize('update', $wallet);

        $request->validate([
            'frequency' => [
                'required',
                Rule::in(['daily', 'weekly', 'monthly', 'quarterly', 'yearly']),
            ],
            'percentage' => [
                'required',
                'integer',
                'max:'.config('ark.share.percentage'),
            ],
        ]);

        $wallet->extra_attributes->set('settings.share.frequency', $request->get('frequency'));
        $wallet->extra_attributes->set('settings.share.percentage', $request->get('percentage'));
        $wallet->save();

        alert()->info('The disbursement settings are being updated! The changes should be reflected in a moment.');

        return back();
    }

    /**
     * Show the metrics dashboard for the given resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet       $wallet
     * @param string                   $type
     *
     * @return \Illuminate\View\View
     */
    public function metrics(Request $request, Wallet $wallet, string $type = 'week'): View
    {
        $this->authorize('view', $wallet);

        $chart = 'App\\Metrics\\Charts\\'.title_case($type);

        $disbursements = $chart::create($wallet->disbursements());

        return view('dashboard.wallets.metrics', compact('wallet', 'type') + [
            'labels' => $disbursements->keys(),
            'data'   => $disbursements->values(),
        ]);
    }

    /**
     * Export the specified resources.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Exports\WalletsExport
     */
    public function export(Request $request): WalletsExport
    {
        return new WalletsExport($request->user());
    }
}
