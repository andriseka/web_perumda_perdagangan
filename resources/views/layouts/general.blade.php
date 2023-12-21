<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="{{ asset('assets/logo/favicon.png') }}" />

        <title>Admin Perumda Jepara</title>

        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        @yield('css')

    </head>

    <body>
        <div class="wrapper">
            @include('sweetalert::alert')
            @include('layouts.sidebar')

            <div class="main">
                @include('layouts.header')

                <main class="content">
                    <div class="container-fluid p-0">
                        @yield('content')
                    </div>
                </main>

                @include('layouts.footer')
            </div>
        </div>

        <script src="{{ asset('assets/js/app.js') }}"></script>

        @yield('js')
    </body>

</html>
