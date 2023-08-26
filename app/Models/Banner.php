<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'banners';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'sort_order',
        'active'
    ];

}
