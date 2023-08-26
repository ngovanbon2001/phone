<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'image_url',
        'price',
        'old_price',
        'description',
        'tags',
        'is_best_sell',
        'is_new',
        'sort_order',
        'active',
        'amount',
        'specifications'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    // protected $casts = [
    //     'specifications' => 'array',
    // ];
}