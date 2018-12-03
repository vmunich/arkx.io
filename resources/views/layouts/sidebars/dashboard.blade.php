<aside class="xxs:hidden lg:block transactions-aside xxs:overlay-xxs xs:overlay-xs sm:overlay-sm">
    <div>
        <h1><span>Overview</span></h1>
    </div>

    <div class="balance">
        <span>Earnings</span>
        <h3>
            <span class="text-shadow">{{ $currentUser->formatted_earnings }} Ѧ</span>

            {{-- @if($disbursementGain)
                <img src="/images/arkx_green_arrow.svg" />
                <span class="text-green">{{ $disbursementDifference }}%</span>
            @else
                <img src="/images/arkx_red_arrow.svg" />
                <span class="text-red">{{ $disbursementDifference }}%</span>
            @endif --}}
        </h3>

        <div class="canvas-wrapper">
            <chart-transaction
                :labels='@json($chartLabels)'
                :data='@json($chartData)'
                height="50%" />
        </div>

        <img src="/images/arkx_chart_lines.png" />
    </div>

    <p class="pt-20 text-blue-lighter font-semibold">
        Estimated Earnings Per Period
    </p>

    <ul class="info-list mt-zero">
        <li>
            <span>Daily</span>
            <span>{{ $dailyRevenue }} Ѧ</span>
        </li>
        <li>
            <span>Weekly</span>
            <span>{{ $weeklyRevenue }} Ѧ</span>
        </li>
        <li>
            <span>Monthly</span>
            <span>{{ $monthlyRevenue }} Ѧ</span>
        </li>
        <li>
            <span>Quarterly</span>
            <span>{{ $quarterlyRevenue }} Ѧ</span>
        </li>
        <li>
            <span>Yearly</span>
            <span>{{ $yearlyRevenue }} Ѧ</span>
        </li>
    </ul>

    <div class="meter">
        <div class="content">
            <div>
                <span>Vote weight</span>
            </div>

            <div>
                <div class="w-16 h-16 text-green">
                    <ProgressMeter :percentage="{{ $voteWeight }}" shadow-color="#27d876" />
                </div>
            </div>

            <div>
                <h3>{{ $voteWeight }}%</h3>
            </div>
        </div>
    </div>
</aside>
