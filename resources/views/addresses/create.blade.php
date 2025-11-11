@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">Add address</div>

                <div class="card-body">
                    <a href="{{ route('addresses.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('addresses.store') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="">Enter address:</label>
                            <input type="text" name="address" class="form-control">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       
                        
                      


                            {{-- <div class="mt-2">
                            <label for="">Roles:</label>
                          <select name="roles[]" id="" multiple>
                          <option value="">--Select role--</option>
                          @foreach($roles as $key => $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach

                          </select>
                        </div> --}}
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
