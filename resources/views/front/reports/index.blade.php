@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Reports</h2>
        <form method="POST" action="{{ route('reports.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($reports->count())
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Disbursements</th>
                        <th>Disbursed</th>
                        <th>Fees</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>
                                <a href="{{ route('report', $report) }}">
                                    {{ $report->date->toFormattedDateString() }}
                                </a>
                            </td>
                            <td>
                                {{ $report->count }}
                            </td>
                            <td>
                                {{ $report->formatted_amount }} Ѧ
                            </td>
                            <td>
                                {{ $report->formatted_fees }} Ѧ
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('reports.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            <ul class="info-list sm:hidden">
                @foreach ($reports as $report)
                    <li class="px-6">
                        <span>
                            <a href="{{ route('report', $report) }}">
                                {{ $report->date->toFormattedDateString() }}
                            </a>
                        </span>
                        <span>
                            <strong>Disbursed:</strong> {{ $report->formatted_amount }} Ѧ
                        </span>
                        <span>
                            <strong>Fees:</strong> {{ $report->formatted_fees }} Ѧ
                        </span>
                    </li>
                @endforeach
            </ul>

            {{ $reports->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no reports available at this time.
            </div>
        @endif
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
