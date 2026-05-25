<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Anggota;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;

// Route default
Route::get('/', function () {
    return view('welcome');
});

// Route baru - return text
Route::get('/hello', function () {
    return 'Hello dari Laravel!';
});

// Route dengan HTML
Route::get('/info', function () {
    return '<h1>Sistem Perpustakaan</h1><p>Selamat datang!</p>';
});

// Route dengan JSON
Route::get('/buku-json', function () {
    return [
        'judul' => 'Laravel Programming',
        'pengarang' => 'John Doe',
        'harga' => 150000
    ];
});

// Route dengan multiple parameters
Route::get('/search/{kategori}/{keyword}', function ($kategori, $keyword) {
    return "Cari buku kategori: $kategori dengan keyword: $keyword";
});

// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);

// Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);

Route::get('/about', [PerpustakaanController::class, 'about']);

// Route test koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        
        return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "Koneksi database gagal!<br />Error: " . $e->getMessage();
    }
});

//route anggota
// Route::get('/anggota', function () {

//     $anggota_list = [
//         [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Nurhaliza',
//             'email' => 'siti@email.com',
//             'telepon' => '081234567891',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Ahmad Rizki',
//             'email' => 'ahmad@email.com',
//             'telepon' => '081234567892',
//             'alamat' => 'Surabaya',
//             'status' => 'Nonaktif'
//         ],
//         [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '081234567893',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Rizky Febian',
//             'email' => 'rizky@email.com',
//             'telepon' => '081234567894',
//             'alamat' => 'Semarang',
//             'status' => 'Nonaktif'
//         ],
//     ];

//     return view('anggota.index', compact('anggota_list'));
// });

// Route::get('/anggota/{id}', function ($id) {

//     $anggota_list = [
//         [
//             'id' => 1,
//             'kode' => 'AGT-001',
//             'nama' => 'Budi Santoso',
//             'email' => 'budi@email.com',
//             'telepon' => '081234567890',
//             'alamat' => 'Jakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 2,
//             'kode' => 'AGT-002',
//             'nama' => 'Siti Nurhaliza',
//             'email' => 'siti@email.com',
//             'telepon' => '081234567891',
//             'alamat' => 'Bandung',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 3,
//             'kode' => 'AGT-003',
//             'nama' => 'Ahmad Rizki',
//             'email' => 'ahmad@email.com',
//             'telepon' => '081234567892',
//             'alamat' => 'Surabaya',
//             'status' => 'Nonaktif'
//         ],
//         [
//             'id' => 4,
//             'kode' => 'AGT-004',
//             'nama' => 'Dewi Lestari',
//             'email' => 'dewi@email.com',
//             'telepon' => '081234567893',
//             'alamat' => 'Yogyakarta',
//             'status' => 'Aktif'
//         ],
//         [
//             'id' => 5,
//             'kode' => 'AGT-005',
//             'nama' => 'Rizky Febian',
//             'email' => 'rizky@email.com',
//             'telepon' => '081234567894',
//             'alamat' => 'Semarang',
//             'status' => 'Nonaktif'
//         ],
//     ];

//     $anggota = collect($anggota_list)->firstWhere('id', $id);

//     return view('anggota.show', compact('anggota'));
// });

// route kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');

Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

// ========== TESTING BUKU ==========
 
