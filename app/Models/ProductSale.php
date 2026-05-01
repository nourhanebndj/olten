<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $fillable = [
        'product_id',
        'buyer_id',
        'user_id',
        'quantity',
        'total_price',
        'status',
        'address',
        'phone',
        'payment_intent_id',
        'delivery_requested',    
        'delivery_cost',    
        'delivery_distance_km',    
        'delivery_address'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
