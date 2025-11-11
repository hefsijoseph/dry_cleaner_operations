@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div class="card">

                <div class="card-header">Add item</div>

                <div class="card-body">
                    <a href="{{ route('items.index')}}" class="btn btn-info">Back</a>
                    <form action="{{ route('items.store') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="">Title:</label>
                            <input type="text" name="title" class="form-control">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                           <div class="mt-2">
                            <label for="">Description:</label>
                            <textarea name="description" id="" class="form-control"> </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button  type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
