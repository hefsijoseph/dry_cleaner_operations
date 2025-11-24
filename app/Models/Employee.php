<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable // or extends User
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, Notifiable, HasRoles;

    // REQUIRED for Spatie to match permissions
    protected $guard_name = 'employee';

    // This method is crucial for Spatie/Blade authorization to work 
    // when using custom guards.
    public function getGuardName(): string
    {
        return 'employee'; 
    }
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


public function scopeSearch($query, $search)
{
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('middle_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%")
              ->orWhere('employee_id', 'LIKE', "%{$search}%");
        });
    }

    return $query;
}


public function getFullNameAttribute()
{
    return $this->first_name . ' ' . $this->last_name;
}
    
}
