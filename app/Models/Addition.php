<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Addition extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'addition';
    protected $fillable = [
        'nama_addition', 
        'harga',
        'deskripsi', 
    ];
}
