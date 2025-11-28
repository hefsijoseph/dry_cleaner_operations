{{-- @extends('layouts.layout')

@section('content') --}}

<!DOCTYPE html>
<html>
<head>
    <title>Dry Cleaner Operations Management System - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
      @vite('resources/js/validation.js')
</head>
<body>

    <div class="overlay"></div>

    <div class="system-title">
        <h1>Dry Cleaner Operations Management System <br>(DCO-MS)</h1>
    </div>

    <div class="login-container">
        <form method="POST" action="/employees/login" class="login-form">
            @csrf
            <h2>Employee Login</h2>

            <input type="email" name="email" placeholder="Email" required>
            <p>Email must a valid address, e.g.me@gmail.com </p>
            <input type="password" name="password" placeholder="Password" required>
            <p>Password must alphanumeric (@ and - are also allowed) be 8 - 20 characters</p>

            <div class="options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="/password/reset" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>





{{-- @endsection --}}
