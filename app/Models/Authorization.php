<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $fillable = ['role', 'permission'];
    public function getPermissionAttribute($permission)
    {
        return json_decode($permission);
    }
    public function admins(){
        return $this->hasMany(Admin::class,'role_id');
    }
}
