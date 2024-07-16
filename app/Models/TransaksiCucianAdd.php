<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TransaksiCucianAdd extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'transaksi_cucian_add';
    protected $fillable = [
        'transaksi_cuci_id', 
        'addition_id',
        'jumlah', 
        'total_harga',
    ];

    public function transaksicucian()
    {
        return $this->belongsTo(TransaksiCucian::class, 'transaksi_cuci_id');
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class);
    }
}

