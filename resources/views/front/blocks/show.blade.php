@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallet</h2>
    </div>

    <div class="page-transaction">
        <div class="amount pl-6">
            <span>Earnings</span>
            <h3>{{ $block->formatted_reward }} Ѧ</h3>
        </div>

        <ul class="info-list">
            <li>
                <span>ID</span>
                <span>
                    <a href="https://explorer.arkx.io/#/block/{{ $block->block_id }}" target="_blank">
                        {{ $block->block_id }}
                    </a>
                </span>
            </li>

            <li>
                <span>Height</span>
                <span>{{ number_format($block->height) }}</span>
            </li>

            <li>
                <span>Date</span>
                <span>{{ $block->forged_at->toDayDateTimeString() }}</span>
            </li>
        </ul>
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
