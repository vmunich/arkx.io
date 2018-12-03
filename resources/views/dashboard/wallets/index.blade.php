@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallets</h2>
        <form method="POST" action="{{ route('dashboard.wallets.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($wallets->count())
            <span class="block p-6 pt-0 float-right hidden md:block">
                <a href="{{ route('dashboard.wallets.export') }}" class="button-grey">Export as CSV</a>
            </span>

            @include('shared.tables.wallets', [
                'disbursements' => $wallets,
                'routeWallet' => 'dashboard.wallet'
            ])

            <form method="POST" action="{{ route('dashboard.wallets.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            @include('shared.tables.mobile.wallets', [
                'disbursements' => $wallets,
                'routeWallet' => 'dashboard.wallet'
            ])

            {{ $wallets->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no wallets available at this time. Go ahead and <a href="{{ route('dashboard.lost-and-found') }}">claim your wallet</a> to get started.
            </div>
        @endif
    </div>
@endsection
