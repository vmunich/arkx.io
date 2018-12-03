<table class="hidden sm:table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Purpose</th>
            <th>Recipient</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($disbursements as $disbursement)
            <tr>
                <td>
                    <a href="{{ route($routeDisbursement, $disbursement) }}">
                        {{ str_limit($disbursement->transaction_id, 12) }}
                    </a>
                </td>
                <td>
                    {{ $disbursement->purpose }}
                </td>
                <td>
                    <a href="{{ route($routeWallet, $disbursement->wallet) }}">{{ $disbursement->wallet->address }}</a>
                </td>
                <td>
                    {{ $disbursement->formatted_amount }} Ѧ
                </td>
                <td>
                    {{ $disbursement->signed_at->toDayDateTimeString() }}
                </td>
            </tr>
       @endforeach
    </tbody>
</table>
