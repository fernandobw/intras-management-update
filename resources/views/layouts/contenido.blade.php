<!DOCTYPE html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Management Update</title>

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

      
      <link href="{{ URL::asset('frontend/css/app.css') }}" rel="stylesheet" type="text/css" >
      
  </head>

  <body>

    @yield('content')


    


     



    <script type="text/javascript" src="{{ URL::asset('frontend/js/jquery-latest.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('frontend/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('frontend/js/all.js') }}"></script>
  </body>

  </html>