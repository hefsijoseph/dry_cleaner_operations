<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable base class
class Customer extends Authenticatable // or extends User
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



     // Ensure you hide the password field
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }


        public function orders(){
        return $this->hasMany(Order::class);
    }
    
}
