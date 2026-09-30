<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Gedung')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    html {
        overflow-y: scroll;
    }
    </style>
</head>

<body>

    <!-- Navbar tetap saat scroll -->
    <nav class="navbar navbar-dark bg-dark sticky-top mb-4">
        <div class="container">

            <a class="navbar-brand" href="#">
                Sistem Manajemen Gedung
            </a>

            @auth
            <div class="d-flex align-items-center gap-3">

                <span class="text-white">
                    Halo, {{ Auth::user()->nama }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>

            </div>
            @endauth

        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    @stack('scripts')

</body>

</html>