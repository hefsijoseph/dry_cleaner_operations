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


                         <!-- Green Alert (Success / Create / Edit) -->
                    @if (session('success'))
                    <div style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Red Alert (Deletion) -->
                    @if (session('deleted'))
                    <div style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
                        {{ session('deleted') }}
                    </div>
                    @endif
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
                                <td>
                                    {!! $payment->is_paid
                                    ? '<span style="color:green">✔</span>'
                                    : '<span style="color:red">✖</span>'
                                    !!}
                                </td>


                                <td>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        @can('payment-edit',$authEmployee)
                                        <a href="{{ route('payments.edit' , $payment->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('payment-list',$authEmployee)
                                        <a href="{{ route('payments.show' , $payment->id )}}" class="btn btn-info btn-sm">View</a>
                                        @endcan
                                        @can('payment-delete',$authEmployee)
                                        <button class="btn btn-danger btn-sm">Delete</button></form>
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
