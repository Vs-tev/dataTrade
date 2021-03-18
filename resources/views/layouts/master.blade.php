<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/rightbar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
        <link href="{{ asset('css/trading.css') }}" rel="stylesheet">
        <link href="{{ asset('css/rules.css') }}" rel="stylesheet">
        <link href="{{ asset('css/plan.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('material-icons/iconfont/material-icons.css') }}">
       
        {{-- TinyMCE text-editor --}}
        <script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>
        {{-- Google fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        
        <title>Trade Data</title>
    </head>
    <body>
        
        <div id="app">
            <div id="cover" class=""></div>
            @include('layouts.sidebar')
            @include('layouts.navbar')
            @include('layouts.rightbar')
            @yield('content')  
        </div>  
        
    </body>
</html>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/myapp.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
@yield('scripts')

