<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Bayar extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'bayars';
    protected $fillable = [
        'invoice_number', 
        'amount',
        'status'
    ];
}
