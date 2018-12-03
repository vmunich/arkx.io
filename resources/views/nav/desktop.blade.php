<nav class="left-nav lg:block">
    <div>
        <a class="brand" href="{{ route('home') }}" title="Home">
            <img src="/images/logo.svg" />
        </a>
    </div>

    <div class="nav-bar">
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
</nav>
