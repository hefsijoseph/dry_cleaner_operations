@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">Add payment</div>

                <div class="card-body">
                    <a href="{{ route('payments.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('payments.store') }}" method="post">
                        @csrf

                        {{-- <div class="mt-2">
                            <label for="">Orders:</label>
                            <select name="item_id" id="" class="form-control">
                                <option value="" disabled>-- Select item --</option>
                                @foreach($orders as $key => $order)
                                <option value="{{ $order->id }}">{{ $order->order_name }}</option>
                        @endforeach

                        </select>
                        @error('order_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div> --}}

                <div class="mt-2">
                    <label for="order_id">Select Order to Pay:</label>
                    <select name="order_id" id="order_id" required class="form-control">
                        <option value="" disabled selected>-- Select an Order --</option>
                        @foreach($orders as $order)
                        <option value="{{ $order->id }}">{{ $order->order_name }}</option>
                        @endforeach
                    </select>
                    @error('order_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Customer Name:</label>
                    <input type="text" class="form-control" id="customer_name_display" value="Please select an order" readonly>
                </div>
                <div class="mt-2">
                    <label for="cost">Cost/Price:</label>
                    <input type="number" name="cost" id="cost" step="1" min="0" value="{{ old('cost', $payment->cost ?? '') }}" required placeholder="e.g., 9.99" class="form-control">
                    @error('cost')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-2 form-check">
                    <input type="checkbox" name="is_paid" id="is_paid" value="1" class="form-check-input" {{ old('is_paid') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_paid">
                        Payment is Completed
                    </label>
                    @error('is_paid')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#order_id').on('change', function() {
            var orderId = $(this).val();

            // Check if a valid order was selected
            if (orderId) {
                // Construct the URL using the route helper and the selected ID
                var url = '{{ route("payments.get_customer", ":order") }}';
                url = url.replace(':order', orderId);

                // Make the AJAX request
                $.ajax({
                    url: url
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        // Update the customer name display field with the fetched data
                        $('#customer_name_display').val(data.customer_name);
                    }
                    , error: function(xhr, status, error) {
                        console.error("Error fetching customer name:", error);
                        $('#customer_name_display').val("Error loading customer.");
                    }
                });
            } else {
                $('#customer_name_display').val("Please select an order");
            }
        });
    });

</script>
@endsection
