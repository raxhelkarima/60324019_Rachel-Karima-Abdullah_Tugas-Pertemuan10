<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
 
class Anggota extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];
 
    /**
     * Accessor untuk menghitung umur.
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
 
    /**
     * Accessor untuk lama menjadi anggota (dalam hari).
     */
    public function getLamaAnggotaAttribute(): int
    {
        return (int) Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }

    // accessor status badge anggota
    public function getStatusBadgeAttribute(): string
    {
        // status aktif
        if ($this->status == 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        // status nonaktif
        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    // accessor kategori usia
    public function getKategoriUsiaAttribute(): string
    {
        // kategori remaja
        if ($this->umur < 20) {
            return 'Remaja';
        }

        // kategori dewasa
        elseif ($this->umur <= 50) {
            return 'Dewasa';
        }

        // kategori senior
        return 'Senior';
    }
 
    /**
     * Scope untuk filter anggota aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
 
    // scope jenis kelamin
    public function scopeJenisKelamin($query, $jk)
    {
        // filter berdasarkan jenis kelamin
        return $query->where('jenis_kelamin', $jk);
    }

    // scope anggota bulan ini
    public function scopeTerdaftarBulanIni($query)
    {
        // filter anggota bulan ini
        return $query->whereMonth('tanggal_daftar', now()->month)
                     ->whereYear('tanggal_daftar', now()->year);
    }
}