<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management Update | {{ $titulo ?? '' }}</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <link href="{{ URL::asset('frontend/css/all.css?v=1') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('frontend/css/app.css?v=1') }}" rel="stylesheet" type="text/css">
    @yield('og_tags')
    @yield('header_styles')
</head>

<body>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-7696125-5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-7696125-5');
    </script>

    @yield('content')

    {{-- <script type="text/javascript" src="{{ URL::asset('frontend/js/jquery-latest.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('frontend/js/app.js?v=1.1') }}"></script>
    @yield('footer_scripts')
</body>

</html>
