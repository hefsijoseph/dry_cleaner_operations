@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show Order for <strong>{{ $order->item->title }}</strong> </div>

                <div class="card-body">
                    <a href="{{ route('orders.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $order->id }}</p>
                     <p><strong>Order name: </strong>{{ $order->order_name }}</p>
                      <p><strong>Item title: </strong>{{ $order->item->title }}</p>
                       <p><strong>Item description: </strong>{{ $order->item->description }}</p>
                     <p><strong>Customer: </strong>{{ $order->customer->name }}</p>
                     <p><strong>Assigned to: </strong>{{ $order->employee->first_name }}  {{ $order->employee->last_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection