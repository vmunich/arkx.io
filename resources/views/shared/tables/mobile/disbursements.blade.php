<ul class="info-list sm:hidden">
    @foreach ($disbursements as $disbursement)
        <li class="px-6">
            <span>
                <a href="{{ route($routeDisbursement, $disbursement) }}">{{ str_limit($disbursement->transaction_id, 16) }}</a>
            </span>
            <span>
                {{ $disbursement->formatted_amount }} Ѧ
            </span>
        </li>
    @endforeach
</ul>
