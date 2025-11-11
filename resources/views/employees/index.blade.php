@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @session('success')
        <div class="alert alert-success">
        {{ $value }}
        </div>
        @endsession 
                      <table class="table table-striped table-bordered">
                      <thead>
                      <tr>
                      {{-- <th>ID</th> --}}
                       <th>Username</th>
                       <th>Email</th>
                       {{-- <th>Phone</th>
                       <th>Address</th> --}}
                       <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($employees as $key => $employee)
                         <tr>
                    <td>{{ $employee->first_name }}  {{ $employee->last_name }}</td>
                      <td>{{ $employee->email }}</td>
                     <td>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('employees.edit' , $employee->id )}}" class="btn btn-primary btn-sm">Edit</a>
                              <a href="{{ route('employees.show' , $employee->id )}}"  class="btn btn-info btn-sm">Show</a>
                            <button  class="btn btn-danger btn-sm">delete</button></form>
                            </td>
                      </tr>
                      @endforeach
                     
                      </tbody>
                      </table>
                     {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
