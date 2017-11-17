

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
<div class="list">
    <h4>装備</h4>
    <ul>
        @for($i=0;$i<3;$i++)
        <li>
            <select onchange="return alert($(this).val()) && async('/api/upgrade/equip/{{$card->id}}',
                        'POST',{
                            'slot_id':$i,
                            'equip_id':$(this).val()
                        });
                    ">
                <?php 
                    
                ?>
                <option value=0 >
                
                </option>                
                @foreach($user
                    ->equips()
                    //->where("attachment_card_id",null)
                    ->get()->keyBy("id") as $id=>$equip)
                    <option value='{{$id}}'>{{$id}}</option>
                @endforeach
            </select>              
        </li>
        @endfor
    </ul>    
</div>



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
                '/play/upgrade/rename', 'POST',{
                '_token':'{{csrf_token()}}',
                        'name':$('#NAME_CHANGE_{{$card->id}}').val(),
                        'card_id':{{$card->id}}
                },false);
            "
            />        
    </label>
</form>