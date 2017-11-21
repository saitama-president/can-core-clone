

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
    <label>改造
    @for($i=0;$i<5;$i++)
    <select onchange="">
        <option value="0">なし</option>
        @foreach($user->cards()->get() as $id=>$c)
        <option value="{{$id}}">{{$c->id}}</option>    
        @endforeach
    </select>
    @endfor 
    
    <button onclick="return async('/api/upgrade/equip/{{$card->id}}','POST',{
                        'card_id':{{$card->id}},
                        'A':1,'B':1,'C':1,'D':1,'E':1
                     });
            ">実行</button>
    </label>   
</div>

<div class="list">
    <label>装備
    <?php 
        $equips=$card->equips()->get()->keyBy("attachment_slot_id");
    ?>
        
    @for($i=1;$i<=3;$i++)
    <select onchange="return async('/api/upgrade/equip/{{$card->id}}',
                'POST',{
                    'slot_id':{{$i}},
                    'equip_id':$(this).val()
                },false);
            ">
        
        
        <option value='0'>
            なし
        </option>
        {{-- 現在のやつ --}}
        @if(!empty($equips[$i]))
        <option value="{{$equips[$i]->id}}" selected>＜{{$equips[$i]->id}}＞</option>
        @endif
        
        @foreach($user
            ->equips()
            ->where("attachment_card_id",null)
            ->get()->keyBy("id") as $id=>$equip)
            
            
            <option value='{{$equip->id}}'>{{$equip->id}}</option>
        @endforeach
    </select>
    @endfor
    </label>
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
                        'name':$('#NAME_CHANGE_{{$card->id}}').val(),
                        'card_id':{{$card->id}}
                },false);
            "
            />        
    </label>
</form>