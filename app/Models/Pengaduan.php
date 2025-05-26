<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'admin_id',
        'status_id',
        'judul',
        'deskripsi',
        'lokasi',
        'foto_bukti'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'user_id', 'warga_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengaduan::class, 'status_id', 'status_id');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'pengaduan_id', 'pengaduan_id');
    }
}
