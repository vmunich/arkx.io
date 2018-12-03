{{-- Top-Nav --}}
<nav class="flex lg:hidden shadow h-16 bg-white w-full sticky pin-t">
    <div class="flex flex-no-shrink">
        <a href="{{ route('home') }}" title="Home">
            <img class="inline-block h-16 w-auto" src="/images/logo.svg" />
        </a>
    </div>

    <div class="flex justify-around sm:justify-between items-center w-full">
        <ul class="list-reset sm:pl-6">
            <li class="mr-6" @click="toggleMenu">
                <i class="far fa-bars text-blue-light"></i>
                <span class="hidden sm:inline-block text-blue-light">Menu</span>
            </li>
        </ul>

        @guest
            <ul class="flex list-reset">
                <li class="p-6 border-r border-grey-light">
                    <a href="{{ route('login') }}" class="text-blue-lighter">
                        <i class="far fa-sign-in"></i>
                    </a>
                </li>
                <li class="p-6 pr-0">
                    <a href="{{ route('register') }}" class="text-blue-lighter">
                        <i class="far fa-user-plus"></i>
                    </a>
                </li>
            </ul>
        @else
            <ul class="flex list-reset">
                <li class="p-6 border-r border-grey-light">
                    <a href="{{ route('dashboard.disbursements') }}" class="text-blue-lighter">
                        <i class="far fa-money-check"></i>
                        <span class="hidden xs:inline-block">{{ $currentUser->formatted_earnings }}</span>
                    </a>
                </li>

                <li class="p-6 border-r border-grey-light">
                    <a href="{{ route('dashboard.notifications') }}" class="text-blue-lighter notification-badge-mobile">
                        <i class="far fa-bell"></i>
                        <span>{{ $unreadNotifications }}</span>
                    </a>
                </li>

                <li class="p-6 pr-0 sm:pr-6">
                    @include('shared.actions.logout')
                </li>
            </ul>
        @endauth
    </div>
</nav>

<div class="nav-mobile" :class="{ hidden: !showMobileMenu }">
    <ul>
        {!! Menu::tools() !!}

        {!! Menu::main() !!}

        @guest
            {!! Menu::guest() !!}
        @endguest

        @role('voter')
            {!! Menu::dashboard() !!}
        @endrole

        @auth
            {!! Menu::user() !!}
        @endauth
    </ul>
</div>
