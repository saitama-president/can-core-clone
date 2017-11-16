

{{--チーム番号 --}}
<span class="bold">
@if(empty(!$card->team)) ＜ {{$card->team->team_id}} ＞ @endif
</span>

NAME：{{$card->uniq_name}}({{$card->id}})>{{$card->master()}}
[
H:{{$card->status->hp}},
燃:{{$card->status->fuel}},
弾:{{$card->status->ammo}}
]
[気分:{{$card->tension->value()}}]

{{--修理--}}
@if($card->status->hp < 100)
    @if($card->isRepairing())
        【修理中】
    @else
        <button onclick="return async('/api/repair/{{$card->id}}', 'POST');">修理</button>
    @endif
@endif

{{--燃料--}}
@if($card->status->fuel < 100)
<button onclick="return async('/api/charge/fuel/{{$card->id}}', 'POST');">燃料補給</button>
@endif

{{--弾薬--}}
@if($card->status->ammo < 100)
<button onclick="return async('/api/charge/ammo/{{$card->id}}', 'POST');">弾薬補給</button>
@endif

<button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">廃棄</button>

<br>


<button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">改造</button>
<button onclick="return async('/api/create/teardown/{{$card->id}}', 'GET');">装備変更</button>


<form action="" >
    <label>
        個体名
        <input 
            type="text" 
            id="NAME_CHANGE_{{$card->id}}"  
            placeholder="名称変更" 
            size="6"
            value="{{$card->uniq_name}}"
            onchange="return async(
                '/play/upgrade/rename', 'POST', {
                '_token':'{{csrf_token()}}',
                        'name':$('#NAME_CHANGE_{{$card->id}}').val(),
                        'card_id':{{$card->id}}
                });
            "
            />        
    </label>
</form>