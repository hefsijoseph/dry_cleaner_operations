@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>

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
                    <a href="{{ route('employees.index') }}" class="btn btn-info mb-3">Back</a>
                    <form method="GET" action="{{ route('employees.index') }}">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search employees..." autocomplete="off" class="form-control" id="employee-search">



                        <div id="results"></div>
                        <button type="submit">Search</button>
                    </form>

                    <table class="table table-striped table-bordered">
                        {{-- {{ dd(Auth::guard('employee')->check(), Auth::guard('employee')->user());
}} --}}
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $key => $employee)
                            <tr>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    @foreach($employee->getRoleNames() as $key => $role)
                                    <button class="btn btn-success btn-sm">
                                        {{ $role }}
                                    </button>
                                    @endforeach
                                </td>
                                <td>

                                    {{-- Logged in employee: {{ $authEmployee->name ?? 'null' }}<br> --}}
                                    {{-- Has edit permission? {{ $authEmployee->can('employee-edit') ? 'yes' : 'no' }}@php $authEmployee = Auth::guard('employee')->user(); @endphp --}}

                                    @can('employee-edit',$authEmployee)
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endcan

                                    @can('employee-list', $authEmployee)
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Show</a>
                                    @endcan

                                    @can('employee-delete', $authEmployee)
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('employee-search').addEventListener('keyup', function() {
    let search = this.value;

    fetch("{{ route('employees.live-search') }}?search=" + search)
        .then(response => response.json())
        .then(data => {
            let html = '';

            if (data.length === 0) {
                html = '<p>No results found</p>';
            } else {
                data.forEach(emp => {
                    html += `
                        <div style="padding: 6px; border-bottom: 1px solid #eee;">
                            <strong>${emp.first_name} ${emp.last_name}</strong> <br>
                            Email: ${emp.email ?? '-'} <br>
                            Phone: ${emp.phone ?? '-'}
                        </div>
                    `;
                });
            }

            document.getElementById('results').innerHTML = html;
        });
});
</script>

@endsection
