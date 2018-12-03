<div class="page-transaction">
    <div class="amount pl-6">
        <span>Earnings</span>
        <h3>{{ $wallet->formatted_earnings }} Ѧ</h3>
    </div>

    <ul class="info-list">
        <li>
            <span>Address</span>
            <span>
                <a href="https://explorer.arkx.io/#/wallets/{{ $wallet->address }}" target="_blank">
                    {{ $wallet->address }}
                </a>
            </span>
        </li>

        <li>
            <span>Stake</span>
            <span>{{ $wallet->formatted_stake }} Ѧ</span>
        </li>

        <li>
            <span>Total Disbursements</span>
            <span>{{ $wallet->disbursements()->count() }}</span>
        </li>

        <li>
            <span>Total Earnings</span>
            <span>{{ $wallet->formatted_total_earnings }} Ѧ</span>
        </li>

        @if ($wallet->is_verified)
            <li>
                <span>Verified</span>
                <span>{{ $wallet->verified_at->toDayDateTimeString() }}</span>
            </li>
        @endif
    </ul>
</div>
