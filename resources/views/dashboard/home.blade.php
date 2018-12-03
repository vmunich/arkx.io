@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallets</h2>
    </div>

    @if($wallets->count())
        @include('shared.tables.wallets', [
            'disbursements' => $wallets,
            'routeWallet' => 'dashboard.wallet'
        ])

        @include('shared.tables.mobile.wallets', [
            'disbursements' => $wallets,
            'routeWallet' => 'dashboard.wallet'
        ])
    @else
        <div class="alert-warning mx-6" role="alert">
            Sorry, there are no wallets available at this time. Go ahead and <a href="{{ route('dashboard.lost-and-found') }}">claim your wallet</a> to get started.
        </div>
    @endif

    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Last 10 Disbursements</h2>
    </div>

    @if($disbursements->count())
        @include('shared.tables.disbursements', [
            'disbursements' => $disbursements->take(10),
            'routeDisbursement' => 'dashboard.disbursement',
            'routeWallet' => 'dashboard.wallet'
        ])

        @include('shared.tables.mobile.disbursements', [
            'disbursements' => $disbursements->take(10),
            'routeDisbursement' => 'dashboard.disbursement',
            'routeWallet' => 'dashboard.wallet'
        ])
    @else
        <div class="alert-warning mx-6" role="alert">
            Sorry, there are no disbursements available at this time.
        </div>
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.dashboard')
@endsection
