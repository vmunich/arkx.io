@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Disbursement</h2>
    </div>

    @include('shared.disbursements.info')

    @include('shared.pager', [
        'route' => 'dashboard.disbursement',
        'model' => $disbursement
    ])
@endsection
