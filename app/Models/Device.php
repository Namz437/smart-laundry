<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Device extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'device';
    protected $fillable = [
        'perusahaan_id', 
        'type_cuci_id',
        'nama_device', 
        'mac_address',
        'status'
    ];

    public function Perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function TypeCuci()
    {
        return $this->belongsTo(TypeCuci::class);
    }
}
