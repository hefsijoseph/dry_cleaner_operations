@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
         <form method="GET" action="{{ route('customers.index') }}" class="d-flex gap-4 mb-5">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search customer..." autocomplete="off" class="form-control" id="employee-search">
                <button type="submit" class="btn btn-primary">Search</button>
                <div id="results"></div>

            </form>
            <div class="card">
                <div class="card-header">Customers</div>

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

                    <a href="{{ route('customers.index') }}" class="btn btn-info mb-3">Back</a>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                {{-- <th>ID</th>
                       <th>Email</th> --}}
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $key => $customer)
                            <tr>
                                {{-- <td>{{ $customer->id }}</td>
                                <td>{{ $customer->email }}</td> --}}
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address->address }}</td>
                                <td>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        @can('customer-edit',$authEmployee)
                                        <a href="{{ route('customers.edit' , $customer->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('customer-list',$authEmployee)
                                        <a href="{{ route('customers.show' , $customer->id )}}" class="btn btn-info btn-sm">Show</a>
                                        @endcan
                                        @can('customer-delete',$authEmployee)
                                        <button class="btn btn-danger btn-sm">delete</button></form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
