@extends('layouts.frame')

@section('styles')
<link rel="stylesheet" href="{{url('css/frame.css')}}" >
  
@endsection

{{--IFrameを出すだけの画面。お知らせなども表示--}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script>


</script>
@endsection

@section('contents')

@if(config("app.debug"))
<div>
    <h3>デバッグメニュ</h3>
    @include("debug/play_menu");
</div>
@endif



<div id="frame">
    
    <iframe id="IFRAME" src="{{url('/home')}}"></iframe>
</div>
@endsection