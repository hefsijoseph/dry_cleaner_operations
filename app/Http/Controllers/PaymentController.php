<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
// use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Optional type hinting
use App\Http\Requests\StorePaymentRequest; // <--- ADD THIS LINE
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('order')->orderBy('created_at', 'desc')->paginate(15);
        return view("payments.index", compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view("payments.create", compact("orders"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request): RedirectResponse
    {
        // 1. Validation has already occurred successfully

        // $request->validated() contains 'order_id', 'cost', and 'is_paid' (if checked).
        $validatedData = $request->validated();

        // FIX for unchecked checkboxes: If 'is_paid' is not present in the validated data 
        // (meaning the box was unchecked), we manually set it to false (0).
        $validatedData['is_paid'] = $request->has('is_paid');

        // Create the new Payment record
        $payment = Payment::create($validatedData);

        // 3. Redirect the user to the payment index or show page
        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');

        // OR: If you have a show page:
        // return redirect()->route('payments.show', $payment->id)
        //                  ->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1. Fetch the payment record
        $payment = Payment::findOrFail($id);

        // 1. Access the Order object first
        $order = $payment->order;

        // 2. Access the Customer object through the Order
        $customer = $order->customer;

        // 3. Access the name
        $customerName = $customer->name;
        // OR: $customerName = $payment->order->customer->name;

        // Pass the data to a view
        return view('payments.show', compact('payment', 'customerName'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment): View
    {
        // 1. Fetch all orders (for the dropdown list)
        $orders = Order::all();

        // 2. Eager Load Relationships
        // This loads the associated Order and, from that Order, the Customer.
        // This is crucial for pre-populating the "Customer Name" field in the Blade file.
        $payment->load('order.customer');

        // 3. Return the View
        // It passes the specific $payment object (to pre-fill the form) 
        // and the $orders collection (for the dropdown).
        return view('payments.edit', compact('payment', 'orders'));
    }
    /**
     * Update the specified resource in storage.
     */
  public function update(UpdatePaymentRequest $request, Payment $payment): RedirectResponse
    {
        // 1. Validation and Sanitization (handled by UpdatePaymentRequest)
        // We retrieve ONLY the data that passed the validation rules.
        $validatedData = $request->validated();
        
        // 2. Handle the 'is_paid' Checkbox
        // The browser does not send the 'is_paid' field if the checkbox is unchecked.
        // We explicitly check if the field exists in the request.
        // If it exists (checked), it's true (1). If not (unchecked), it's false (0).
        $validatedData['is_paid'] = $request->has('is_paid');

        // 3. Update the Model
        // The $payment variable was automatically retrieved via Route Model Binding.
        $payment->update($validatedData);

        // 4. Redirect
        return redirect()->route('payments.index')
                         ->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Payment $payment): RedirectResponse
    {
        // Laravel's Route Model Binding automatically fetched the Payment record.
        
        // Delete the payment record from the database.
        $payment->delete();

        // Redirect back to the index page with a success message.
        return redirect()->route('payments.index')
                         ->with('success', 'Payment successfully deleted!');
    }


    public function getCustomerByOrder(Order $order)
    {
        // Eager load the customer relationship
        $customerName = $order->customer->name;

        // Return the name as JSON
        return response()->json(['customer_name' => $customerName]);
    }
}
