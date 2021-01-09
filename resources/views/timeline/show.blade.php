<h1>合格体験談詳細ページ</h1>
<a href="{{route('edit', ['post_id' => $post->id])}}">編集</a>
<button>削除</button>

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
<p style="font-weight:  bold;">最終更新</p>
<p>{{$post->updated_at}}</p>

<p style="font-weight:  bold;">コメント</p>
<input type="text">
<button>コメントする</button>
<br>

<a href="{{route('timeline')}}">戻る</a>