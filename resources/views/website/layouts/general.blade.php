
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perumda Jepara</title>

    <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

        <!-- Add the evo-calendar.css for styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('user/css/bootstrap.css')}}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{asset('user/css/animate.min.css')}}">

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/font-awesome.css')}}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/feather-icon.css')}}">

    <!-- slick css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" rel="stylesheet">
    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/bulk-style.css')}}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('user/css/style.css')}}">

    <!-- Custome Css -->
    <link rel="stylesheet" href="{{ asset('user/css/custome.css') }}">

    @yield('css')

    @yield('meta')
</head>

<body class="theme-color-2 bg-effect">

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    @include('website.layouts.header')

    @yield('content')

    @include('website.layouts.footer')



    <!-- Tap to top start -->
    <div class="theme-option">
        <div class="setting-box mb-3">

        </div>

        <div class="">
            <a href="" class="">
                <img src="{{asset('user/logo/whatsapp.png')}}" alt="" style="width: 60px; height:60px;">
            </a>
        </div>
    </div>
    <!-- Tap to top end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{asset('user/js/jquery-3.6.0.min.js')}}"></script>

    <!-- jquery ui-->
    <script src="{{asset('user/js/jquery-ui.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('user/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('user/js/popper.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('user/js/feather.min.js')}}"></script>
    <script src="{{asset('user/js/feather-icon.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{asset('user/js/lazysizes.min.js')}}"></script>

    <!-- Slick js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('user/js/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('user/js/custom_slick.js')}}"></script>
    <!-- Fly Cart Js -->
    <script src="{{asset('user/js/fly-cart.js')}}"></script>

    <!-- script js -->
    <script src="{{asset('user/js/script.js')}}"></script>

    @yield('js')
</body>

</html>
