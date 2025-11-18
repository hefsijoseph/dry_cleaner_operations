@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Show role <strong>{{ $role->name }}</strong></div>

                <div class="card-body">
                    <a href="{{ route('roles.index')}}" class="btn btn-info">Back</a>
                     <p><strong>Id: </strong>{{ $role->id }}</p>
                     <p><strong>Name: </strong>{{ $role->name }}</p>
                     <h4>Permissions: </h4>
                     @foreach($role->permissions as $key => $permission)
                        <p>{{ $permission->name }}</p>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection