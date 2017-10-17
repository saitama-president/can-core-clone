@extends('layouts.inner_frame')
{{-- 開始ボタンだけを置く --}}

@section('scripts')

<script>
    $(document).ready(function () {
        se_play("/vendor/se/Signal09.wav", true);
        $("#START").on("click", function () {
            $.ajax({
                url: "/js/home",
                success: function (data) {
                    $("#contents").html(data);

                },
                error: function () {
                    alert("通信に失敗しました。画面をリロードしてください");
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

    .center{
        position: absolute;
        position: absolute;
        left: 50%;
        top: 50%;
        text-align: center;
        color: black;
        background-color: white;        
    }

    .huge{
        font-size: 15vmin;        
    }

    .swing{
        animation-duration: 3s;
        animation-name: swinging;    
        /*animation-fill-mode:forwards;*/
        animation-iteration-count: infinite;
    }


    @keyframes swinging {
        0% {
            transform: rotate(-45deg);
        }
        100% {
            transform: rotate(45deg);
        }
    }
</style>


<div id="START" class="center" >
    <span></span>開始
</div>

<div id="WAIT" class="center huge swing">
    ⚓
</div>


@endsection