<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Perusahaan extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'perusahaan';
    protected $fillable = [
        'nama_perusahaan', 
        'deskripsi',
        'lokasi', 
        'image'
    ];

    public function device()
    {
        return $this->hasMany(Device::class);
    }
}
