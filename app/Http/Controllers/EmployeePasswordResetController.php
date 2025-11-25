<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class EmployeePasswordResetController extends Controller
{
    public function requestForm()
    {
        return view('employee.auth.forgot-password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('employees')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm($token)
    {
        return view('employee.auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $status = Password::broker('employees')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($employee, $password) {
                $employee->password = bcrypt($password);
                $employee->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('employee.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

