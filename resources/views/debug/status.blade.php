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
        $("#exec_build").click(
                function () {
                    if (!confirm("製造する"))
                        return false;
                    async("/api/create", "POST", {
                        "_token": "{{ csrf_token() }}",
                        "type": 1,
                        "L": $("#CREATE_NEW [name=L]").val(),
                        "A": $("#CREATE_NEW [name=A]").val(),
                        "B": $("#CREATE_NEW [name=B]").val(),
                        "C": $("#CREATE_NEW [name=C]").val(),
                        "D": $("#CREATE_NEW [name=D]").val()
                    });
                }
        );
        $("#exec_develop").click(
                function () {
                    if (!confirm("開発する"))
                        return false;

                    return async("/api/create", "POST", {
                        "_token": "{{ csrf_token() }}",
                        "type": 2,
                        "A": $("#DEVELOP_NEW [name=A]").val(),
                        "B": $("#DEVELOP_NEW [name=B]").val(),
                        "C": $("#DEVELOP_NEW [name=C]").val(),
                        "D": $("#DEVELOP_NEW [name=D]").val()
                    });
                }
        );

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
                    <p>            
                        マスタ:{{$card->master()}}<br>
                        [
                        H:{{$card->charge->hp}},
                        燃:{{$card->charge->fuel}},
                        弾:{{$card->charge->ammo}}

                        ]<br>
                        [気分:{{$card->tension->value()}}]
                        {{$card->uniq_name}}
                    </p>
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

                <label>A<input type="number" name="A" value="30" min="30" max="999" class="num3col" /> </label>
                <label>B<input type="number" name="B" value="30" min="30" max="999" class="num3col"/> </label>
                <label>C<input type="number" name="C" value="30" min="30" max="999" class="num3col"/> </label>
                <label>D<input type="number" name="D" value="30" min="30" max="999" class="num3col"/> </label>
                <button id="exec_build">製造実行</button>
            </form>

            <h3>開発</h3>
            <form id="DEVELOP_NEW">              

                <label>A<input type="number" name="A" value="10" min="10" max="300" class="num3col" /> </label>
                <label>B<input type="number" name="B" value="10" min="10" max="300" class="num3col"/> </label>
                <label>C<input type="number" name="C" value="10" min="10" max="300" class="num3col"/> </label>
                <label>D<input type="number" name="D" value="10" min="10" max="300" class="num3col"/> </label>
                <button id="exec_develop" >開発実行</button>
            </form>
        </div>  
    </li>
    <li>
        <div id="DEBUG_TEAM">
            <h3>チーム編成</h3>
            <ul>

                @forelse($user->teams()->get() as $team)
                <li>
                    <h4>{{$team->team_id}}:{{$team->name}}</h4>
                    <form id="TEAM_{{$team->team_id}}">
                        @foreach([
                        "A","B","C","D","E","F"
                        ] as $k)
                        <select name="{{$k}}">
                            <option value="0">外す</option>

                            @foreach($user->cards()->get() as $card)
                            <option>{{$card->uniq_name}}</option>
                            @endforeach
                        </select>
                        @endforeach
                        <button onclick="return async(
                                        '/api/team/edit',
                                        'POST',
                                        {
                                            '_token': '{{ csrf_token() }}',
                                            'team_id': '{{$team->team_id}}',
                                            'A': $('#TEAM_{{$team->team_id}} [name=A]').val(),
                                            'B': $('#TEAM_{{$team->team_id}} [name=B]').val(),
                                            'C': $('#TEAM_{{$team->team_id}} [name=C]').val(),
                                            'D': $('#TEAM_{{$team->team_id}} [name=D]').val(),
                                            'E': $('#TEAM_{{$team->team_id}} [name=E]').val(),
                                            'F': $('#TEAM_{{$team->team_id}} [name=F]').val()
                                        }
                                );">更新</button>
                    </form>            
                </li>
                @empty
                なし
                @endforelse
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
                            ,
                            出撃チーム
                            <select name="">
                                @foreach($user->teams()->get() as $team)
                                <option value="{{$team->id}}">
                                    {{$team->id}}:{{$team->name}}
                                </option>
                                @endforeach
                            </select>
                        </label>
                        <button onclick="return false && async('', '', {});" >
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