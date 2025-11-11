<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

       protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'password',
        'employee_id',
        'address_id',
    ];


     public function address(){
        return $this->belongsTo(Address::class);
    }

       public function orders(){
        return $this->hasMany(Order::class);
    }
    
}
