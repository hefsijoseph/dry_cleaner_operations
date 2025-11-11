@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Edit order for <strong>{{ $order->item->title }}</strong> </div>

                <div class="card-body">
                    <a href="{{ route('orders.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('put')
                       <div class="mt-2">
                            <label for="">Name:</label>
                            <input type="text" name="order_name"
                             class="form-control"
                              value="{{ old('order_name', $order->order_name) }}">
                            @error('order_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="">Items:</label>
                            <select name="item_id" id="" class="form-control">
                                <option value="" disabled>-- Select item --</option>
                                @foreach($items as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach

                            </select>
                            @error('item_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Customers:</label>
                            <select name="customer_id" id="" class="form-control">
                                <option value="" disabled>-- Select customer --</option>
                                @foreach($customers as $key => $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach

                            </select>
                            @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Assigned to employee:</label>
                            <select name="employee_id" id="" class="form-control">
                                <option value="" disabled>-- Select employee --</option>
                                @foreach($employees as $key => $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                @endforeach

                            </select>
                            @error('employee_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button  type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
