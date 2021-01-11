<!-- flatpickrのCDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- flatpickrの月選択プラグイン -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<!-- 日本語化のための追加スクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<!-- ブルーテーマの追加スタイルシート -->
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">


<h1>合格体験談投稿ページ</h1>

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

<!-- 合格体験談入力フォーム -->
<form action="{{route('create')}}" method="post">
  @csrf

  <div>
    <label for="pass_class">何級に合格しましたか？</label><br>
    <input type="radio" name="pass_class" id="pass_class" value="１" {{old('pass_class') == "１" ? 'checked' : ''}} checked>１級
    <input type="radio" name="pass_class" id="pass_class" value="２" {{old('pass_class') == "２" ? 'checked' : ''}}>２級
    <input type="radio" name="pass_class" id="pass_class" value="３" {{old('pass_class') == "３" ? 'checked' : ''}}>３級
    <input type="radio" name="pass_class" id="pass_class" value="初" {{old('pass_class') == "初" ? 'checked' : ''}}>初級
  </div>

  <div>
    <label for="pass_date">いつ合格しましたか？</label><br>
    <input type="text" name="pass_date" id="pass_date" value="{{old('pass_date')}}">
  </div>

  <div>
    <label for="test_style">どの試験方式でしたか？</label><br>
    <input type="radio" name="test_style" id="test_style" value="筆記試験（統一試験方式）" {{old('test_style') == "筆記試験（統一試験方式）" ? 'checked' : ''}} checked>筆記試験（統一試験方式）
    <input type="radio" name="test_style" id="test_style" value="ネット試験（CBT方式）" {{old('test_style') == "ネット試験（CBT方式）" ? 'checked' : ''}} >ネット試験（CBT方式）
  </div>

  <div>
    <label for="study_period">勉強期間(時間)はどれくらいでしたか？</label><br>
    <textarea name="study_period" id="study_period" cols="50" rows="5"placeholder="例：だいたいですが約３ヶ月勉強しました。平日は３時間、休日は６時間ぐらいを目標に勉強していました。しかし、休む時はしっかり休んでいました。">{{old('study_period')}}</textarea>
  </div>

  <div>
    <label for="study_method">どのような勉強法でしたか？</label><br>
    <textarea name="study_method" id="study_method" cols="50" rows="5" placeholder="例：最初は独学でしたが、途中で○○スクールに申し込みました。通信講座ではなく通学しました。いつも優しい対応で○○スクールを選んで正解でした。">{{old('study_method')}}</textarea>
  </div>

  <div>
    <label for="books_used">使用した教材は何ですか？</label><br>
    <textarea name="books_used" id="books_used" cols="50" rows="5" placeholder="例：基本的に○○スクールの教材を使用していましたが、市販の□□という教材もオススメです。インターネット上の△△も利用していました。">{{old('books_used')}}</textarea>
  </div>

  <div>
    <label for="advice">合格の秘訣や受験生へアドバイスをお願いします。</label><br>
    <textarea name="advice" id="advice" cols="50" rows="5" placeholder="例：まず大切なのは毎日１問だけでもいいので勉強を続ける習慣を作ることだと思います。あと、必ず復習して同じ失敗を繰り返さないことです。">{{old('advice')}}</textarea>
  </div>

  <div>
    <label for="free_column">最後に一言お願いします。</label><br>
    <textarea name="free_column" id="free_column" cols="50" rows="5" placeholder="合格された今の気持ちや、友達作りにSNSの紹介などご自由にどうぞ。">{{old('free_column')}}</textarea>
  </div>

  <button tipe="submit">送信</button>
</form>

<a href="{{route('timeline')}}">キャンセル</a>


<!-- 合格年月をどのブラウザでも統一できるようにflatpickrを導入 -->
<script>
  flatpickr(document.getElementById('pass_date'), {
    plugins: [
      new monthSelectPlugin({
        dateFormat: "20y年m月",
      })
    ],
    locale: 'ja',
  });
</script>