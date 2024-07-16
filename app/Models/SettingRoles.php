<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class SettingRoles extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'setting_roles';
    protected $fillable = ['users_id', 'roles_id'];

    public function Users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function Roles()
    {
        return $this->belongsTo(Roles::class, 'roles_id');
    }
}
