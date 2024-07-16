<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TransaksiCuciAsli extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'transaksi_cuci_asli';
    protected $fillable = [
        'transaksi_cuci_id',
        'users_id', 
        'device_id',
        'waktu_cuci', 
        'status_transaksi',
        'total_harga_cucian',
    ];

    public function transaksicucian()
    {
        return $this->belongsTo(TransaksiCucian::class, 'transaksi_cuci_id');
    }

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}

