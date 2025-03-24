<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $casts = [
        'order_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected $fillable = [
        'customer_id',
        'service_id',
        'total_weight',
        'total_price',
        'status',
        'notes',
        'pickup',
        'delivery',
        'order_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => 'Unknown Customer',
        ]);
    }

    public function service()
    {
        return $this->belongsTo(Services::class)->withDefault([
            'service_name' => 'Unknown Customer',
        ]);
    }
}
