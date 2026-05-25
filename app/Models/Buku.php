<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Buku extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'buku';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];
 
    /**
     * Accessor untuk format harga.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
 
    /**
     * Accessor untuk status ketersediaan.
     */
    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }

    // accessor status stok badge
    public function getStatusStokBadgeAttribute(): string
    {
        // cek stok habis
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        }

        // cek stok menipis
        elseif ($this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        }

        // cek stok sedang
        elseif ($this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        }

        // stok aman
        return '<span class="badge bg-success">Aman</span>';
    }

    // accessor label tahun buku
    public function getTahunLabelAttribute(): string
    {
        // buku terbaru
        if ($this->tahun_terbit >= 2024) {
            return 'Buku Baru';
        }

        // buku lama
        return 'Buku Lama';
    }

    /**
     * Scope untuk filter buku tersedia.
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }
 
    /**
     * Scope untuk filter berdasarkan kategori.
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // scope stok menipis
    public function scopeStokMenipis($query)
    {
        // filter stok kurang dari 5
        return $query->where('stok', '<', 5);
    }

    // scope range harga
    public function scopeHargaRange($query, $min, $max)
    {
        // filter harga berdasarkan range
        return $query->whereBetween('harga', [$min, $max]);
    }

    // scope buku terbaru
    public function scopeTerbaru($query)
    {
        // filter tahun terbaru
        return $query->where('tahun_terbit', '>=', 2024);
    }
}