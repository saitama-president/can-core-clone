@extends('layouts.debug')

@section('head')

<style>
    
    .num3col{
        width: 3em;
        text-align: right;
    }
    
</style>

<script>
    
    $(document).ready(function(){
        $("#exec_build").click(
                function(){
                    if(!confirm("製造する"))return false;
                    
                    $.ajax({
                        url:"/api/create",
                        method:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            "type":1,
                            "L":$("#CREATE_NEW [name=L]").val(),
                            "A":$("#CREATE_NEW [name=A]").val(),
                            "B":$("#CREATE_NEW [name=B]").val(),
                            "C":$("#CREATE_NEW [name=C]").val(),
                            "D":$("#CREATE_NEW [name=D]").val()
                        },
                        success:function(data){
                            alert("成功");
                            location.reload();
                        },
                        error:function(err){
                            alert("失敗");
                        }
                        
                        
                    });
                    return false;
                }
                );
        $("#exec_develop").click(
                function(){
                    if(!confirm("開発する"))return false;
                }
                );
        
    });

</script>

@endsection

@section('body')    
<h2>現在のステータス情報</h2>
{{$user->id}}:{{$user->name}}

@foreach($user->assets()->get() as $asset)
    {{$asset->asset_id}}:{{$asset->value()}}
@endforeach
<a href="{{url('debug/asset_full')}}">素材フル回復</a>

<a href="{{url('debug/master')}}">マスタ情報</a>

<ul>
  <li>
    <div id="">
        
    </div>
  </li>

  <li>
    <div id="DEBUG_CARDS">
      <h3>所持カード</h3>
        <ul>
          @forelse($user->cards()->get() as $card)
          <li>
            <p>
                {{$card->master()->first()->name}}
                :[{{$card->master_card_id}}]
                {{$card->id}}                
            </p>
          </li>
          @empty
          なし
          @endforelse
        </ul>
    </div>
  </li>
  <li>
    <div id="DEBUG_CREATES">
        
      <h3>製造中</h3>
        <ul>
          @forelse($user->creates()->get() as $create)
          <li>
            <p>
              ID:{{$create->id}},
              LINE:{{$create->line_id}},
              master_id:{{$create->master_card_id}}
              @if($create->is_taked)
                取得済み
              @elseif($create->is_takable)            
              <a href="/api/create/take/{{$create->id}}">回収</a>
              @elseif(0 < $create->left)              
              あと{{$create->left}} 秒
              <a href="">時短</a>
              @else
                取得不能
                あと{{$create->left}} 秒
              @endif
            </p>
          </li>
          @empty
          なし
          @endforelse
        </ul>
      <h3>製造</h3>
      <form id="CREATE_NEW">
          
          <label>
            ライン選択
            {{-- ライン最大数を回して、空いているものだけenable --}}
           
            <label>
                1
                <input name="L" type="radio" value="1">
            </label>
            <label>
                2
                <input name="L" type="radio" value="2">
            </label>
              
          </label>
          <br>
          
          <label>A<input type="number" name="A" value="30" min="30" class="num3col" /> </label>
          <label>B<input type="number" name="B" value="30" min="30" class="num3col"/> </label>
          <label>C<input type="number" name="C" value="30" min="30" class="num3col"/> </label>
          <label>D<input type="number" name="D" value="30" min="30" class="num3col"/> </label>
          <button id="exec_build">製造実行</button>
      </form>
      
      <h3>開発</h3>
      <form id="DEVELOP_NEW">              

          <label>A<input type="number" name="A" value="30" min="10" class="num3col" /> </label>
          <label>B<input type="number" name="B" value="30" min="10" class="num3col"/> </label>
          <label>C<input type="number" name="C" value="30" min="10" class="num3col"/> </label>
          <label>D<input type="number" name="D" value="30" min="10" class="num3col"/> </label>
          <button id="exec_develop">開発実行</button>
      </form>
    </div>  
  </li>
  <li>
    <div id="DEBUG_LAUNCH">
      <h3>出撃可能地域リスト</h3>
      <ul>
        @forelse($user->launches()->get() as $launch)
        あああ
        @empty
          なし
        @endforelse
      </ul>
    </div>
  </li>
</ul>

@endsection