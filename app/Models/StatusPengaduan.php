<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengaduan extends Model
{
    use HasFactory;

    protected $table = 'status_pengaduan';
    protected $primaryKey = 'status_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_status'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'status_id', 'status_id');
    }
}
