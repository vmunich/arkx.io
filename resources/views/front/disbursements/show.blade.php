@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Disbursement</h2>
    </div>

    @include('shared.disbursements.info')

    @include('shared.pager', [
        'route' => 'disbursement',
        'model' => $disbursement
    ])
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
