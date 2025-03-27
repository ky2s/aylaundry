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
        'name',
        'email',
        'phone',
        'address',
        'total_weight',
        'total_price',
        'status',
        'notes',
        'pickup',
        'delivery',
        'payment_method_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => 'Unknown Customer',
        ]);
    }

    public function services()
    {
        return $this->belongsToMany(Services::class, 'order_details')
                    ->withPivot('service_id',
                                'service_name',
                                'price_per_kg',
                                'price_per_item',
                                'estimated_time',
                                'quantity', 
                                'sub_total',
                        );
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
