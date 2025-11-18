@extends('layouts.layout')

@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="card">

            <div class="card-header">Edit Payment #{{ $payment->id }}</div>

            <div class="card-body">
                <a href="{{ route('payments.index')}}" class="btn btn-info">Back</a>
                
                {{-- 1. UPDATE FORM ACTION and ADD PUT METHOD --}}
                <form action="{{ route('payments.update', $payment->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    {{-- Order Selection (Pre-selected) --}}
                    <div class="mt-2">
                        <label for="order_id">Select Order to Pay:</label>
                        <select name="order_id" id="order_id" required class="form-control">
                            <option value="" disabled>-- Select an Order --</option>
                            @foreach($orders as $order)
                                {{-- 2. ADD 'selected' ATTRIBUTE --}}
                                <option value="{{ $order->id }}" 
                                    {{ (old('order_id', $payment->order_id) == $order->id) ? 'selected' : '' }}
                                >
                                    {{ $order->order_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('order_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Customer Name Display (Initialized via PHP/AJAX) --}}
                    <div>
                        <label>Customer Name:</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="customer_name_display" 
                            {{-- Initialize with current customer name --}}
                            value="{{ $payment->order->customer->name ?? 'Select an Order' }}" 
                            readonly
                        >
                    </div>
                    
                    {{-- Cost/Price (Pre-populated) --}}
                    <div class="mt-2">
                        <label for="cost">Cost/Price:</label>
                        <input 
                            type="number" 
                            name="cost" 
                            id="cost" 
                            step="0.01" 
                            min="0" 
                            {{-- 2. ADD VALUE FROM PAYMENT OBJECT --}}
                            value="{{ old('cost', $payment->cost) }}" 
                            required 
                            placeholder="e.g., 9.99" 
                            class="form-control"
                        >
                        @error('cost')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Is Paid Checkbox (Pre-populated) --}}
                    <div class="mt-2 form-check">
                        <input 
                            type="checkbox" 
                            name="is_paid" 
                            id="is_paid" 
                            value="1" 
                            class="form-check-input" 
                            {{-- 2. CHECK IF PAYMENT IS CURRENTLY PAID --}}
                            {{ old('is_paid', $payment->is_paid) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="is_paid">
                            Payment is Completed
                        </label>
                        @error('is_paid')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-success">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// This script handles the dynamic loading of the customer name when the order selection changes.
// It remains the same as the create view, but the initial value is set by PHP above.
$(document).ready(function() {
// Function to fetch and update customer name
function updateCustomerName(orderId) {
if (orderId) {
var url = '{{ route("payments.get_customer", ":order") }}';
url = url.replace(':order', orderId);

            $.ajax({
                url: url,
                type: &quot;GET&quot;,
                dataType: &quot;json&quot;,
                success: function(data) {
                    $(&#39;#customer_name_display&#39;).val(data.customer_name);
                },
                error: function(xhr, status, error) {
                    console.error(&quot;Error fetching customer name:&quot;, error);
                    $(&#39;#customer_name_display&#39;).val(&quot;Error loading customer.&quot;);
                }
            });
        } else {
            $(&#39;#customer_name_display&#39;).val(&quot;Please select an order&quot;);
        }
    }

    // On initial load, update the customer name based on the selected order (if any)
    updateCustomerName($(&#39;#order_id&#39;).val());

    // Attach event listener for changes
    $(&#39;#order_id&#39;).on(&#39;change&#39;, function() {
        updateCustomerName($(this).val());
    });
});


</script>

@endsection