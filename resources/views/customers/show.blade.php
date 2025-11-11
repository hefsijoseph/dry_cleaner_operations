@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show customer</div>

                <div class="card-body">
                    <a href="{{ route('customers.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $customer->id }}</p>
                     <p><strong>Name: </strong>{{ $customer->name }}</p>
                     <p><strong>Email: </strong>{{ $customer->email }}</p>
                      <p><strong>Phone: </strong>{{ $customer->phone }}</p>
                       <p><strong>Address id: </strong>{{ $customer->address->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection