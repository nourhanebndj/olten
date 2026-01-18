<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'title',
        'category_id',
        'address',
        'longitude',
        'latitude',
        'price_per_day',
        'delivery_active',
        'client_address',
        'price_per_km',
        'distance_km',
        'delivery_cost',
        'image',
        'user_id',
        'summary',
        'description',
        'available_from',
        'available_until',
        'expires_at',
        'is_approved'
    ];

    protected $casts = [
        'available_from' => 'date',
        'available_until' => 'date',
        'expires_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(AdImage::class);
    }
}
