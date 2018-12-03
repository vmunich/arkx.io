<div class="page-transaction">
    <div class="amount pl-6">
        <span>Amount</span>
        <h3>{{ $disbursement->formatted_amount }} Ѧ</h3>
    </div>

    <ul class="info-list">
        <li>
            <span>Transaction ID</span>
            <span>
                <a href="https://explorer.arkx.io/#/transaction/{{ $disbursement->transaction_id }}" target="_blank">
                    {{ $disbursement->transaction_id }}
                </a>
            </span>
        </li>

        <li>
            <span>Wallet</span>
            <span>
                <a href="{{ route('wallet', $disbursement->wallet) }}">
                    {{ $disbursement->wallet->address }}
                </a>
            </span>
        </li>

        <li>
            <span>Date</span>
            <span>{{ $disbursement->signed_at->toDayDateTimeString() }}</span>
        </li>

        <li>
            <span>Purpose</span>
            <span>{{ $disbursement->purpose }}</span>
        </li>
    </ul>
</div>
