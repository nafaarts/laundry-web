<div class="nav">
    <div class="sb-sidenav-menu-heading">Core</div>
    <a class="nav-link @if (request()->routeIs('home')) active @endif" href="{{ route('home') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    @can('admin')
        <a class="nav-link @if (request()->routeIs('users*')) active @endif" href="{{ route('users.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
            Users
        </a>

        <a class="nav-link @if (request()->routeIs('laundry*')) active @endif" href="{{ route('laundry.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-jug-detergent"></i></div>
            Laundry
        </a>

        <a class="nav-link @if (request()->routeIs('orders*')) active @endif" href="{{ route('orders.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-money-bill-transfer"></i></div>
            Orders
        </a>
    @else
        <a class="nav-link @if (request()->routeIs('detail')) active @endif" href="{{ route('detail') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
            Detail Laundry
        </a>

        <a class="nav-link @if (request()->routeIs('laundry-orders*')) active @endif" href="{{ route('laundry-orders') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-money-bill-transfer"></i></div>
            Orders
        </a>
    @endcan


    <div class="sb-sidenav-menu-heading">Authentication</div>
    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <a href="{{ route('logout') }}" class="nav-link"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
            Logout
        </a>
    </form>
</div>
