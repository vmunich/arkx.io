<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
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
        $wallets = Wallet::eligible()
            ->orderBy('balance', 'DESC')
            ->simplePaginate();

        return view('front.wallets.index', compact('wallets'));
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
        try {
            $wallets = $wallets
                ->searchAll($request->search)
                ->eligible()
                ->simplePaginate();

            return view('front.wallets.index', compact('wallets'));
        } catch (\Exception $e) {
            alert()->info("We couldn't find any wallets for the specified term.");

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Wallet $wallet
     *
     * @return \Illuminate\View\View
     */
    public function show(Wallet $wallet): View
    {
        return view('front.wallets.show', compact('wallet'));
    }
}
