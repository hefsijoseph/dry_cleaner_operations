@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Addresses</div>

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

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $key => $address)
                            <tr>
                                <td>{{ $address->address }}</td>
                                <td>
                                    <form action="{{ route('addresses.destroy', $address->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                        @csrf
                                        @method('delete')


                                        @can('address-edit',$authEmployee)
                                        <a href="{{ route('addresses.edit' , $address->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
                                        @can('address-list',$authEmployee)
                                        <a href="{{ route('addresses.show' , $address->id )}}" class="btn btn-info btn-sm">View</a>
                                        @endcan
                                        @can('address-delete',$authEmployee)
                                        <button class="btn btn-danger btn-sm">Delete</button></form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
