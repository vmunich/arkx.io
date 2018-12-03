@extends('layouts.dashboard')

@section('content')
    @if (!$wallet->claimHasExpired())
        <div class="p-6">
            <div class="alert-warning mb-6">
                Here is your verification code: <strong>{{ $wallet->verification_token }}</strong>. <em>It will expire at {{ $wallet->claimed_at->addMinutes(5)->toDayDateTimeString() }}.</em>

                <strong class="block mt-4">Desktop Wallet</strong>
                <ol class="mt-5">
                    <li class="pb-2">Copy the verification code and sign it using the <a href="https://github.com/ArkEcosystem/ark-desktop">ARK Desktop Wallet</a>.</li>
                    <li class="pb-2">Copy the JSON that you receive after signing the message.</li>
                    <li>Paste the JSON into the textarea below and hit verify.</li>
                </ol>

                <strong class="block mt-4">Ledger</strong>
                <ol class="mt-5">
                    <li class="pb-2">Send a transaction of <strong>0.00000001 Ѧ</strong> to <strong>{{ $wallet->address }}</strong> using your verification code as SmartBridge.</li>
                    <li>Contact support with the link to your transaction on <a href="https://explorer.arkx.io">https://explorer.arkx.io</a>.</li>
                </ol>
            </div>

            <form method="POST" action="{{ route('dashboard.lost-and-found.claim', $wallet) }}">
                @csrf

                <label>JSON Message</label>
                <textarea name="message" class="mb-3" required autofocus>
                    {{ old('message') }}
                </textarea>

                <button class="button-grey" type="submit">Verify</button>
            </form>
        </div>
    @endif

    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Wallet</h2>
    </div>

    <span class="block pr-6 pt-4 pb-0 float-right">
        <a href="{{ route('dashboard.wallet.metrics', $wallet) }}" class="button-grey">Metrics</a>
    </span>

    @include('shared.wallets.info')

    @if($wallet->is_verified)
        <div class="m-6 flex">
            <form method="POST" action="{{ route('dashboard.wallets.update', $wallet) }}">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <span class="mr-3 text-sm text-grey py-3 block">Disbursement Frequency</span>
                    @foreach($walletFrequencies as $frequency)
                        @if($wallet->frequency === $frequency)
                            <button type="submit" name="frequency" value="{{ $frequency }}" class="mr-2 button-ghost button-active">
                                {{ ucfirst($frequency) }}
                            </button>
                        @else
                            <button type="submit" name="frequency" value="{{ $frequency }}" class="mr-2 button-ghost">
                                {{ ucfirst($frequency) }}
                            </button>
                        @endif
                    @endforeach
                </div>

                <div>
                    <span class="mr-3 text-sm text-grey py-3">Share Percentage</span>
                    <input type="number" name="percentage" class="mb-6" value="{{ old('percentage', $wallet->percentage) }}" required />
                </div>
            </form>
        </div>

        <div class="m-6">
            <p class="text-yellow-dark">
                If you like what we do and want to support us you can adjust your share which will allow us to spend more time on Ark.
            </p>
        </div>
    @endif

    @if($wallet->disbursements()->count())
        <div class="flex justify-between px-6 py-6 pt-6">
            <h2>Last 10 Disbursements</h2>
        </div>

        @include('shared.tables.disbursements', [
            'disbursements' => $wallet->disbursements->take(10),
            'routeDisbursement' => 'dashboard.disbursement',
            'routeWallet' => 'dashboard.wallet'
        ])

        @include('shared.tables.mobile.disbursements', [
            'disbursements' => $wallet->disbursements->take(10),
            'routeDisbursement' => 'dashboard.disbursement',
            'routeWallet' => 'dashboard.wallet'
        ])
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.wallet')
@endsection
