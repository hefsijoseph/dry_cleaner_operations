<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('employees.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // TRUE or FALSE
        if (Auth::guard('employee')->attempt($credentials, $remember)) {
            return redirect()->route('employees.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employees.login');
    }
}
