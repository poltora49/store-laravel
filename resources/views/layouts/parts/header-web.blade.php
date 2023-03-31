
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">Store</a>
      <div class="d-flex flex-row">
            <ul class="nav navbar-nav navbar-right me-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        6
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
            @auth("web")
            {{auth()->user()->name}}
            @endauth
            @guest("web")
            Shop
            @endauth
        </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.all')}}">All products</a>
            </li>
            @auth("web")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('favorites')}}">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login')}}">My transactions</a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item text-danger"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

             @endauth

        @guest("web")
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login')}}">Sign in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register')}}">Sign up</a>
            </li>
        @endauth
          </ul>
        </div>
      </div>
    </div>
  </nav>
