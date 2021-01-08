<h1>日商簿記検定合格体験談</h1>

<a href="{{route('create')}}">投稿する</a>
<br>

@foreach($posts as $post)
<div style="border:1px solid black; display:inline-block;">
<p>日商簿記{{$post->pass_class}}級合格</p>
<p>user_id:{{$post->user_id}}　{{$post->user_name}}さん</p>
<p>{{$post->advice}}</p>
<p>投稿日時{{$post->created_at}}</p>
<a href="{{route('show', ['post_id' => $post->id])}}">続きを読む</a>
</div>
<br>

@endforeach

