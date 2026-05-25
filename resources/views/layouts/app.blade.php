<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a href="/" class="navbar-brand">
            Perpustakaan
        </a>

        <div>
            <a href="/kategori" class="btn btn-outline-light">
                Kategori
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>