<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">
        <div class="card-header bg-primary text-white">
            Detail Anggota
        </div>

        <div class="card-body">

            <p>
                <strong>Kode Anggota:</strong>
                {{ $anggota['kode'] }}
            </p>

            <p>
                <strong>Nama Lengkap:</strong>
                {{ $anggota['nama'] }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ $anggota['email'] }}
            </p>

            <p>
                <strong>Telepon:</strong>
                {{ $anggota['telepon'] }}
            </p>

            <p>
                <strong>Alamat:</strong>
                {{ $anggota['alamat'] }}
            </p>

            <p>
                <strong>Status:</strong>

                @if ($anggota['status'] == 'Aktif')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </p>

            <a href="/anggota" class="btn btn-secondary">
                Kembali ke Daftar
            </a>

        </div>
    </div>

</div>

</body>
</html>