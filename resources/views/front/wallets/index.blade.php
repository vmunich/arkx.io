@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallets</h2>
        <form method="POST" action="{{ route('wallets.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($wallets->count())
            @include('shared.tables.wallets', [
                'disbursements' => $wallets,
                'routeWallet' => 'wallet'
            ])

            <form method="POST" action="{{ route('wallets.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            @include('shared.tables.mobile.wallets', [
                'disbursements' => $wallets,
                'routeWallet' => 'wallet'
            ])

            {{ $wallets->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no wallet available at this time.
            </div>
        @endif
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
