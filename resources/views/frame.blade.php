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

<script>
    $(document).on("load",function(){
        check_login();
    });
    
    function check_login(){
        $.ajax({
           url:"",
           
           success:function(){               
               $("#frame").attr({"src":"/index"});
           },
           error:function(){
               alert("");
               
               
               //エンドレス実行
               
           }
            
        }); 
    }
    
    function try_login(){
        $.ajax({
           url:"",
           
           success:function(){               
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
        display: none;
    }
</style>

<div id="LOGIN">
    
</div>


<iframe id="frame" src="{{url('/loading.html')}}"></iframe>

@endsection