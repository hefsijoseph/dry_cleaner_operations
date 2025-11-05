@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      <table class="table table-striped table-bordered">
                      <thead>
                      <tr>
                      <th>ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Address</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                      <td>1</td>
                      <td>pina</td>
                      <td>pina@gmail.com</td>
                      <td>jr</td>
                      </tr>
                      <tr>
                      <td>1</td>
                      <td>pina</td>
                      <td>pina@gmail.com</td>
                      <td>jr</td>
                      </tr>
                      <tr>
                      <td>1</td>
                      <td>pina</td>
                      <td>pina@gmail.com</td>
                      <td>jr</td>
                      </tr>
                      <tr>
                      <td>1</td>
                      <td>pina</td>
                      <td>pina@gmail.com</td>
                      <td>jr</td>
                      </tr>
                      </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
