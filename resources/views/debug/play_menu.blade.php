{{$user->id}}:{{$user->name}}

<div id="DEBUG_CARDS">
    <h3>所持カード</h4>
        <ul>
            @foreach($user->cards() as $card)
            <li>
                <p>aaa</p>

            </li>
            @endforeach
        </ul>
</div>    

<div id="DEBUG_CREATES">
    <h3>製造中</h4>
        <ul>
            @foreach($user->creates()->get() as $create)
            <li>
                <p>
                    ID:{{$create->id}}<br>
                    master_id:{{$create->master_card_id}}<br>
                    complete:{{$create->complete_at}}<br>
                </p>
            </li>
            @endforeach
        </ul>
</div>  