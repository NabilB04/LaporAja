<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';
    protected $primaryKey = 'tanggapan_id';
    public $timestamps = false;

    protected $fillable = [
        'pengaduan_id',
        'admin_id',
        'status_baru',
        'isi_tanggapan',
        'foto_tanggapan'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }


}
