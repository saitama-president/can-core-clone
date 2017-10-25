@extends('layouts.debug')
<h1>現在のステータス情報</h1>
{{$user->id}}:{{$user->name}}

<a href="{{url('debug/master')}}">マスタ情報</a>

<ul>
  <li>
    <div>

    </div>

  </li>

  <li>
    <div id="DEBUG_CARDS">
      <h3>所持カード</h4>
        <ul>
          @forelse($user->cards()->get() as $card)
          <li>
            <p>aaa</p>

          </li>
          @empty
          なし
          @endforelse
        </ul>
    </div>
  </li>
  <li>
    <div id="DEBUG_CREATES">
      <h3>製造中</h4>
        <ul>
          @forelse($user->creates()->get() as $create)
          <li>
            <p>
              ID:{{$create->id}}<br>
              master_id:{{$create->master_card_id}}<br>
              complete:{{$create->complete_at}}<br>
              @if($create->complete_at< \Carbon\Carbon::Now())
              回収可能
              あと{{ $create->left()}} 秒
              @else
              あと{{ $create->left()}} 秒
              @endif
            </p>
          </li>
          @empty
          なし
          @endforelse
        </ul>
    </div>  
  </li>
  <li>
    <div id="DEBUG_LAUNCH">
      <h3>出撃可能地域リスト</h3>
      <ul>
        @forelse($user->launches()->get() as $launch)
        あああ
        @empty
          なし
        @endforelse
      </ul>
    </div>
  </li>
</ul>