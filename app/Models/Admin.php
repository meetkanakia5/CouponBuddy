<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

        protected $fillable = [
            'first_name', 'last_name', 'name', 'email', 'password', 'mobile',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
