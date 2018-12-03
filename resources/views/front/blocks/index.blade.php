@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Blocks</h2>
        <form method="POST" action="{{ route('blocks.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($blocks->count())
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Height</th>
                        <th>Reward</th>
                        <th class="text-right">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($blocks as $block)
                        <tr>
                            <td>
                                <a href="{{ route('block', $block) }}">{{ $block->block_id }}</a>
                            </td>
                            <td>
                                {{ $block->height }}
                            </td>
                            <td>
                                {{ $block->formatted_reward }} Ѧ
                            </td>
                            <td class="text-right">
                                {{ $block->forged_at->toDayDateTimeString() }}
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('blocks.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            <ul class="info-list sm:hidden">
                @foreach ($blocks as $block)
                    <li class="px-6">
                        <span>
                            <a href="{{ route('block', $block) }}">{{ $block->block_id }}</a><br />
                        </span>
                        <span>{{ $block->formatted_reward }} Ѧ</span>
                    </li>
                @endforeach
            </ul>

            {{ $blocks->links() }}
        @endif
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
