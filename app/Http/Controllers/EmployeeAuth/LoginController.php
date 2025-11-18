<?php

namespace App\Http\Controllers\EmployeeAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the application's employee login form.
     * This assumes you have a view at resources/views/employee_auth/login.blade.php
     */
    public function showLoginForm(): View
    {
        return view('employee_auth.login');
    }

    /**
     * Handle a login request to the application using the 'employee' guard.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. The critical step: Use the dedicated 'employee' guard to attempt login
        if (Auth::guard('employee')->attempt($credentials, $request->boolean('remember'))) {
            
            // Authentication successful!
            $request->session()->regenerate();

            // Redirect to the intended employee dashboard route (e.g., /employee/dashboard)
            return redirect()->intended(route('employee.dashboard')); 
        }

        // 3. Authentication failed
        // Throw a validation error back to the form
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    
    /**
     * Log the employee out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect back to the employee login page
        return redirect(route('employee.login'));
    }
}