<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Roles extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'roles';
    protected $fillable = ['nama_role'];

    public function SettingRoles()
    {
        return $this->hasMany(SettingRoles::class);
    }

}
