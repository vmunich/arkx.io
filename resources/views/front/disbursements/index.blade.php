@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Disbursements</h2>
        <form method="POST" action="{{ route('disbursements.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($disbursements->count())
            @include('shared.tables.disbursements', [
                'disbursements' => $disbursements,
                'routeDisbursement' => 'disbursement',
                'routeWallet' => 'wallet'
            ])

            <form method="POST" action="{{ route('disbursements.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            @include('shared.tables.mobile.disbursements', [
                'disbursements' => $disbursements,
                'routeDisbursement' => 'disbursement',
                'routeWallet' => 'wallet'
            ])

            {{ $disbursements->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no disbursements available at this time.
            </div>
        @endif
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
