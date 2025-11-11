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
                                       @session('success')
        <div class="alert alert-success">
        {{ $value }}
        </div>
        @endsession 
        @session('added')
        <div class="alert alert-success">
        {{ $value }}
        </div>
        @endsession 
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
                            <form action="{{ route('addresses.destroy', $address->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('addresses.edit' , $address->id )}}" class="btn btn-primary btn-sm">Edit</a>
                              <a href="{{ route('addresses.show' , $address->id )}}"  class="btn btn-info btn-sm">Show</a>
                            <button  class="btn btn-danger btn-sm">delete</button></form>
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
