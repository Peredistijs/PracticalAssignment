<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
