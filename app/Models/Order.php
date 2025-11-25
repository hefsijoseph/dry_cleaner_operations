<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

      protected $fillable = [
        
        'order_name',
        'item_id',
        'item_weight_kg',
        'customer_id',
        'employee_id',
    ];
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;


      public function item(){
        return $this->belongsTo(Item::class);
    }


       public function customer(){
        return $this->belongsTo(Customer::class);
    }

     public function employee(){
        return $this->belongsTo(Employee::class);
    }

      public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function scopeSearch($query, $search)
{
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('order_name', 'LIKE', "%{$search}%")
              ->orWhere('item_weight_kg', 'LIKE', "%{$search}%");
        });
    }

    return $query;
}
}
