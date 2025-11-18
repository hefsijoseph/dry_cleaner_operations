<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true to allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Must be present, an integer, and must exist in the 'orders' table
        'order_id' => 'required|integer|exists:orders,id', 
        
        // Must be present, a number, and cannot be negative
        'cost' => 'required|numeric|min:0', 
        
        // You might add a payment method field here if you add it to the form
        // 'payment_method' => 'sometimes|string|max:50',


        // This rule handles the checkbox: 'sometimes' means the field 
        // is optional (unchecked boxes don't send data), and 'boolean' 
        // ensures it is treated as a 0 or 1.
        'is_paid' => 'sometimes|boolean',
        ];
    }
}
