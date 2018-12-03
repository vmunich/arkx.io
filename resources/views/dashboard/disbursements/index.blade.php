@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Disbursements</h2>
        <form method="POST" action="{{ route('dashboard.disbursements.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($disbursements->count())
            <span class="block p-6 pt-0 float-right hidden md:block">
                <a href="{{ route('dashboard.disbursements.export') }}" class="button-grey">Export as CSV</a>
            </span>

            @include('shared.tables.disbursements', [
                'disbursements' => $disbursements,
                'routeDisbursement' => 'dashboard.disbursement',
                'routeWallet' => 'dashboard.wallet'
            ])

            <form method="POST" action="{{ route('dashboard.disbursements.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            @include('shared.tables.mobile.disbursements', [
                'disbursements' => $disbursements,
                'routeDisbursement' => 'dashboard.disbursement',
                'routeWallet' => 'dashboard.wallet'
            ])

            {{ $disbursements->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no disbursements available at this time.
            </div>
        @endif
    </div>
@endsection
