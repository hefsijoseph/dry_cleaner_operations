<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;


    protected $fillable = [
        'item_weight_kg',
        'cost',
        'is_paid',
        'order_id',
        'customer_id',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];


      public function orders(){
        return $this->belongsTo(Order::class);
    }

      public function customers(){
        return $this->belongsTo(Customer::class);
    }
}
