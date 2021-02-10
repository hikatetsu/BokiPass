@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">my合格体験記</div>

                <div class="card-body pb-0">
                    <ul>
                        @foreach($posts as $post)
                            @if(Auth::user()->id == $post->user_id)
                                <a href="{{route('show', ['post_id' => $post->id])}}" style="text-decoration:none;" >
                                    <li class="text-dark ml-2 mb-3 h5">
                                        <p class="d-inline">投稿日 {{$post->created_at->format('Y.m.d')}}</p>
                                        <p class="bg-{{$post->style_pass_class}} text-white d-inline font-weight-bold p-1">簿記{{$post->pass_class}}級</p>
                                    </li>
                                </a>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">いいね一覧</div>

                <div class="card-body pb-0">
                    <ul>
                        @foreach($posts as $post)
                            @if(\App\Models\Like::getLikeExist(Auth::user()->id,$post->id))
                                <a href="{{route('show', ['post_id' => $post->id])}}" style="text-decoration:none;" >
                                    <li class="text-dark ml-2 mb-3 h5">
                                        <p class="d-inline">合格体験記No.{{$post->id}}</p>
                                        <p class="bg-{{$post->style_pass_class}} text-white d-inline font-weight-bold p-1">簿記{{$post->pass_class}}級</p>
                                    </li>
                                </a>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
