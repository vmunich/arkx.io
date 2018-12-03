<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Wallet;
use ArkEcosystem\Crypto\Utils\Message;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class LostAndFoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $wallets = Wallet::eligible()->lost()->simplePaginate();

        return view('dashboard.lost-and-found', compact('wallets'));
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request): View
    {
        $wallets = Wallet::lost()->where(function ($search) use ($request) {
            $search->where('address', 'like', '%'.$request->search.'%');
        })->simplePaginate();

        return view('dashboard.lost-and-found', compact('wallets'));
    }

    /**
     * Handle a claim of the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet       $wallet
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function claim(Request $request, Wallet $wallet): RedirectResponse
    {
        if ($wallet->is_pending || $wallet->is_claimed) {
            return back();
        }

        $wallet->forceFill([
            'user_id'            => $request->user()->id,
            'claimed_at'         => Carbon::now(),
            'verification_token' => Uuid::uuid4(),
        ])->save();

        return redirect()->route('dashboard.wallet', $wallet);
    }

    /**
     * Verify the claim of the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet       $wallet
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyClaim(Request $request, Wallet $wallet): RedirectResponse
    {
        $data = $request->validate([
            'message' => ['required', 'json'],
        ]);

        $message = Message::new($data['message']);

        if (!$message->verify()) {
            return $this->resetWallet($wallet);
        }

        if ($message->publicKey !== $wallet->public_key) {
            return $this->resetWallet($wallet);
        }

        if ($message->message !== $wallet->verification_token) {
            return $this->resetWallet($wallet);
        }

        $wallet->activate();

        alert()->info('The wallet has been verified.');

        return redirect()->route('dashboard.wallet', $wallet);
    }

    /**
     * Reset the specified resource.
     *
     * @param \App\Models\Wallet $wallet
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function resetWallet(Wallet $wallet): RedirectResponse
    {
        $wallet->reset();

        alert()->error('The signed message could not be verified! The wallet has been reset.');

        return redirect()->route('dashboard.lost-and-found');
    }
}
