@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">Add Employee</div>

                <div class="card-body">
                    <a href="{{ route('employees.index') }}" class="btn btn-info mb-3">Back</a>

                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        {{-- First Name --}}
                        <div class="mt-2">
                            <label for="first_name">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Middle Name --}}
                        <div class="mt-2">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}">
                            @error('middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="mt-2">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mt-2">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mt-2">
                            <label for="phone">Phone:</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mt-2">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Employee ID --}}
                        <div class="mt-2">
                            <label for="employee_id">Employee ID:</label>
                            <input type="text" name="employee_id" id="employee_id" class="form-control" value="{{ old('employee_id') }}">
                            @error('employee_id')
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

                         <div class="mt-2">
                            <label for="role_id">Roles:</label>
                            <select name="roles[]" id="role_id" class="form-control" **required** multiple>
                                {{-- Set the value to NULL (or keep it empty) and remove 'selected' --}}
                                {{-- The 'disabled' attribute prevents it from being selected via script --}}
                                <option value="" disabled>-- Select address --</option>

                                @foreach($roles as $key => $role)
                                {{-- Make sure you're using the correct ID column here (most likely $address->id) --}}
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
