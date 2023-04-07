<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <div class="sidebar-user">
            <div class="fw-bold"> {{ Auth::user()->name }}</div>
            <small>admin</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="{{ route('user.index') }}" class="sidebar-link">
                    <i class="ion ion-ios-person me-2"></i><span class="align-middle">Users</span>
                </a>
            </li>
            <li class="sidebar-header">
                Shop
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <span class="align-middle">Products</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('product.index') }}">All</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('product.create') }}">Add</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#category" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <span class="align-middle">Category</span>
                </a>
                <ul id="category" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('category.index') }}">All</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('category.create') }}">Add</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                Payment
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.transaction') }}" class="sidebar-link">
                    <i class="ion ion-ios-card me-2"></i><span class="align-middle">Transaction</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="main">
    <nav class="navbar navbar-expand navbar-theme">
        <a class="sidebar-toggle d-flex me-2">
            <i class="hamburger align-self-center"></i>
        </a>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="align-middle fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

