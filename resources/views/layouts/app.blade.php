<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CertiVerify | Authenticate Your Credentials</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="bg-glow"></div>

<header>
    <div class="logo">Certi<span>Verify</span></div>
</header>

<main>
    @yield('content')
</main>

<footer style="text-align: center; padding: 2rem; color: #444; font-size: 0.9rem;">
    &copy; 2026 CertiVerify Secure Protocol. All Rights Reserved.
</footer>

</body>

<script src="{{ asset('js/script.js') }}"></script>
</html>
