@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Items</div>

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
                       <th>Title</th>
                       <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($items as $key => $item)
                         <tr>
                      {{-- <td>{{ $customer->id }}</td>
                      <td>{{ $customer->email }}</td> --}}
                      <td>{{ $item->title }}</td>
                       <td>
                            <form action="{{ route('items.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('items.edit' , $item->id )}}" class="btn btn-primary btn-sm">Edit</a>
                              <a href="{{ route('items.show' , $item->id )}}"  class="btn btn-info btn-sm">Show</a>
                            <button  class="btn btn-danger btn-sm">delete</button></form>
                            </td>
                      </tr>
                      @endforeach
                     
                      </tbody>
                      </table>
                       {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
