@extends('layouts.debug')

@section('head')

<style>
    .list > ul{
        display: none;
    }
    .num3col{
        width: 3em;
        text-align: right;
    }
    
    .collapsed:after{
        content: "[close]";
    }
    .expand:after{
        content: "[EXPAND]";
    }
    

    .show{
        display: block;
    }
</style>

<script>

    $(document).ready(function () {
        $(".list h3,.list h4,.list h5").click(function(){
            //$(this).toggleClass("expand");
            $(this).toggleClass("collapsed");
            
            $(this).next("ul").toggleClass("show");
        });
    });
    function async($url, $method = "GET", $data = {
    }){
        if(!$data._token){
            $data._token='{{csrf_token()}}';
        }
        $.ajax({
            url: $url,
            method: $method,
            data: $data,
            success: function (data) {
                alert("成功");
                location.reload();
            },
            error: function (err) {
                alert("失敗");
            }
        });
        return false;
    }

    function shortcut($id) {
        async(`/api/create/shortcut/${$id}`);
    }
    function repair_shortcut($id) {
        async(`/api/create/shortcut/${$id}`);
    }
    
    function take($id) {
        async(`/api/create/take/${$id}`);
    }


    function toggle($id){
        
    }


</script>

@endsection

@section('body')    
<h2>現在のステータス情報</h2>
{{$user->id}}:{{$user->name}}

@foreach($user->assets()->get() as $asset)
{{$asset->asset_id}}:{{$asset->value()}}
@endforeach
<a href="{{url('debug/asset_full')}}">素材フル回復</a>
<a href="{{url('debug/master')}}" target="_blank">マスタ情報</a>

<ul>
    <li>
        <div id="DEBUG_CARDS" class="list">
            <h3>所持カード</h3>
            <ul>
                @forelse($user->cards()->get() as $card)
                <li>
                    @include("debug/parts/card")
                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
    <li>
        <div id="DEBUG_EQUIP" class="list">
            <h3>所持装備</h3>
            <ul>
                @forelse($user
                ->equips()
                //->where("attachment_card_id",null)
                ->get() as $equip)
                <li>{{$equip}}</li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
    <li>
        <div class="list">
            <h3>修理中</h3>
            <ul>
            @forelse($user->repaires()->get() as $repair)
            <li>
                ({{$repair->card()->first()->id}})あと{{$repair->left}}秒
                <a href="javascript:repair_shortcut({{$repair->id}})">時短</a>
                
            </li>            
            @empty なし @endforelse
            </ul>
        </div>
    </li>

    <li>
        <div id="DEBUG_CREATES" class="list">

            <h3>製造中</h3>
            <ul>
                @forelse($user->creates()->imcompletes()->get() as $create)
                <li>@include("debug/parts/create")</li>
                @empty なし @endforelse
            </ul>
            <h3>製造</h3>
            <form id="CREATE_NEW">

                <label>
                    ライン選択
                    @for($i=1;$i<=$user->status->create_dock;$i++)
                    <label>
                        {{$i}}
                        <input name="L" type="radio" value="{{$i}}"
                               @if($user->creates()->where("line_id",$i)->where("taked_at",null)->exists())
                               disabled 
                               @else
                               checked
                               @endif
                               >
                    </label>
                    @endfor
                </label>
                <br>

                <label>A<input type="number" name="A" value="30" min="30" max="999" class="num3col" /> </label>
                <label>B<input type="number" name="B" value="30" min="30" max="999" class="num3col"/> </label>
                <label>C<input type="number" name="C" value="30" min="30" max="999" class="num3col"/> </label>
                <label>D<input type="number" name="D" value="30" min="30" max="999" class="num3col"/> </label>
                <button id="exec_build" onclick="
                        if (!$('#CREATE_NEW [name=L]:checked').val()) {
                            return false;
                        }
                        return $('#CREATE_NEW [name=L]:checked').val()
                                && async('/api/create', 'POST', {
                                    'type': 1,
                                    'L': $('#CREATE_NEW [name=L]:checked').val(),
                                    'A': $('#CREATE_NEW [name=A]').val(),
                                    'B': $('#CREATE_NEW [name=B]').val(),
                                    'C': $('#CREATE_NEW [name=C]').val(),
                                    'D': $('#CREATE_NEW [name=D]').val()
                                });
                        ">製造実行</button>
            </form>

            <h3>開発</h3>
            <form id="DEVELOP_NEW">              

                <label>A<input type="number" name="A" value="10" min="10" max="300" class="num3col" /> </label>
                <label>B<input type="number" name="B" value="10" min="10" max="300" class="num3col"/> </label>
                <label>C<input type="number" name="C" value="10" min="10" max="300" class="num3col"/> </label>
                <label>D<input type="number" name="D" value="10" min="10" max="300" class="num3col"/> </label>
                <button id="exec_develop" onclick="
                        return async('/api/create', 'POST', {
                                    'type': 2,
                                    'A': $('#DEVELOP_NEW [name=A]').val(),
                                    'B': $('#DEVELOP_NEW [name=B]').val(),
                                    'C': $('#DEVELOP_NEW [name=C]').val(),
                                    'D': $('#DEVELOP_NEW [name=D]').val()
                                });
                        " >開発実行</button>
            </form>
        </div>  
    </li>
    <li>
        <div id="DEBUG_TEAM" class="list">
            <h3>チーム編成({{$user->status->id}})
              <a href="/debug/team_add">＋</a>
            </h3>
            <ul>                
                @foreach($user->teams as $team)
                <li>@include("debug/parts/team")</li>
                @endforeach
            </ul>
        </div>
    </li>  
    <li>
        <div id="DEBUG_LAUNCH" class="list">
            <h3>出撃可能先リスト</h3>
            <ul>
                @forelse($user->launches()->get() as $launch)
                <li>@include("debug/parts/launch") </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
    <li>
        <h3>ミッション一覧</h3>
        <div id="DEBUG_MISSION" class="list">
            <h3>受託中</h3>
            <ul>
                @forelse($user->missions()->get() as $mission)
                <li>
                    <label>
                        {{$mission->id}}
                        <button onclick="return async();">キャンセル</button>
                    </label>
                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
        
        <div class="list">
            <h3>受託可能</h3>
            <ul>
                @forelse(App\CCC\data\master_mission::all() as $mission)
                <li>
                    <label>
                        {{$mission->id}}
                        <button onclick="">受託</button>
                    </label>
                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
</ul>

@endsection