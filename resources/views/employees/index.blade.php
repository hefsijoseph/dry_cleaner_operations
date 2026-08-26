@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="GET" action="{{ route('employees.index') }}" class="d-flex gap-4 mb-5">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search employee..." autocomplete="off" class="form-control" id="employee-search">
                <button type="submit" class="btn btn-primary">Search</button>
                <div id="results"></div>

            </form>
            <div class="card">
                <div class="card-header">Employees</div>

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
                    <a href="{{ route('employees.index') }}" class="btn btn-info mb-3">Back</a>


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
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        @can('employee-edit',$authEmployee)
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endcan

                                        @can('employee-list', $authEmployee)
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                        @endcan

                                        @can('employee-delete', $authEmployee)

                                        <button  type="button" class="btn btn-danger btn-sm open-modal-btn">Delete</button>
                                        @endcan

                                           <!-- Custom Modal per row -->
                                        <dialog class="delete-modal">
                                            <h3 style="margin-top: 0;">Confirm Deletion</h3>
                                            <p>Are you sure you want to delete employee <strong>{{ $employee->first_name }}</strong> ? This action cannot be undone.</p>
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
