@extends('layouts.frame')

@section('styles')
<link rel="stylesheet" href="{{url('css/frame.css')}}" >
  
@endsection

{{--IFrameを出すだけの画面。お知らせなども表示
    本画面にはuserは必要ない。
--}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

{{-- ログイン状況を調べて表示する --}}

<script type="text/javascript">
  
    $(document).ready(function(){
        check_login();
    });
    
    function check_login(){
        console.log("ログインチェック...");
        $.ajax({
           url:"/api/is_login",
           cache:false,
           success:function(){ 
              
               setTimeout(function(){
                 $("#frame").attr({"src":"/enter"});
               },500);
               
           },
           error:function(){
               alert("自動ログインに失敗しました");
               $("#LOGIN").removeClass("hide");
               
               //エンドレス実行
               
           }
            
        }); 
    }
    
    function try_login(){
        $.ajax({
           url:"",
           
           success:function(){           
               $("#LOGIN").addClass("hide");
               $("#frame").attr({"src":"/index"});
           },
           error:function(){
               alert("");
               
               
               //エンドレス実行
               
           }
            
        });        
    }
</script>

@endsection

@section('contents')

<style>
    #LOGIN{
        
    }
    
    .hide{
      display: none;
    }
    
</style>

<div id="LOGIN" class="hide">
  <form>
    <input type="text" name="mail" placeholder="メールアドレスを入力"/>
    <input type="password" name="password" placeholder="パスワードを入力"/>
    <button onclick="alert('ログイン');return false;">ログイン</button>
  </form>
</div>


<iframe id="frame" src="{{url('/loading.html')}}"></iframe>

@endsection