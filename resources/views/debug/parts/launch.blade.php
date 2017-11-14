<form id="LAUNCH_{{$launch->id}}">


  <label>
    出撃先名：{{$launch->master()->first()->name}}
    ,出撃チーム
    <select name="team_id">
      @foreach($user->teams()->get() as $team)
      <option value="{{$team->id}}">
        {{$team->id}}:{{$team->name}}
      </option>
      @endforeach
    </select>
  </label>
  <button onclick="return confirm('出撃します')
                                  && async(
                                          '/api/launch/{{$launch->id}}/'
                                          +$('#LAUNCH_{{$launch->id}} [name=team_id]').val() ,
                                                    'GET',
                                            {}
                                            );
          " 
          >
    出撃
  </button>
</form>