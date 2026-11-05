<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:employee-list|employee-create|employee-edit|employee-delete'], ["only" => ["index", "show"]]);
        $this->middleware(['permission:employee-create'], ["only" => ["create", "store"]]);
        $this->middleware(['permission:employee-edit'], ["only" => ["edit", "update"]]);
        $this->middleware(['permission:employee-delete'], ["only" => ["destroy"]]);
    }
    /**
     * Display a listing of the resource.
     * 
     */
    public function index(Request $request)
    {

        // Get the authenticated employee
        // $employee = Auth::guard('employee')->user();

        // Make sure an employee is logged in
        // if (!$employee) {
        //     abort(403, 'No employee is logged in');
        // }

        // Debug: list all permissions of this employee
        // dd($employee->getAllPermissions()->pluck('name'));

        // $employees = Employee::with('address')->orderBy('created_at', 'desc')->paginate(15);
        // Pass the logged-in employee explicitly

        $search = $request->search;

        $employees = Employee::with('address')       // load relation
            ->search($search)                        // apply search scope
            ->orderBy('created_at', 'desc')          // sort employees
            ->paginate(10);                          // paginate results
        $authEmployee = Auth::guard('employee')->user();
        return view("employees.index", compact("employees", "authEmployee", "search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $addresses = Address::all();
        $roles = Role::all();
        return view("employees.create", compact("addresses", "roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate input
        $validatedData = $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email',
            'phone'       => 'required|string|max:10',
            'password'    => 'required|min:8',
            'employee_id' => 'required|string|max:30|unique:employees,employee_id',
            'address_id'  => 'required|integer|exists:addresses,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 3. Upload employee image
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')
                ->store('employees', 'public');
        }

        // 4. Create employee
        $employee = Employee::create($validatedData);

        // 5. Assign roles
        $employee->syncRoles($request->roles);

        // 6. Redirect
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);

        return view("employees.show", compact("employee"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $addresses = Address::all();
        $roles = Role::all();
        return view("employees.edit", compact("employee", "addresses", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        // 1. Validate
        $validatedData = $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email,' . $id,
            'phone'       => 'required|string|max:10',
            'password'    => 'nullable|min:8',
            'employee_id' => 'required|string|max:30|unique:employees,employee_id,' . $id,
            'address_id'  => 'required|integer|exists:addresses,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Hash password if provided
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // 3. Handle image upload
        if ($request->hasFile('image')) {

            // Delete old image
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }

            // Store new image
            $validatedData['image'] = $request->file('image')
                ->store('employees', 'public');
        }

        // 4. Update employee
        $employee->update($validatedData);

        // 5. Update roles
        $employee->syncRoles($request->roles);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route("employees.index")->with("deleted", "Employee deleted successfully.");
    }


    public function liveSearch(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with('address')
            ->search($search)
            ->orderBy('created_at', 'desc')
            ->take(20) // return limited results for speed
            ->get();

        return response()->json($employees);
    }
}
