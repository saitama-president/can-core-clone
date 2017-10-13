<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    @yield('styles')
    @yield('scripts')
  </head>
  <body>
    
    <form action="{{ route('logout') }}" method="POST">
      {{csrf_field()}}
      <button>ログアウト</button>
    </form>
    
    
    @yield('contents')
    
  </body>
</html>
