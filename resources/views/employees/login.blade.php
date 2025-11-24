{{-- @extends('layouts.layout')

@section('content') --}}

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-container">
    <form method="POST" action="/employees/login" class="login-form">
        @csrf
        <h2>Employee Login</h2>

        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>




{{-- @endsection --}}