@extends('layouts.debug')

@section('head')

<style>

    .num3col{
        width: 3em;
        text-align: right;
    }

</style>

<script>

    $(document).ready(function () {

    });
    function async($url, $method = "GET", $data = {}){
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
    function take($id) {
        async(`/api/create/take/${$id}`);
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

<a href="{{url('debug/master')}}">マスタ情報</a>

<ul>

    <li>
        <div id="DEBUG_CARDS">
            <h3>所持カード</h3>
            <ul>
                @forelse($user->cards()->get() as $card)
                <li>
                    <label>
                        名前：{{$card->uniq_name}}
                        ({{$card->id}})>
                        {{$card->master()}}
                        [
                        H:{{$card->charge->hp}},
                        燃:{{$card->charge->fuel}},
                        弾:{{$card->charge->ammo}}
                        ]
                        [気分:{{$card->tension->value()}}]
                        

                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">廃棄</button>
                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">燃料補給</button>
                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">弾薬補給</button>
                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">修理</button>

                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">改造</button>
                        <button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">装備変更</button>
                        
                        
                        <form action="" >
                          <input type="text" id="NAME_CHANGE_{{$card->id}}"  placeholder="名称変更" value="{{$card->uniq_name}}"/>
                          <button onclick="return confirm('名前を変更する') && async(
                                    '/play/upgrade/rename','POST',{
                                      '_token':'{{csrf_token()}}',
                                      'name':$('#NAME_CHANGE_{{$card->id}}').val(),
                                      'card_id':{{$card->id}}
                                    }
                                    );" >名前変更</button>
                        </form>
                        
                    </label>


                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
    <li>
        <div id="DEBUG_EQUIP">
            <h3>所持装備</h3>
            <ul>
                @forelse($user->equips()->get() as $equip)
                <li>
                    <p>
                        {{$equips}}                
                    </p>
                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>
    <li>
        <div>
            <h3>修理中</h3>
            @forelse($user->repaires()->get() as $repair)
            {{$repair->id}}
            @empty
            なし
            @endforelse
        </div>

    </li>

    <li>
        <div id="DEBUG_CREATES">

            <h3>製造中</h3>
            <ul>
                @forelse($user->creates()->imcompletes()->get() as $create)
                <li>
                    <p>
                        ID:{{$create->id}},
                        LINE:{{$create->line_id}},
                        master_id:{{$create->master_card_id}}
                        @if($create->is_taked)
                        取得済み
                        @elseif($create->is_takable)            
                        <a href="javascript:take({{$create->id}})">回収</a>
                        @elseif(0 < $create->left)              
                        あと{{$create->left}} 秒
                        <a href="javascript:shortcut({{$create->id}})">時短</a>
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
                    @for($i=1;$i<=$user->status->create_dock;$i++)
                    <label>
                        {{$i}}
                        <input name="L" type="radio" value="{{$i}}"
                               @if($user->creates()
                               ->where("line_id",$i)
                               ->where("taked_at",null)
                               ->exists())
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
                                && confirm('製造する')
                                && async('/api/create', 'POST', {
                                    '_token': '{{ csrf_token() }}',
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
                        return
                        confirm('開発する')
                                && async('/api/create', 'POST', {
                                    '_token': '{{ csrf_token() }}',
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
        <div id="DEBUG_TEAM">
            <h3>チーム編成({{$user->status->id}})</h3>
            <ul>
                @foreach($user->teams as $team)
                <li>
                  <h4>{{$team->team_id}}:{{$team->name}}</h4>
                        <form id="TEAM_{{$team->team_id}}">
                        
                          {{-- dd($team->members) --}}
                        @foreach([
                        "A","B","C","D","E","F"
                        ] as $index=>$k)
                        <select name="{{$k}}">
                            <option value="0">外す</option>
                            @foreach($user->cards()->get() as $card)
                            <option value="{{$card->id}}" 
                                    @if($team->member($index+1) &&
                                      $team->member($index+1)->card_id == $card->id)
                                    selected
                                    @endif>
                              {{$card->uniq_name}}
                            </option>
                            @endforeach
                        </select>
                        @endforeach
                        <button onclick="return async(
                                        '/api/team/edit',
                                        'POST',
                                        {
                                            '_token': '{{ csrf_token() }}',
                                            'team_id': '{{$team->team_id}}',
                                            'A': $('#TEAM_{{$team->team_id}} [name = A]').val(),
                                            'B': $('#TEAM_{{$team->team_id}} [name = B]').val(),
                                            'C': $('#TEAM_{{$team->team_id}} [name = C]').val(),
                                            'D': $('#TEAM_{{$team->team_id}} [name = D]').val(),
                                            'E': $('#TEAM_{{$team->team_id}} [name = E]').val(),
                                            'F': $('#TEAM_{{$team->team_id}} [name = F]').val()
                                        }
                                );">更新</button>
                        
                    </form> 
                </li>
                @endforeach
            </ul>
        </div>
    </li>  
    <li>
        <div id="DEBUG_LAUNCH">
            <h3>出撃可能先リスト</h3>
            <ul>
                @forelse($user->launches()->get() as $launch)
                <li>

                    <form id="LAUNCH_{{$launch->id}}">


                        <label>
                            出撃先名：{{$launch->master()->first()->name}}
                            ,出撃チーム
                            <select name="">
                                @foreach($user->teams()->get() as $team)
                                <option value="{{$team->id}}">
                                    {{$team->id}}:{{$team->name}}
                                </option>
                                @endforeach
                            </select>
                        </label>
                        <button onclick="return confirm('出撃します')
                            && async(
                                    '/api/launch/{{$launch->id}}/{{$team->id}}',
                                    'GET',
                                    {}
                            );
                            " 
                            >
                            出撃
                        </button>
                    </form>
                </li>
                @empty
                なし
                @endforelse
            </ul>
        </div>
    </li>

    <li>
        <div id="DEBUG_MISSION">
            <h3>ミッション一覧</h3>

            <h4>受託中</h4>
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
            <h4>受託可能</h4>
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