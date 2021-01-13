<h1>日商簿記合格体験記</h1>

<!-- ユーザーかゲストかをチェック -->
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

<!-- 全ての合格体験談を表示 -->
@foreach($posts as $post)
  <div style="border:1px solid black; display:inline-block; width:300px;">
    <p>合格体験記 No{{$post->id}}</p>
    <p style="background-color:{{$post->style_pass_class}};">日商簿記{{$post->pass_class}}級合格</p>
    <p>投稿者 {{$post->user_name}}さん</p>
    <p>{{$post->advice}}</p>
    <p>投稿日 {{$post->created_at->format('Y.m.d')}}</p>
    <a href="{{route('show', ['post_id' => $post->id])}}">続きを読む</a>
    @if ($post->comments->count())
      <p>コメント{{$post->comments->count()}}件</p>
    @endif
    @if ($post->likes->count())
      <p>いいね{{$post->likes->count()}}件</p>
    @endif

    <!-- ここからいいね機能 -->
    <!-- まずゲストかユーザーかをチェック -->
    @guest
      <!-- ゲストには全ての投稿で無色(黒)のハートを表示-->
      <button>&hearts;</button>
    @else
      <!-- ログインユーザーにどの記事のハートを何色で表示すべきかここから選別する -->
      
      <!-- 先に、いいね済か否かを判定するための$countを定義しておく -->
      @php
        $count = 0;
      @endphp

      <!-- 既にforeachで$postsから$postを表示しているその中で、$likesもforeachで$likeを取り出す -->
      @foreach($likes as $like)
        <!-- $postのidと、$likeが持っている$post_idが一致する$postだけに絞る。 -->
        @if($post->id == $like->post_id)
          <!-- 次に、ログインユーザーのidと、$likeが持っている$user_idが一致する$postだけに絞る。 -->
          @if($user->id == $like->user_id)
            <!-- ここまで通過した$postにはログインユーザーがいいね済なので$countに１を代入する -->
            @php
              $count = 1;
            @endphp

             <!-- $countが1ならばログインユーザーがいいね済の$postなのでハートを赤色で表示-->
            @if($count == 1)
              <form action="{{route('likeDelete')}}" method="post">
                @csrf
                <input type="hidden" name="like_id" value="{{$like->id}}">
                <button tipe="submit" style="color:red;">&hearts;</button>likeID{{$like->id}}
              </form>
            @endif

          @endif
        @endif
      @endforeach

       <!-- $countが0ならばforeach($likes as $like)を最後まで通過していない$postなのでハートを鼠色で表示 -->
       @if($count == 0)
        <form action="{{route('likeCreate')}}" method="post">
          @csrf
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <button tipe="submit" style="color:gray;">&hearts;</button>
        </form>
      @endif

    @endguest

    <!-- ここまでがいいね機能 -->

  </div>
  <br>

@endforeach


