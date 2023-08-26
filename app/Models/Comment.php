<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'comment';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'product_id',
        'user_name',
        'product_name',
        'comments'
    ];

}
