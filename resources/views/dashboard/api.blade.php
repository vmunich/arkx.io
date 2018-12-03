@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>API Documentation</h2>
    </div>

    <div class="px-6">
        <p>The ArkX API allows you to programatically manage your wallets and disbursements. For more information on the API, you should consult the <a href="{{ route('dashboard.api') }}">API documentation</a>.</p>

        {{-- <p>Here is your new API token. <strong>This is the only time the token will ever be displayed, so be sure not to lose it!</strong> You may revoke the token at any time from your API settings.</p> --}}

        <br>

        <p>Here is your API token. <span class="inline-block bg-yellow p-2">{{ $token }}</span>. The API token needs to be send as <span class="inline-block bg-yellow p-2">?token=</span> in every request.</p>

        <h4 class="mt-3">Wallets</h4>

        <h5 class="mt-3 mb-1">Display a listing of the wallets.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.wallets', ['api_token' => $token]) }}</span>
        <p>Returns a list of your wallets. The wallets are returned sorted by creation date, with the most recent wallets appearing first.</p>

        <h5 class="mt-3 mb-1">Display a listing of the wallets filtered by the specified criteria.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.wallets.search', ['api_token' => $token]) }}</span>
        <p>Returns a list of your wallets filtered by the given criteria. The wallets are returned sorted by creation date, with the most recent wallets appearing first.</p>

        <h5 class="mt-3 mb-1">Display the specified wallet.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.wallet', ['some-address', 'api_token' => $token]) }}</span>
        <p>Retrieves the details of an existing wallet. You need only supply the unique wallet identifier.</p>

        <h4 class="mt-3">Disbursements</h4>

        <h5 class="mt-3 mb-1">Display a listing of the disbursements.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.disbursements', ['api_token' => $token]) }}</span>
        <p>Returns a list of your disbursements. The disbursements are returned sorted by creation date, with the most recent disbursements appearing first.</p>

        <h5 class="mt-3 mb-1">Display a listing of the disbursements filtered by the specified criteria.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.disbursements.search', ['api_token' => $token]) }}</span>
        <p>Returns a list of your disbursements filtered by the given criteria. The disbursements are returned sorted by creation date, with the most recent disbursements appearing first.</p>

        <h5 class="mt-3 mb-1">Display the specified disbursement.</h5>
        <span class="inline-block bg-yellow p-2">GET {{ route('api.disbursement', ['some-address', 'api_token' => $token]) }}</span>
        <p>Retrieves the details of an existing disbursement. You need only supply the unique disbursement identifier.</p>
    </div>
@endsection
