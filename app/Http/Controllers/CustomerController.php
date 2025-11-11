<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('address')->orderBy('created_at','desc')->paginate(15);
        return view("customers.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $addresses = Address::all();
        return view("customers.create", compact("addresses"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // 1. Validation (Looks correct, but ensure 'addresses' table ID column is 'id')
    $validatedData = $request->validate([
        'name'  => 'required|string|max:255',
        'email'       => 'required|email|unique:customers,email', // Added unique rule
        'phone'       => 'required|string|max:10', // Consider using regex for proper phone format
        'password'    => 'required|min:8', // Added minimum length for security
        // IMPORTANT: Ensure your addresses table's primary key is 'id'. If it's 'address_id', change the rule to 'exists:addresses,address_id'
        'address_id'  => 'required|integer|exists:addresses,id',
    ]);

    // 2. Hash the Password (CRITICAL SECURITY STEP)
    $validatedData['password'] = Hash::make($validatedData['password']);

    // 3. Create the Employee
    // This will only work if the fields are in the $fillable array in the Employee model.
    Customer::create($validatedData);

    // 4. Redirect with a success message
    return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view("customers.show", compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
         $addresses = Address::all();
        return view("customers.edit", compact("customer","addresses"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // 1️⃣ Find the customer or fail
    $customer = Customer::findOrFail($id);
               // 1. Validation (Looks correct, but ensure 'addresses' table ID column is 'id')
    $validatedData = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $id,// Added unique rule
        'phone'       => 'required|string|max:10', // Consider using regex for proper phone format
        'password'    => 'nullable|min:8', // Added minimum length for security
        // IMPORTANT: Ensure your addresses table's primary key is 'id'. If it's 'address_id', change the rule to 'exists:addresses,address_id'
        'address_id'  => 'required|integer|exists:addresses,id',
    ]);

    // 2. Hash the Password (CRITICAL SECURITY STEP)
    $validatedData['password'] = Hash::make($validatedData['password']);

     // 3️⃣ Update password only if provided
    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']); // Don’t overwrite existing password
    }

     // 4️⃣ Update the employee
    $customer->update($validatedData);

    // 5️⃣ Redirect with success message
    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route("customers.index")->
        with("success", "Customer deleted.");
    }
}
