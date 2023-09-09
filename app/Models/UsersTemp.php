<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersTemp extends Model
{
    use HasFactory;

    protected $table = 'users_temp';
    protected $fillable = [
        'username',
        'email',
        'phone',
        'code',
        'password',
    ];
}
