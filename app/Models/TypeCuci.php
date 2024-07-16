<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TypeCuci extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'type_cuci';
    protected $fillable = [
        'nama_type', 
        'durasi_cuci',
    ];
}
