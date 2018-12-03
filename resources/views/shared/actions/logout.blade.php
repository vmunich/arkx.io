<form class="inline-block" action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit" class="link-icon">
        <i class="far fa-sign-out"></i>
    </button>
</form>
