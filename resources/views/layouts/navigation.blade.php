<nav class="app-navigation">
    <div class="nav-container">
        <div class="nav-section">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Expensir') }} Logo" class="app-logo">
                    {{-- <span class="logo-text">{{ config('app.name', 'Expensir') }}</span> --}}
                </a>
            </div>
            <div class="nav-links">
                 @auth
                    <a href="{{ route('home') }}" class="nav-link {{ (request()->routeIs('home') or request()->routeIs('expenses.*')) ? 'nav-link-active' : '' }}">
                        Expenses
                    </a>
                 @endauth
            </div>
        </div>

        <div class="nav-user-section">
            @auth
                <div class="nav-user-dropdown">
                    <div class="dropdown">
                        <button class="user-dropdown-trigger">
                            <div>{{ Auth::user()->name }}</div>
                            <div style="margin-left: 0.25rem;">
                                 <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="16" width="16" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                         <div class="dropdown-content">
                            <a href="{{ route('profile.edit') }}" class="dropdown-link">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-link"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                 <div class="auth-links">
                     <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                    @endif
                </div>
            @endauth
        </div>
         {{-- Hamburger for mobile could go here --}}
    </div>
</nav>