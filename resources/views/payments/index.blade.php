@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Payments</div>

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
                    {{-- <a href="{{ route('customers.create') }}" class="btn btn-success mb-2">Create customer</a> --}}
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order name</th>
                                <th>Cost</th>
                                <th>Is paid</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $key => $payment)
                            <tr>
                                <td>{{ $payment->order->order_name }}</td>
                                <td>{{ $payment->cost}}</td>
                                <td>{{ $payment->is_paid}}</td>
                                <td>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                          @can('payment-edit',$authEmployee)
                                        <a href="{{ route('payments.edit' , $payment->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                          @can('payment-list',$authEmployee)
                                        <a href="{{ route('payments.show' , $payment->id )}}" class="btn btn-info btn-sm">Show</a>
                                       @endcan
                                       @can('payment-delete',$authEmployee)
                                        <button class="btn btn-danger btn-sm">delete</button></form>
                               @endcan
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
