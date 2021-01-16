@extends('layout')

@section('content')
  <!-- ゲストかユーザーかをチェックし、合格体験記を投稿した本人(ユーザー)のみ編集・削除が可能 -->
  <div class="container text-right m-3">
    @guest
      @else
        @if(auth()->user()->id == $post->user_id)
          <form action="{{route('edit', ['post_id' => $post->id])}}" method="get" class="d-inline">
            @csrf
            <button type="submit" onClick="return double()" class="btn btn-outline-dark btn-sm">編集</button>
          </form>
          <form action="{{route('delete', ['post_id' => $post->id])}}" method="post" class="d-inline">
            @csrf
            <button type="submit" id="deletebtn" onClick="return check()" class="btn btn-outline-danger btn-sm">削除</button>
          </form>
        @endif
    @endguest
  </div>
  <!-- 入力エラーがある場合は表示 -->
  <div class="container mt-1">
    @if($errors->any())
      <div>
        <ul class="list-unstyled">
          @foreach($errors->all() as $message)
            <li class="alert alert-danger">{{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>
  <!-- 合格体験記詳細を表示 -->
  <div class="container">
    <h1 class="h4">合格体験記 No.{{$post->id}}</h1>
    <h2 class="h3 font-weight-bold bg-{{$post->style_pass_class}} text-white d-inline p-1">日商簿記検定{{$post->pass_class}}級</h2>
    <div class="my-2">
    <small class="form-text text-muted d-inline mr-2">投稿日{{$post->created_at->format('Y.m.d')}}</small>
    <small class="form-text text-muted d-inline">更新日{{$post->updated_at->format('Y.m.d')}}</small>
    </div>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">投稿者</p>
    <p class="mb-0">ID{{$post->user_id}} {{$post->user_name}}さん</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">合格年月</p>
    <p class="mb-0">{{$post->pass_date}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">受験方式</p>
    <p class="mb-0">{{$post->test_style}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">受験回数</p>
    <p class="mb-0">{{$post->nunber_times}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">勉強期間（時間）</p>
    <p class="mb-0">{{$post->study_period}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">勉強法</p>
    <p class="mb-0">{{$post->study_method}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">使用した教材</p>
    <p class="mb-0">{{$post->books_used}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <p class="font-weight-bold">合格した秘訣や受験生へのアドバイス</p>
    <p class="mb-0">{{$post->advice}}</p>
  </div>
  <div class="container rounded-lg shadow-sm p-3 mb-3 bg-white">
    <!-- ゲストかユーザーかをチェックし、ユーザーならコメントが可能 -->
    @guest
        <div>
        <p class="font-weight-bold">コメント</p>
        <small class="form-text text-muted">ログインするとコメントができます。</small>
        </div>
      @else
        <form action="{{route('commentCreate', ['post_id' => $post->id])}}" method="post">
          @csrf
          <div>
            <label for="comment" class="w-100 font-weight-bold">コメント</label><br>
            <textarea name="body" id="comment" rows="5" placeholder="コメントをどうぞ" class="w-100">{{old('body')}}</textarea>
            <small class="form-text text-muted">191文字まで</small>
          </div>
          <button type="submit" onClick="return double()" class="btn btn-primary mt-2">コメントする</button>
        </form>
    @endguest
    <!-- 全てのコメントを表示・ゲストかユーザーかをチェックし、コメントした本人(ユーザー)のみ削除が可能 -->
    @foreach($comments as $comment)
      <div class="card m-2">
        <div class="card-body">
            <p class="card-title font-weight-bold">ID{{$comment->user_id}} {{$comment->user_name}}さん</p>
            <p class="card-text">{{$comment->body}}</p>
            <small class="form-text text-muted">{{$comment->created_at->format('Y.m.d H:i')}}</small>
          @guest
            @else
              @if(auth()->user()->id == $comment->user_id)
                <form action="{{route('commentDelete', ['post_id' => $post->id])}}" method="post">
                  @csrf
                  <input type="hidden" name="comment_id" value="{{$comment->id}}">
                  <div class="text-right">
                    <button type="submit" onClick="return check()" class="btn btn-outline-danger btn-sm">削除</button>
                  </div>
                </form>
              @endif
          @endguest
        </div>
      </div>
    @endforeach
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
  </div>
  <div class="container">
    <a href="{{route('timeline')}}" class="btn btn-outline-dark mb-3">　戻る　</a>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection