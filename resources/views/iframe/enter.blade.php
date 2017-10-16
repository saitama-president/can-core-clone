@extends('layouts.inner_frame')
{{-- 開始ボタンだけを置く --}}

@section('scripts')



@endsection

@section('styles')

@endsection

@section('contents')

<script>

    function start() {
        $.ajax({
            url: "/js/home",
            success: function (data) {
                $("#contents").html(data);
            }
        });
        //$('body').append('<script>alert("アラート");<\/script>');

        setTimeout(function () {
            //document.location.href="/index";
            //
        }, 3000);
    }
    $(document).ready(
            function () {
                se_play("/vendor/herewego.mp3");
            }
    );


</script>
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


<div id="START" onclick="start();">開始</div>


@endsection