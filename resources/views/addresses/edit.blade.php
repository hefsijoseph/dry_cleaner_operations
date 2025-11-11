@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Edit address</div>

                <div class="card-body">
                    <a href="{{ route('addresses.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('addresses.update', $address->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mt-2">
                        <div class="mt-2">
                            <label for="">Enter address:</label>
                            <input type="text" name="address" class="form-control" value="{{ $address->address}}">
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
