@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show Payment for <strong>{{ $payment->order->order_name }}</strong> </div>

                <div class="card-body">
                    <a href="{{ route('payments.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $payment->id }}</p>
                     <p><strong>Order name: </strong>{{ $payment->order->order_name }}</p>
                      <p><strong>Customer name: </strong>{{ $customerName }}</p>
                       <p><strong>Cost: </strong>{{ $payment->cost}}</p>
                       <p><strong>Is paid: </strong>{{ $payment->is_paid }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection