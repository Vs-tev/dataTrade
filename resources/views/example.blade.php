<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Document</title>
</head>
<body>   
{{-- <x-card title="vasko" :info="$info"  class="bg-info" >

    <div>Adittional</div>
</x-card> --}}

<x-card :cardtext="$cardtext" :cardname="$cardname" :button="$button">

    <div>content in div</div>
    <x-slot name="sss">bla sss</x-slot> 
</x-card>
<x-subview /> {{-- alle files that are in components can be shown hier --}}

</body>
</html>