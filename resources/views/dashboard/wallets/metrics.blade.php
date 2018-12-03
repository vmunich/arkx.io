@extends('layouts.dashboard')

@section('content')
    <div class="p-6 metrics-header">
        <h2>Metrics for {{ $wallet->address }}</h2>

        <div class="mt-6">
            <ul class="tabs">
                {{-- <li>
                    <a href="{{ route('dashboard.wallet.metrics', [$wallet]) }}" class="{{ $type === 'day' ? 'button-active' : '' }}">Day</a>
                </li> --}}
                <li>
                    <a href="{{ route('dashboard.wallet.metrics', [$wallet, 'week']) }}" class="{{ $type === 'week' ? 'button-active' : '' }}">Week</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.wallet.metrics', [$wallet, 'month']) }}" class="{{ $type === 'month' ? 'button-active' : '' }}">Month</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.wallet.metrics', [$wallet, 'quarter']) }}" class="{{ $type === 'quarter' ? 'button-active' : '' }}">Quarter</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.wallet.metrics', [$wallet, 'year']) }}" class="{{ $type === 'year' ? 'button-active' : '' }}">Year</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="transactions p-6 pt-0">
        <div class="canvas-wrapper">
            <chart-metrics
                class="w-full"
                :labels='@json($labels)'
                :data='@json($data)'
                :height="500"
                :width="1100" />
        </div>
    </div>
@endsection
