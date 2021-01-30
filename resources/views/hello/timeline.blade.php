@extends('layout')

@section('content')
  <div class="col-md-8 container">
    <!-- メッセージがある場合は表示 -->
    <div class=" mt-3">
      @if (session('status'))
        <p class="alert alert-info">{{ session('status') }}</p> 
      @endif
    </div>
    <div class=" text-center mt-3">
      <h1 class="h4  font-weight-bold">日商簿記検定 合格体験記</h1>
      <!-- ユーザーかゲストかをチェック -->
      @guest
        <div>
          <p class="mb-2">ようこそゲストさん</p>
          <a href="{{ route('login') }}" class="btn btn-primary mb-2">ログインして投稿する</a>
          <a href="{{ route('register') }}" class="btn btn-primary mb-2">新規登録して投稿する</a>
        </div>
      @else
        <div class="mb-2">
          <p>ようこそ{{auth()->user()->name}}さん</p>
          <a href="{{route('create')}}" class="btn btn-primary mb-2">合格体験記を投稿する</a>
        </div>
      @endguest
    </div>
    <!-- foreachで全ての投稿を表示 -->
    <div class="">
      @foreach($posts as $post)
        <div class="card mt-2 mb-3 mx-3 bg-white rounded-lg shadow-sm">
          <p class="card-header">{{$post->user_name}}さんの合格体験記</p>
          <div class="card-body">
            <p class="card-title bg-{{$post->style_pass_class}} text-white d-inline p-1 font-weight-bold h4">日商簿記検定{{$post->pass_class}}級</p>
            <p class="card-text mt-3">{!! nl2br(e(Str::limit($post->advice, 100))) !!}</p>
            <a href="{{route('show', ['post_id' => $post->id])}}">続きを読む</a>
            <p class="mt-2">投稿日 {{$post->created_at->format('Y.m.d')}}</p>
            <p class="d-inline mr-4 badge badge-pill badge-dark">コメント{{$post->comments->count()}}件</p>

            <!-- ajaxいいね機能(まずユーザーかゲストかを判定) -->
            @if(auth()->user())
              <!-- ユーザーの場合（いいね済か否かを判定）違いはハートの色のみ -->
              @if(\App\Models\Like::getLikeExist(Auth::user()->id,$post->id))
              <!-- いいね済なら赤色のハートといいね件数を表示 -->
                <p class="d-inline">
                  <a class="toggle_wish heart like" href="" data-post-id="{{ $post->id }}"><i class="fa fa-heart"></i></a>
                  <span class="likesCount">{{$post->likes->count()}}</span>
                </p>
              @else
              <!-- いいねしていないなら灰色のハートといいね件数を表示 -->
                <p class="d-inline">
                  <a class="toggle_wish heart" href="" data-post-id="{{ $post->id }}"><i class="fa fa-heart"></i></a>
                  <span class="likesCount">{{$post->likes->count()}}</span>
                </p>
              @endif
            @else
              <!-- ゲストの場合（ただの灰色のハートといいね件数を表示） -->
              <p class="d-inline">
                <a class="heart" href="" style="pointer-events: none;"><i class="fa fa-heart"></i></a>
                <span class="">{{$post->likes->count()}}</span>
              </p>
            @endif 

            <!-- 画像あり投稿ならカメラアイコンを表示 -->
            @if($post->file_path)
              <i class="fa fa-camera ml-4" aria-hidden="true"></i>
            @endif
          </div>
        </div>
      @endforeach
    </div>
    <!-- ページネーション（appends()の'pass_class'は級別検索でのinputタグのname名） -->
    <div class="d-flex justify-content-center mb-2">
      {{ $posts->appends(Request::only('pass_class'))->links('vendor/pagination/pagination_view') }}
    </div>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection