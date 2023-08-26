<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'brands';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'image_url',
        'link',
        'sort_order',
        'active'
    ];
}
