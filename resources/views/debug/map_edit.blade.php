@extends('layouts.debug')

@section('head')

<style>
    canvas{
        width: 100vmin;
        min-width: 100vmin;        
        max-width: 100vmin;
        height:100vmin;
        min-height: 100vmin;
        max-height: 100vmin;
        
        background: gray;
    }
</style>

<script>
    $(document).ready(function(){
        $("#canvas").click(function($e){
            
        });        
    });
</script>

@endsection

@section('body')
<canvas id="canvas">
    
</canvas>

<div>
    <p>あいうえおかきくけこ</p>
</div>

@endsection