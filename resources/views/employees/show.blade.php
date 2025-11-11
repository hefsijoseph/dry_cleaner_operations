@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show employee</div>

                <div class="card-body">
                    <a href="{{ route('employees.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $employee->id }}</p>
                     <p><strong>First name: </strong>{{ $employee->first_name }}</p>
                     <p><strong>Middle name: </strong>{{ $employee->middle_name }}</p>
                     <p><strong>Last name: </strong>{{ $employee->last_name }}</p>
                     <p><strong>Email: </strong>{{ $employee->email }}</p>
                      <p><strong>Phone: </strong>{{ $employee->phone }}</p>
                       <p><strong>Address: </strong>{{ $employee->address->address }}</p>
                       <p><strong>Employee id: </strong>{{ $employee->employee_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection