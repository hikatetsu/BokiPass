<h1>日商簿記検定合格体験談</h1>


@guest
  <div>
    <p>ようこそゲストさん</p>
    <a href="{{ route('login') }}">ログイン</a>
    <a href="{{ route('register') }}">新規登録</a>
  </div>
@else
  <div>
    <p>ようこそ{{$user->name}}さん</p>
    <a href="{{route('create')}}">投稿する</a>
    <a href="{{route('home')}}">ホーム画面へ</a>
  </div>
@endguest


@foreach($posts as $post)
<div style="border:1px solid black; display:inline-block; width:300px;">
<p>日商簿記{{$post->pass_class}}級合格</p>
<p>user_id:{{$post->user_id}}　{{$post->user_name}}さん</p>
<p>{{$post->advice}}</p>
<p>更新日{{$post->updated_at->format('Y.m.d')}}</p>
<a href="{{route('show', ['post_id' => $post->id])}}">続きを読む</a>
</div>
<br>

@endforeach

