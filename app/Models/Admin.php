<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'nama',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'admin_id', 'admin_id');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'admin_id', 'admin_id');
    }
}
