<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_name', 'description', 'price_per_kg',
        'price_per_item', 'estimated_time', 'category_id',
        'is_active', 'image_url'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
                    ->withPivot('quantity', 'sub_total');
    }

}
