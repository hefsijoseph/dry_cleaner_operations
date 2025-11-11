@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show Address</div>

                <div class="card-body">
                    <a href="{{ route('addresses.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $address->id }}</p>
                     <p><strong>Address: </strong>{{ $address->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection