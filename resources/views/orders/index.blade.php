@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
         <form method="GET" action="{{ route('orders.index') }}" class="d-flex gap-4 mb-5">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search order..." autocomplete="off" class="form-control" id="employee-search">
                <button type="submit" class="btn btn-primary">Search</button>
                <div id="results"></div>

            </form>
            <div class="card">
                <div class="card-header">Orders</div>

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

                    <a href="{{ route('orders.index') }}" class="btn btn-info mb-3">Back</a>
                    {{-- <a href="{{ route('customers.create') }}" class="btn btn-success mb-2">Create customer</a> --}}
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order name</th>
                                <th>Customer owner</th>
                                <th>Assigned to</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $order)
                            <tr>
                                {{-- <td>{{ $customer->id }}</td>
                                <td>{{ $customer->email }}</td> --}}
                                <td>{{ $order->order_name }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->employee->first_name }} {{ $order->employee->last_name }}</td>
                                <td>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                         @can('order-edit',$authEmployee)
                                        <a href="{{ route('orders.edit' , $order->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                         @can('order-list',$authEmployee)
                                        <a href="{{ route('orders.show' , $order->id )}}" class="btn btn-info btn-sm">Show</a>
                                        @endcan
                                         @can('order-delete',$authEmployee)
                                        <button class="btn btn-danger btn-sm">delete</button></form>
                                  @endcan
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
