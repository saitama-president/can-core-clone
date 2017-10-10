<html>

  <head>

    <meta charset="UTF-8">
    <title>{{config("app.name")}}</title>

  </head>  

  <body>
    トップ画面
    <a href="{{url('login')}}">ログイン</a>
    <a href="{{url('register')}}">新規登録</a>
@if(config("app.debug")) 
    <a href="{{url('/debug/login')}}">強制ログイン</a>
@endif
  </body>
</html>



