<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- @vite('resources/sass/app.scss') --}}
</head>

<body class="border-top-wide border-primary d-flex flex-column">

    <div class="page page-center">
        <div class="row">
            <div class="container-tight py-4 col-12 col-md-4 mx-auto">
                <div class="text-center mb-4">
                    <a href="{{ config('app.url') }}" class="navbar-brand navbar-brand-autodark">
                        <img src="{{ url('img/logo.svg') }}" height="36" alt="" />
                    </a>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</body>

</html>
