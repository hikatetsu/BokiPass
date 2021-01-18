@extends('layout')

@section('content')
  <div class="container text-center mt-3">
    <h1 class="h4  font-weight-bold">日商簿記合格体験記</h1>
    <!-- ユーザーかゲストかをチェック -->
    @guest
      <div>
        <p class="mb-2">ようこそゲストさん</p>
        <a href="{{ route('login') }}" class="btn btn-primary mb-2">ログインして投稿する</a>
        <a href="{{ route('register') }}" class="btn btn-primary mb-2">新規登録して投稿する</a>
      </div>
    @else
      <div class="mb-2">
        <p>ようこそ{{$user->name}}さん</p>
        <a href="{{route('create')}}" class="btn btn-primary mb-2">合格体験記を投稿する</a>
      </div>
    @endguest
  </div>
  <!-- foreachで全ての投稿を表示 -->
  <div class="container">
    @foreach($posts as $post)
      <div class="card mt-2 mb-3 mx-3 bg-white rounded-lg shadow-sm">
        <p class="card-header">{{$post->user_name}}さんの合格体験記</p>
        <div class="card-body">
          <p class="card-title bg-{{$post->style_pass_class}} text-white d-inline p-1 font-weight-bold h4">日商簿記検定{{$post->pass_class}}級</p>
          <p class="card-text mt-3">{!! nl2br(e(Str::limit($post->advice, 100))) !!}</p>
          <a href="{{route('show', ['post_id' => $post->id])}}">続きを読む</a>
          <p class="mt-2">投稿日 {{$post->created_at->format('Y.m.d')}}</p>
          <p class="d-inline mr-4 badge badge-pill badge-dark">コメント{{$post->comments->count()}}件</p>
          <!-- ここからいいね機能。まずゲストかユーザーかをチェック。ゲストにはpost機能が無い灰色ハートを表示。ユーザーには$count=0を定義しておく。各$postごとにif文で①もし$postのidと$likeが持っている$post_idが一致する$postなら通過、②もしログインユーザーのidと$likeが持っている$user_idが一致する$postなら通過、→①と②を通過した$postにはログインユーザーがいいね済なので$countに１を代入し、もし$countが1の$postは赤色ハートを表示。もし$countが0のままなら灰色ハートを表示。 -->
          @guest
            <button class="text-secondary">&#9829;</button>
            @if ($post->likes->count())
              {{$post->likes->count()}}
            @endif
          @else

            @php
              $count = 0;
            @endphp

            @foreach($likes as $like)
              @if($post->id == $like->post_id)
                @if($user->id == $like->user_id)
                  @php
                    $count = 1;
                  @endphp
                  @if($count == 1)
                    <form action="{{route('likeDelete')}}" method="post" class="d-inline">
                      @csrf
                      <input type="hidden" name="like_id" value="{{$like->id}}">
                      <button type="submit" class="text-danger" onClick="return double()">&#9829;</button>
                    </form>
                    @if ($post->likes->count())
                      {{$post->likes->count()}}
                    @endif
                  @endif
                @endif
              @endif
            @endforeach

            @if($count == 0)
              <form action="{{route('likeCreate')}}" method="post" class="d-inline">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <button type="submit" class="text-secondary"  onClick="return double()">&#9829;</button>
              </form>
              @if ($post->likes->count())
                {{$post->likes->count()}}
              @endif
            @endif
          @endguest
          <!-- ここまでがいいね機能 -->
        </div>
      </div>
    @endforeach
  </div>
  <!-- ページネーション（appends()の'pass_class'は級別検索でのinputタグのname名） -->
  <div class="d-flex justify-content-center mb-2">
    {{ $posts->appends(Request::only('pass_class'))->links('vendor/pagination/pagination_view') }}
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection