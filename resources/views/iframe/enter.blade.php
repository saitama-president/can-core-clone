@extends('layouts.inner_frame')
{{-- 開始ボタンだけを置く --}}

@section('scripts')

<script>
    $(document).ready(function(){
      se_play("/vendor/herewego.mp3",true);
      $("#START").on("click",function(){
           $.ajax({
            url: "/js/home",
            success: function (data) {
                $("#contents").html(data);
                
            }
        });
        
      });
      
    });

    function start() {
        

        //$('body').append('<script>alert("アラート");<\/script>');
    }
</script>

@endsection

@section('styles')

@endsection

@section('contents')


<style>
    #START{
        position: absolute;
        left: 50%;
        top: 50%;
        text-align: center;
        color: black;
        background-color: white;

    }

</style>


<div id="START" >開始</div>


@endsection