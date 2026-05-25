<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Programming',
            'deskripsi' => 'Kategori buku programming',
            'icon' => 'code-slash',
            'warna' => 'primary'
        ]);

        Kategori::create([
            'nama_kategori' => 'Database',
            'deskripsi' => 'Kategori buku database',
            'icon' => 'database',
            'warna' => 'success'
        ]);

        Kategori::create([
            'nama_kategori' => 'Web Design',
            'deskripsi' => 'Kategori buku web design',
            'icon' => 'palette',
            'warna' => 'info'
        ]);

        Kategori::create([
            'nama_kategori' => 'Networking',
            'deskripsi' => 'Kategori buku networking',
            'icon' => 'wifi',
            'warna' => 'warning'
        ]);

        Kategori::create([
            'nama_kategori' => 'Data Science',
            'deskripsi' => 'Kategori buku data science',
            'icon' => 'graph-up',
            'warna' => 'danger'
        ]);
    }
}
