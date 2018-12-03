<div class="page-home-header">
    <p>Welcome!</p>
    <p>I'd like to tell you about all the possibilities of ArkX.</p>

    <ul>
        <li>
            <label>Share</label>
            <h3>{{ config('ark.share.percentage') }}%</h3>
        </li>

        <li>
            <label>Rank</label>
            <h3>{{ cache('delegate.rank') }}</h3>
        </li>

        <li>
            <label>Productivity</label>
            <h3>{{ cache('delegate.productivity') }}%</h3>
        </li>

        <li class="xxs:hidden xs:inline-block whitespace-no-wrap">
            <label>Votes</label>
            <h3>{{ format_arktoshi(cache('delegate.votes'), 0) }} Ѧ</h3>
        </li>

        <li class="xxs:hidden xs:inline-block whitespace-no-wrap">
            <label>Disbursed</label>
            <h3>{{ format_arktoshi(cache('delegate.disbursed'), 0) }} Ѧ</h3>
        </li>
    </ul>
</div>
