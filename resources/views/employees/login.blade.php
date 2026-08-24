<!DOCTYPE html>
<html>
<head>
    <title>Dry Cleaner Operations Management System - Login</title>
    <link rel="preload" href="{{ asset('images/dry_cleaning.jpg') }}" as="image">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/js/validation.js')
</head>
<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="overlay"></div>

    <div class="system-title">
        <h1>Dry Cleaner Operations Management System <br>(DCO-MS)</h1>
    </div>

    <div class="login-container">
        <form method="POST" action="/employees/login" class="login-form">
            @csrf
            <h2>Employee Login</h2>

            <input type="email" name="email" placeholder="Email"  value="{{ old('email') }}" required>
            <p>Email must a valid address, e.g.me@gmail.com </p>
            <input type="password" name="password" placeholder="Password"  required>
            <p>Password must alphanumeric (@ and - are also allowed) be 8 - 20 characters</p>
       <!-- Display authentication or validation error message -->
        @if ($errors->any())
            <div class="error-message" style="color: red; margin-bottom: 10px; font-weight: bold;">
                {{ $errors->first() }}
            </div>
        @endif
            <div class="options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="/password/reset" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {

    // Preload background image used in your CSS
    const bgImage = new Image();
    bgImage.src = "{{ asset('images/dry_cleaning.jpg') }}";  // <-- EXACT path from your CSS

    bgImage.onload = function () {
        const preloader = document.getElementById("preloader");

        // Fade-out animation
        preloader.style.opacity = "0";

        setTimeout(() => {
            preloader.style.display = "none";
        }, 2000);
    };

});
</script>
</body>
</html>
