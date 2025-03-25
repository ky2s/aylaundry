<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'order_id',
        'service_id',
        'service_name',
        'price_per_kg',
        'price_per_item',
        'quantity',
        'sub_total',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}
