<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::all();
        $orders = Order::with('item','customer','employee')->orderBy('created_at','desc')->paginate(15);
        return view("orders.index", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $customers = Customer::all();
        $employees = Employee::all();
        return view("orders.create", compact("customers", "employees", "items"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $validatedData = $request->validate([
        'order_name'  => 'required|string|max:50',
        // IMPORTANT: Ensure your addresses table's primary key is 'id'. If it's 'address_id', change the rule to 'exists:addresses,address_id'
        'item_id'  => 'required|integer|exists:items,id',
         'customer_id'  => 'required|integer|exists:customers,id',
         'employee_id'  => 'required|integer|exists:employees,id',
    ]);

    Order::create($validatedData);

    // 4. Redirect with a success message
    return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order= Order::findOrFail($id);
        return view("orders.show", compact("order"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $items = Item::all();
        $customers = Customer::all();
        $employees = Employee::all();
        return view("orders.edit", compact("order","items","customers", "employees"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
         $validatedData = $request->validate([
        'order_name'  => 'required|string|max:50',
        // IMPORTANT: Ensure your addresses table's primary key is 'id'. If it's 'address_id', change the rule to 'exists:addresses,address_id'
        'item_id'  => 'required|integer|exists:items,id',
         'customer_id'  => 'required|integer|exists:customers,id',
         'employee_id'  => 'required|integer|exists:employees,id',
    ]);


    $order->update($validatedData);

    // 5️⃣ Redirect with success message
    return redirect()
        ->route('orders.index')
        ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route("orders.index")->
        with("success", "Order deleted.");
    }
}
