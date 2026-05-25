<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // daftar kategori
    public function index()
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Jaringan',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Desain',
                'deskripsi' => 'Buku UI UX dan desain grafis',
                'jumlah_buku' => 15
            ],
            [
                'id' => 5,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan sistem dan data',
                'jumlah_buku' => 10
            ],
        ];

        return view('kategori.index', compact('kategori_list'));
    }

    // detail kategori
    public function show($id)
    {
        $kategori_list = [
            1 => [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            2 => [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            3 => [
                'id' => 3,
                'nama' => 'Jaringan',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 12
            ],
            4 => [
                'id' => 4,
                'nama' => 'Desain',
                'deskripsi' => 'Buku UI UX dan desain grafis',
                'jumlah_buku' => 15
            ],
            5 => [
                'id' => 5,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan sistem dan data',
                'jumlah_buku' => 10
            ],
        ];

        $kategori = $kategori_list[$id];

        $buku_list = [
            [
                'judul' => 'Laravel Dasar',
                'pengarang' => 'John Doe',
                'tahun' => 2024
            ],
            [
                'judul' => 'PHP untuk Pemula',
                'pengarang' => 'Budi Santoso',
                'tahun' => 2023
            ],
            [
                'judul' => 'Mastering Coding',
                'pengarang' => 'Ahmad Rizki',
                'tahun' => 2022
            ],
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    // cari kategori
    public function search($keyword)
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku database dan SQL',
                'jumlah_buku' => 18
            ],
            [
                'id' => 3,
                'nama' => 'Jaringan',
                'deskripsi' => 'Buku jaringan komputer',
                'jumlah_buku' => 12
            ],
            [
                'id' => 4,
                'nama' => 'Desain',
                'deskripsi' => 'Buku UI UX dan desain grafis',
                'jumlah_buku' => 15
            ],
            [
                'id' => 5,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan sistem dan data',
                'jumlah_buku' => 10
            ],
        ];

        $hasil = collect($kategori_list)->filter(function ($kategori) use ($keyword) {
            return str_contains(strtolower($kategori['nama']), strtolower($keyword));
        });

        return view('kategori.search', compact('hasil', 'keyword'));
    }
}