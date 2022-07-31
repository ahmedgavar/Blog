 <!-- Right Side Of Navbar -->
 <ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('admins.login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admins.login') }}">{{ __('admins.login') }}</a>
            </li>
        @endif


    @endguest
</ul>
