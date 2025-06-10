<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['password', 'status', 'email', 'user_name', 'name', 'role_id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function post()
    {
        return $this->hasMany(Post::class, 'admin_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed'
    ];
    public function Role()
    {
        return $this->belongsTo(Authorization::class, 'role_id');
    }
    /**
     * hasAccess
     *
     * @param  mixed $configPermission
     * @return void
     */
    public function hasAccess($configPermission): bool
    {
        $roles = $this->Role;
        if (!$roles)
            return false;
        foreach ($roles->permission as $permission)
            if ($permission == $configPermission ?? false)
                return true;
        return true;
    }
}
