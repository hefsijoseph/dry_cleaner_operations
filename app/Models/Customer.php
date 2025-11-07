<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

       protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address_id',
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }


        public function orders(){
        return $this->hasMany(Order::class);
    }
    
}
