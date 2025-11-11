@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show item <strong>{{ $item->title }}</strong></div>

                <div class="card-body">
                    <a href="{{ route('items.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $item->id }}</p>
                     <p><strong>Title: </strong>{{ $item->title }}</p>
                     <p><strong>Description: </strong>{{ $item->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection