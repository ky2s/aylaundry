<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class)->withDefault([
            'service_name' => 'Unknown Customer',
        ]);
    }
}
