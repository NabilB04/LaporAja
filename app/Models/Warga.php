<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Warga extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'warga_id');
    }
}
