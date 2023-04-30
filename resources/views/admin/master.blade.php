<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ URL::asset('images/backgrounds/eshop_icon2.png')}}" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('boots/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/style2.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('icon/all.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <script src="{{URL::asset('boots/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{URL::asset('boots/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('icon/all.js')}}"></script>
    <script src="{{URL::asset('js/script.js')}}"></script>


</head>
<body>
@include('admin/header')

@yield('content')

@include('footer')
</body>
</html>