// List all buku
Route::get('/buku', function () {
    $bukus = Buku::all();
    
    $html = '<h1>Daftar Buku</h1>';
    $html .= '<a href="/buku/create">Tambah Buku</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>';
    
    foreach ($bukus as $buku) {
        $html .= '<tr>';
        $html .= '<td>' . $buku->id . '</td>';
        $html .= '<td>' . $buku->kode_buku . '</td>';
        $html .= '<td>' . $buku->judul . '</td>';
        $html .= '<td>' . $buku->kategori . '</td>';
        $html .= '<td>' . $buku->harga_format . '</td>';
        $html .= '<td>' . $buku->stok . '</td>';
        $html .= '<td>
                    <a href="/buku/' . $buku->id . '">Detail</a> | 
                    <a href="/buku/' . $buku->id . '/edit">Edit</a>
                  </td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    return $html;
});
 
// Show single buku
Route::get('/buku/{id}', function ($id) {
    $buku = Buku::findOrFail($id);
    
    $html = '<h1>Detail Buku</h1>';
    $html .= '<a href="/buku">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
    $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
    $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
    $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
    $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
    $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
    $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
    $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
    $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
    $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
    $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';
    $html .= '<tr><td>Created</td><td>' . $buku->created_at . '</td></tr>';
    $html .= '<tr><td>Updated</td><td>' . $buku->updated_at . '</td></tr>';
    $html .= '</table>';
    
    return $html;
});
 
// ========== TESTING ANGGOTA ==========
 
// List all anggota
Route::get('/anggota', function () {
    $anggotas = Anggota::all();
    
    $html = '<h1>Daftar Anggota</h1>';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>';
    
    foreach ($anggotas as $anggota) {
        $html .= '<tr>';
        $html .= '<td>' . $anggota->id . '</td>';
        $html .= '<td>' . $anggota->kode_anggota . '</td>';
        $html .= '<td>' . $anggota->nama . '</td>';
        $html .= '<td>' . $anggota->email . '</td>';
        $html .= '<td>' . $anggota->umur . ' tahun</td>';
        $html .= '<td>' . $anggota->status . '</td>';
        $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    return $html;
});
 
// Show single anggota
Route::get('/anggota/{id}', function ($id) {
    $anggota = Anggota::findOrFail($id);
    
    $html = '<h1>Detail Anggota</h1>';
    $html .= '<a href="/anggota">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
    $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
    $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
    $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
    $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
    $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
    $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
    $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
    $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
    $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
    $html .= '</table>';
    
    return $html;
});
 
// Testing Scope & Query
Route::get('/test-query', function () {
    $html = '<h1>Testing Query Eloquent</h1>';
    
    // Buku tersedia
    $tersedia = Buku::tersedia()->get();
    $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3>';
    $html .= '<ul>';
    foreach ($tersedia as $buku) {
        $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
    }
    $html .= '</ul>';
    
    // Buku Programming
    $programming = Buku::kategori('Programming')->get();
    $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3>';
    $html .= '<ul>';
    foreach ($programming as $buku) {
        $html .= '<li>' . $buku->judul . '</li>';
    }
    $html .= '</ul>';
    
    // Anggota Aktif
    $aktif = Anggota::aktif()->get();
    $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3>';
    $html .= '<ul>';
    foreach ($aktif as $anggota) {
        $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
    }
    $html .= '</ul>';
    
    return $html;
});

// testing accessor dan scope
Route::get('/test-accessor-scope', function () {

    // ambil semua buku
    $bukus = Buku::all();

    // ambil buku terbaru
    $bukuTerbaru = Buku::terbaru()->get();

    // ambil buku stok menipis
    $stokMenipis = Buku::stokMenipis()->get();

    // ambil semua anggota
    $anggotas = Anggota::all();

    // ambil anggota bulan ini
    $anggotaBulanIni = Anggota::terdaftarBulanIni()->get();

    // tampilan awal + bootstrap
    $html = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-4">
        <h1 class="mb-4">Testing Accessor & Scope</h1>
    ';

    // tampilkan status stok buku
    $html .= '<h2>Status Stok Buku</h2>';
    $html .= '<ul class="list-group mb-4">';

    foreach ($bukus as $buku) {
        $html .= '<li class="list-group-item">'
              . $buku->judul
              . ' - '
              . $buku->status_stok_badge
              . ' - '
              . $buku->tahun_label
              . '</li>';
    }

    $html .= '</ul>';

    // tampilkan buku terbaru
    $html .= '<h2>Buku Terbaru</h2>';
    $html .= '<ul class="list-group mb-4">';

    foreach ($bukuTerbaru as $buku) {
        $html .= '<li class="list-group-item">' . $buku->judul . '</li>';
    }

    $html .= '</ul>';

    // tampilkan stok menipis
    $html .= '<h2>Buku Stok Menipis</h2>';
    $html .= '<ul class="list-group mb-4">';

    foreach ($stokMenipis as $buku) {
        $html .= '<li class="list-group-item">'
              . $buku->judul
              . ' - stok: '
              . $buku->stok
              . '</li>';
    }

    $html .= '</ul>';

    // tampilkan status anggota
    $html .= '<h2>Status Anggota</h2>';
    $html .= '<ul class="list-group mb-4">';

    foreach ($anggotas as $anggota) {
        $html .= '<li class="list-group-item">'
            . $anggota->nama
            . ' - umur: '
            . $anggota->umur
            . ' tahun'
            . ' - '
            . $anggota->status_badge
            . ' - '
            . $anggota->kategori_usia
            . '</li>';
    }

    $html .= '</ul>';

    // tampilkan anggota bulan ini
    $html .= '<h2>Anggota Terdaftar Bulan Ini</h2>';
    $html .= '<ul class="list-group mb-4">';

    foreach ($anggotaBulanIni as $anggota) {
        $html .= '<li class="list-group-item">' . $anggota->nama . '</li>';
    }

    $html .= '</ul>';

    // penutup container
    $html .= '</div>';

    return $html;
});