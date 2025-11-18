@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Roles</div>

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
                                <th width="60px">Id</th>
                                <th>Name</th>
                                <th width="300px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                        <a href="{{ route('roles.edit' , $role->id )}}" class="btn btn-primary btn-sm">Edit</a>
                                       
                                        <a href="{{ route('roles.show' , $role->id )}}" class="btn btn-info btn-sm">Show</a>
                                       
                                        <button class="btn btn-danger btn-sm">delete</button></form>
                                    
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $s->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
