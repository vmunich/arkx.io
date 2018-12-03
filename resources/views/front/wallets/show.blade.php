@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallet</h2>
    </div>

    @include('shared.wallets.info')

    @if($wallet->disbursements()->count())
        <div class="flex justify-between px-6 py-6 pt-6">
            <h2>Last 10 Disbursements</h2>
        </div>

        @include('shared.tables.disbursements', [
            'disbursements' => $wallet->disbursements->take(10),
            'routeDisbursement' => 'disbursement',
            'routeWallet' => 'wallet'
        ])

        @include('shared.tables.mobile.disbursements', [
            'disbursements' => $wallet->disbursements->take(10),
            'routeDisbursement' => 'disbursement',
            'routeWallet' => 'wallet'
        ])
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.wallet')
@endsection
