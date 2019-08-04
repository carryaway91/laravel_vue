<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

    @guest
        <a href="{{ route('login') }}">Login</a>
        
        {{--kontrala ci existuje cesta register -> pouzivana v pripade ak sa na stranke 
        rozhodnem uzavriet registracie tak sa tento link strati--}} 
        @if (Route::has('register'))
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        @endif
    @endguest

    @auth
        <a href="user/{{ auth()->user()->id }}">{{ auth()->user()->name }}</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
</nav>