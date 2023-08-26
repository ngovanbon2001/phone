<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'token',
        'active',
        'password_resets',
        'permission'
    ];
}
