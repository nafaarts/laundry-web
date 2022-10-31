<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- @vite('resources/sass/app.scss') --}}
    @yield('custom_styles')
</head>

<body class="theme-light">
    <div class="sticky-top bg-white border-bottom">
        <div class="container">
            <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href=".">
                            <img src="{{ url('img/logo.svg') }}" width="110" height="32" alt="Tabler"
                                class="navbar-brand-image">
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">
                        @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                    aria-label="Open user menu">
                                    <div class="d-none d-xl-block pe-2">
                                        <i class="fas fa-fw fa-user"></i> {{ auth()->user()->name ?? null }}
                                    </div>
                                    {{-- <span class="avatar avatar-sm rounded-circle"
                                            style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=206BC4&color=fff)"></span> --}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Profile') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>
            @include('layouts.navigation')
        </div>
    </div>

    <div class="container py-3">
        @yield('content')
    </div>

    <!-- Core plugin JavaScript-->
    @vite('resources/js/app.js')

    <!-- Page level custom scripts -->
    @yield('custom_scripts')

</body>

</html>
