<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-md">
    <div class="container">
        <!-- Branding Image -->
    {{ link_to_route('home', config('app.name', 'Laravel'), [], ['class' => 'navbar-brand']) }}

    <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            @role('admin')
            <ul class="navbar-nav">
                <li class="nav-item">
                    {{ link_to_route('dashboard', 'Dashboard', [], ['class' => 'nav-link']) }}
                </li>
            </ul>
            @endrole

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">{{ link_to_route('login', 'Login', [], ['class' => 'nav-link']) }}</li>
                    <li class="nav-item">{{ link_to_route('register', 'Register', [], ['class' => 'nav-link']) }}</li>
                @else
                    <li class="nav-item dropdown">
                        <a v-pre href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-divider"></div>

                            <a href="{{ url('/logout') }}"
                               class="dropdown-item"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" class="d-none" action="{{ url('/logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

