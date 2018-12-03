@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Lost &amp; Found</h2>
        <form method="POST" action="{{ route('dashboard.lost-and-found.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($wallets->count())
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Balance</th>
                        <th>Earnings</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($wallets as $wallet)
                        <tr>
                            <td>
                                <a href="{{ route('wallet', $wallet) }}">{{ $wallet->address }}</a>
                            </td>
                            <td>
                                {{ $wallet->formatted_balance }} Ѧ
                            </td>
                            <td>
                                {{ $wallet->formatted_earnings }} Ѧ
                            </td>
                            <td class="text-right">
                                <a href="{{ route('dashboard.lost-and-found.claim', $wallet) }}" class="button-grey">Claim</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('dashboard.lost-and-found.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            <ul class="info-list sm:hidden">
                @foreach ($wallets as $wallet)
                    <li class="px-6">
                        <span>
                            Wallet {{ $wallet->address }}<br>
                            <span>{{ $wallet->is_verified ? $wallet->verified_at->toDayDateTimeString() : 'No' }}</span>
                        </span>
                        <span class="text-sm">{{ $wallet->formatted_earnings }} Ѧ</span>
                    </li>
                @endforeach
            </ul>

            {{ $wallets->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no wallets available at this time.
            </div>
        @endif
    </div>
@endsection
