<h4>{{$team->team_id}}:{{$team->name}}</h4>
  
<form action="" >
    <label>チーム名
    <input 
        type="text" 
        id="TEAM_RENAME_{{$team->team_id}}"  
        placeholder="チーム名変更" 
        size="6"
        value="{{$team->name}}"
        onchange="return  async(
                '/api/team/rename', 'POST', {
                        'name':$('#TEAM_RENAME_{{$team->team_id}}').val(),
                        'team_id':{{$team->id}}
                });            
        "
        />
    </label>
</form>
  
    <form id="TEAM_{{$team->team_id}}">

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
            );">更新
    </button>

</form> 
