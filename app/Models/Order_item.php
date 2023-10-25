<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_item extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'order_items';
    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'product_price',
        'product_quantity',
        'status',
        'color',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
