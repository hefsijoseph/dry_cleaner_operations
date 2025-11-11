@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">Add customer</div>

                <div class="card-body">
                    <a href="{{ route('customers.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('customers.store') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="">Name:</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Email:</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="mt-2">
                            <label for="">Phone:</label>
                            <input type="tel" name="phone" class="form-control">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                           <div class="mt-2">
                            <label for="">Password:</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                           {{-- Address --}}
                        <div class="mt-2">
                            <label for="address_id">Addresses:</label>
                            <select name="address_id" id="address_id" class="form-control" **required**>
                                {{-- Set the value to NULL (or keep it empty) and remove 'selected' --}}
                                {{-- The 'disabled' attribute prevents it from being selected via script --}}
                                <option value="" disabled>-- Select address --</option>

                                @foreach($addresses as $key => $address)
                                {{-- Make sure you're using the correct ID column here (most likely $address->id) --}}
                                <option value="{{ $address->id }}">{{ $address->address }}</option>
                                @endforeach
                            </select>
                            @error('address_id')
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
