<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
          // Set this to true to allow the request to proceed. 
        // In a real application, you might check if the user is 
        // allowed to modify this specific payment record here.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
               // order_id: Must be required, an integer, and must exist in the 'orders' table.
            'order_id' => 'required|integer|exists:orders,id', 
            
            // cost: Must be required, a number, and cannot be negative. We use 'step=0.01'
            // in the blade file, so numeric is appropriate.
            'cost' => 'required|numeric|min:0', 
            
            // is_paid: We use 'sometimes' because a checkbox sends nothing 
            // when unchecked, meaning the field is sometimes present.
            'is_paid' => 'sometimes|boolean', 
        ];
    }
}
