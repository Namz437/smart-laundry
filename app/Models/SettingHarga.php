<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class SettingHarga extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'setting_harga';
    protected $fillable = [
        'type_cuci_id', 
        'harga_perKg',
    ];

    public function TypeCuci()
    {
        return $this->belongsTo(TypeCuci::class);
    }
}
