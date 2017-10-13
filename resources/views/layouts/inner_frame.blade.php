<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">	
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    {{-- BGM --}}
    <script src="{{url('/js/audio.js')}}" ></script>
    <script>
        bgm_play('@yield('bgm')');
    </script>
        
    
    @yield('styles')
    @yield('scripts')
  </head>
  <body>    
    @yield('contents')
  </body>
</html>
