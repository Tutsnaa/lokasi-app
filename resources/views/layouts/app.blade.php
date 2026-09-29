<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Gedung')</title>
    <!-- Contoh Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Manajemen Gedung</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <!-- Script JS jika ingin mengambil data via API (Fetch/Axios) -->
    @stack('scripts')
</body>

</html>