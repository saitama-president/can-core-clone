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
    
    @yield('styles')
    @yield('scripts')
  </head>
  <body>
    
    {{$user->name}}さん
    <form action="{{ route('logout') }}" method="POST">
      {{csrf_field()}}
      <button>ログアウト</button>
    </form>
    
    
    @yield('contents')
    
  </body>
</html>
