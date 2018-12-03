<table class="hidden sm:table">
    <thead>
        <tr>
            <th>Address</th>
            <th>Stake</th>
            <th>Earnings</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($wallets as $wallet)
            <tr>
                <td>
                    <a href="{{ route($routeWallet, $wallet) }}">{{ $wallet->address }}</a>
                </td>
                <td>
                    {{ $wallet->formatted_stake }} Ѧ
                </td>
                <td>
                    {{ $wallet->formatted_earnings }} Ѧ
                </td>
            </tr>
       @endforeach
    </tbody>
</table>

