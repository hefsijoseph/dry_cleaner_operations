@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Edit order</div>

                <div class="card-body">
                    <a href="{{ route('orders.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mt-2">
                            <label for="">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $order->order_name }}">
                            @error('name')
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
