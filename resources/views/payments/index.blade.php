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
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="post" class="delete-form">
                                        @csrf
                                        @method('delete')
                                        @can('payment-edit',$authEmployee)
                                        <a href="{{ route('payments.edit' , $payment->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('payment-list',$authEmployee)
                                        <a href="{{ route('payments.show' , $payment->id )}}" class="btn btn-info btn-sm">View</a>
                                        @endcan
                                        @can('payment-delete',$authEmployee)
                                        <button type="button" class="btn btn-danger btn-sm open-modal-btn">Delete</button>
                                    @endcan
                                     <!-- Custom Modal per row -->
                                        <dialog class="delete-modal">
                                            <h3 style="margin-top: 0;">Confirm Deletion</h3>
                                            <p>Are you sure you want to delete payment for order <strong>{{ $payment->order->order_name }}</strong> ? This action cannot be undone.</p>
                                            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                                                <button type="button" class="cancel-btn btn btn-secondary btn-sm">Cancel</button>
                                                <button type="button" class="confirm-btn btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </dialog>
                                    </form>
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
