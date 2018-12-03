@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Report</h2>
    </div>

    <div class="page-transaction">
        <div class="flex">
            <div class="amount pl-6">
                <span>Amount</span>
                <h3>{{ $report->formatted_amount }} Ѧ</h3>
            </div>

            <div class="fee pl-6">
                <span>Fees</span>
                <h3>{{ $report->formatted_fees }} Ѧ</h3>
            </div>
        </div>

        <ul class="info-list">
            <li>
                <span>Date</span>
                <span>{{ $report->date->format('l jS \\of F Y') }}</span>
            </li>

            <li>
                <span>Disbursements</span>
                <span>{{ $report->count }}</span>
            </li>
        </ul>
    </div>

    {{-- @include('shared.pager', [
        'route' => 'report',
        'model' => $report
    ]) --}}

    @if($disbursements->count())
        <div class="flex justify-between px-6 py-6 pt-6">
            <h2>Disbursements</h2>
        </div>

        @include('shared.tables.disbursements', [
            'disbursements' => $disbursements,
            'routeDisbursement' => 'disbursement',
            'routeWallet' => 'wallet'
        ])

        @include('shared.tables.mobile.disbursements', [
            'disbursements' => $disbursements,
            'routeDisbursement' => 'disbursement',
            'routeWallet' => 'wallet'
        ])

        {{ $disbursements->links() }}
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
