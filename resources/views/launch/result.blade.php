@extends('layouts.frame')

@section('styles')
<link rel="stylesheet" href="{{url('css/play.css')}}" >
  
@endsection

{{--基本Json通信のみとするので表示系は扱わないが、画面サンプル--}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script>


</script>
@endsection

@section('contents')



<a href="/home">戻る</a>
@endsection