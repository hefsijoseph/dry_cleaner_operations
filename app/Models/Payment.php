<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    // app/Models/Payment.php
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;


    protected $fillable = [
        'order_id',
        'cost',
        'is_paid',
    ];

    // It's also a good idea to cast boolean fields
    protected $casts = [
        'is_paid' => 'boolean',
    ];



public function customer(): HasOneThrough {
    return $this->hasOneThrough(
        Customer::class,  // 1. The final model we wish to access
        Order::class,     // 2. The intermediate model (the one between Payment and Customer)
        'id',             // 3. Foreign key on the *Order* table that links to *Customer* (i.e., customer_id)
        'customer_id',    // 4. Local key on the *Payment* table that links to *Order* (i.e., order_id)
        'order_id'
    );
}

      public function order(){
        return $this->belongsTo(Order::class);
    }

    //   public function customer(){
    //     return $this->belongsTo(Customer::class);
    // }


    
}
