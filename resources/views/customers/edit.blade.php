@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">Edit customer</div>

                <div class="card-body">
                    <a href="{{ route('customers.index')}}" class="btn btn-info">Back</a>
                   {{-- 1. Update Form Action to 'update' route --}}
                {{-- 2. Pass the employee ID to the route --}}
                <form action="{{ route('customers.update', $customer) }}" method="POST">
                    @csrf
                    {{-- 2. Method Spoofing for PUT request --}}
                    @method('PUT')
                        <div class="mt-2">
                            <label for="">Name:</label>
                            <input type="text" name="name" 
                            class="form-control"
                             value="{{ old('name', $customer->name) }}"
                            >
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Email:</label>
                            <input type="email" name="email"
                             class="form-control"
                             value="{{ old('email', $customer->email) }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="mt-2">
                            <label for="">Phone:</label>
                            <input type="tel" name="phone" 
                            class="form-control"
                              value="{{ old('phone', $customer->phone) }}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                           <div class="mt-2">
                            <label for="">Password:</label>
                            <input type="password" name="password"

                             class="form-control"
                               {{-- NOTE: Password fields are usually left blank on edit forms for security --}}
                            placeholder="Leave blank to keep current password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                           {{-- Address --}}
                          <div class="mt-2">
                        <label for="address_id">Addresses:</label>
                        <select name="address_id" id="address_id" class="form-control" required>
                            
                            {{-- Default option is now just disabled --}}
                            <option value="" disabled>-- Select address --</option> 

                            @foreach($addresses as $key => $address)
                                @php
                                    // Determine if this address should be selected
                                    $isSelected = ($address->id == old('address_id', $customer->address_id));
                                @endphp
                                <option 
                                    value="{{ $address->id }}"
                                    {{-- 4. Field Population: Check if the address ID matches the employee's current address_id or old input --}}
                                    {{ $isSelected ? 'selected' : '' }}
                                >
                                    {{ $address->address }}
                                </option>
                            @endforeach
                        </select>
                        @error('address_id')
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


            
