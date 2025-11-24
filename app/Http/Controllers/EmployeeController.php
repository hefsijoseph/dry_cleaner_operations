<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
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
        return view("employees.index", compact("employees", "authEmployee","search"));
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


        //   dd($request->all());
        // 1. Validation (Looks correct, but ensure 'addresses' table ID column is 'id')
        $validatedData = $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255', // Changed to 'nullable' since it's not 'required'
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email', // Added unique rule
            'phone'       => 'required|string|max:10', // Consider using regex for proper phone format
            'password'    => 'required|min:8', // Added minimum length for security
            'employee_id' => 'required|string|max:30', // Added unique rule
            // IMPORTANT: Ensure your addresses table's primary key is 'id'. If it's 'address_id', change the rule to 'exists:addresses,address_id'
            'address_id'  => 'required|integer|exists:addresses,id',
        ]);

        // 2. Hash the Password (CRITICAL SECURITY STEP)
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 3. Create the Employee
        // This will only work if the fields are in the $fillable array in the Employee model.
        $employee =  Employee::create($validatedData);
        $employee->syncRoles($request->roles);

        // 4. Redirect with a success message
        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
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
        // 1️⃣ Find the employee or fail
        $employee = Employee::findOrFail($id);

        // 2️⃣ Validate input
        $validatedData = $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:employees,email,' . $id, // ✅ Ignore current employee's email
            'phone'       => 'required|string|max:10',
            'password'    => 'nullable|min:8', // ✅ Make nullable (don’t force user to re-enter password)
            'employee_id' => 'required|string|max:30', // ✅ Unique except current record
            'address_id'  => 'required|integer|exists:addresses,id', // ✅ Matches your DB column name
        ]);

        // 3️⃣ Update password only if provided
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Don’t overwrite existing password
        }

        // 4️⃣ Update the employee
        $employee->update($validatedData);
        $employee->syncRoles($request->roles);
        // 5️⃣ Redirect with success message
        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route("employees.index")->with("success", "Employee deleted.");
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
