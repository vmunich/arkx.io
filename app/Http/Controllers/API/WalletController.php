<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet as WalletResource;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $wallets = auth()->user()->wallets()->paginate();

        return WalletResource::collection($wallets);
    }

    /**
     * Display a listing of the resource filtered by the specified criteria.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(Request $request, WalletRepository $wallets): AnonymousResourceCollection
    {
        $wallets = $wallets
            ->searchByUser($request->search)
            ->paginate();

        return WalletResource::collection($wallets);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Wallet $wallet
     *
     * @return \App\Http\Resources\Wallet
     */
    public function show(Wallet $wallet): WalletResource
    {
        return new WalletResource($wallet);
    }
}
