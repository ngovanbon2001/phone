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
        'specifications',
        'color',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id', 'id');
    }

    public function productColor()
    {
        return $this->hasMany(Product_color::class, 'product_id', 'id');
    }

    // public function getAmountAttribute() {
    //     return $this->productColor->sum('amount_color');
    // }

    // protected $appends = ['amount'];

    // protected $casts = [
    //     'specifications' => 'array',
    // ];
}