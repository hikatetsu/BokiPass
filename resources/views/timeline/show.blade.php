<h1>合格体験談詳細ページ</h1>

<!-- 入力エラーがある場合は表示 -->
@if($errors->any())
  <div>
    <ul>
      @foreach($errors->all() as $message)
        <li style="color:red;">{{ $message }}</li>
      @endforeach
    </ul>
  </div>
@endif

<!-- ゲストかユーザーかをチェックし、合格体験談を投稿した本人(ユーザー)のみ編集・削除が可能 -->
@guest
  @else
    @if(auth()->user()->id == $post->user_id)
      <a href="{{route('edit', ['post_id' => $post->id])}}">編集</a>
      <button>削除</button>
    @endif
@endguest

<!-- 合格体験談詳細を表示 -->
<h2>{{$post->user_name}}さんの合格体験談</h2>
<h2>日商簿記検定{{$post->pass_class}}級合格</h2>
<p style="font-weight:  bold;">合格年月</p>
<p>{{$post->pass_date}}</p>
<p style="font-weight:  bold;">受験方式</p>
<p>{{$post->test_style}}</p>
<p style="font-weight:  bold;">勉強期間（時間）</p>
<p>{{$post->study_period}}</p>
<p style="font-weight:  bold;">勉強法</p>
<p>{{$post->study_method}}</p>
<p style="font-weight:  bold;">使用した教材</p>
<p>{{$post->books_used}}</p>
<p style="font-weight:  bold;">合格した秘訣や受験生へのアドバイス</p>
<p>{{$post->advice}}</p>
<p style="font-weight:  bold;">最後に一言</p>
<p>{{$post->free_column}}</p>
<p style="font-weight:  bold;">投稿日</p>
<p>{{$post->created_at->format('Y.m.d')}}</p>

<!-- 全てのコメントを表示・ゲストかユーザーかをチェックし、コメントした本人(ユーザー)のみ削除が可能 -->
<p style="font-weight:  bold;">コメント</p>
@foreach($comments as $comment)
  <div style="border:1px solid black; display:inline-block; width:300px;">
      <p>id:{{$comment->user_id}} {{$comment->user_name}}　{{$comment->created_at->format('Y.m.d H:i')}}</p>
      <p>{{$comment->body}}</p>
    @guest
      @else
        @if(auth()->user()->id == $comment->user_id)
          <button>削除</button>
        @endif
    @endguest
  </div>
  <br>
@endforeach

<!-- ゲストかユーザーかをチェックし、ユーザーならコメントが可能 -->
@guest
    <div>
      <p>ログインするとコメントができます。</p>
      <a href="{{ route('login') }}">ログイン</a>
      <a href="{{ route('register') }}">新規登録</a>
    </div>
  @else
    <form action="{{route('commentCreate', ['post_id' => $post->id])}}" method="post">
      @csrf
      <div>
        <label for="body">コメント記入欄</label><br>
        <textarea name="body" id="body" cols="40" rows="5" placeholder="ここにコメントを書いてください">{{old('body')}}</textarea>
      </div>
      <button tipe="submit">コメントする</button>
    </form>
@endguest

<a href="{{route('timeline')}}">戻る</a>