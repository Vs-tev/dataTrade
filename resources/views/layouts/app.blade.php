<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}/Login</title>

    <!-- Styles -->
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth-page.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('material-icons/iconfont/material-icons.css') }}">
</head>
<body class="bg-white">
    <div class="auth-page">
        <main id="register">
            @yield('content')
        </main>
    </div>

    
     <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" async defer></script>

 

</body>
</html>
