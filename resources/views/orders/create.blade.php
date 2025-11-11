@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Add order</div>

                <div class="card-body">
                    <a href="{{ route('orders.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('employees.store') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="">Name:</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                           <div class="mt-2">
                            <label for="">Items:</label>
                          <select name="items[]" id="" class="form-control" >
                          <option value="">-- Select item --</option>
                          @foreach($items as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                          @endforeach

                          </select>
                        </div>
                             <div class="mt-2">
                            <label for="">Customers:</label>
                          <select name="customers[]" id="" class="form-control" >
                          <option value="">-- Select customer --</option>
                          @foreach($customers as $key => $customer)
                            <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                          @endforeach

                          </select>
                        </div>
                           <div class="mt-2">
                            <label for="">Assigned to employee:</label>
                          <select name="employees[]" id="" class="form-control" >
                          <option value="">-- Select employee --</option>
                          @foreach($employees as $key => $employee)
                            <option value="{{ $employee->employee_id }}">{{ $employee->first_name }}  {{ $employee->last_name }}</option>
                          @endforeach

                          </select>
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
