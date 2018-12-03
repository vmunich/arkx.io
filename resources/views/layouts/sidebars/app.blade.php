@guest
    <aside class="hidden lg:block desktop-aside">
        <div>
            <img src="/images/arkx_for_users.png" />
        </div>
        <div>
            <h1>For Voters</h1>
            <p>To track your disbursements or access metrics, log in to your account or register</p>

            <div>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </aside>
@else
    @include('layouts.sidebars.dashboard')
@endguest
