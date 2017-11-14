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