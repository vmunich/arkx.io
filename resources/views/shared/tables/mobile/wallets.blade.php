<ul class="info-list sm:hidden">
    @foreach ($wallets as $wallet)
        <li class="px-6">
            <span>
                <a href="{{ route($routeWallet, $wallet) }}">{{ str_limit($wallet->address, 16) }}</a>
            </span>
            <span>
                {{ $wallet->formatted_earnings }} Ѧ
            </span>
        </li>
    @endforeach
</ul>
