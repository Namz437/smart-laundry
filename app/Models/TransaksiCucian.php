<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TransaksiCucian extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'transaksi_cuci';
    protected $fillable = [
        'users_id', 
        'device_id',
        'waktu_cuci', 
        'status_transaksi',
        'total_harga',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
