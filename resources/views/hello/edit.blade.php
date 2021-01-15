<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- flatpickrのCDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- flatpickrの月選択プラグイン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
    <!-- flatpickrの日本語化追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <!-- flatpickrのブルーテーマ追加スタイルシート -->
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <title>BokiPass</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
  </head>
  <body class="bg-light">
    <div class="container my-3">
      <h1 class="h4">合格体験記 編集ページ</h1>
      <!-- 入力エラーがある場合は表示 -->
      @if($errors->any())
        <ul class="list-unstyled">
          @foreach($errors->all() as $message)
            <li class="alert alert-danger">{{ $message }}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <!-- 合格体験記再入力フォーム -->
    <form action="{{route('edit', ['post_id' => $post->id])}}" method="post" class="container mb-4">
      @csrf
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="pass_class" class="font-weight-bold">何級に合格しましたか？</label><br>
        <input type="radio" name="pass_class" id="pass_class" value="１" {{old('pass_class',$post->pass_class) == "１" ? 'checked' : ''}} checked>１級
        <input type="radio" name="pass_class" id="pass_class" value="２" class="ml-2" {{old('pass_class',$post->pass_class) == "２" ? 'checked' : ''}}>２級
        <input type="radio" name="pass_class" id="pass_class" value="３" class="ml-2" {{old('pass_class',$post->pass_class) == "３" ? 'checked' : ''}}>３級
        <input type="radio" name="pass_class" id="pass_class" value="初" class="ml-2" {{old('pass_class',$post->pass_class) == "初" ? 'checked' : ''}}>初級
      </div>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="test_style" class="font-weight-bold">どの試験方式でしたか？</label><br>
        <input type="radio" name="test_style" id="test_style" value="筆記試験" {{old('test_style',$post->test_style) == "筆記試験" ? 'checked' : ''}} checked>筆記試験
        <input type="radio" name="test_style" id="test_style" value="ネット試験" class="ml-2" {{old('test_style',$post->test_style) == "ネット試験" ? 'checked' : ''}} >ネット試験
      </div>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="nunber_times" class="font-weight-bold">受験回数は何回ですか？</label><br>
        <input type="radio" name="nunber_times" id="nunber_times" value="１回" {{old('nunber_times',$post->nunber_times) == "１回" ? 'checked' : ''}} checked>１回
        <input type="radio" name="nunber_times" id="nunber_times" value="２回" class="ml-2" {{old('nunber_times',$post->nunber_times) == "２回" ? 'checked' : ''}}>２回
        <input type="radio" name="nunber_times" id="nunber_times" value="３回" class="ml-2" {{old('nunber_times',$post->nunber_times) == "３回" ? 'checked' : ''}}>３回
        <input type="radio" name="nunber_times" id="nunber_times" value="４回以上" class="ml-2" {{old('nunber_times',$post->nunber_times) == "４回以上" ? 'checked' : ''}}>４回以上
      </div>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="pass_date" class="w-100 font-weight-bold">いつ合格しましたか？</label><br>
        <input type="month" name="pass_date" id="pass_date" value="{{old('pass_date',$post->pass_date)}}" placeholder="記載例：2021年01月" class="w-100">
      </div>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="study_period" class="w-100 font-weight-bold">勉強期間(時間)はどれくらいでしたか？</label><br>
        <textarea name="study_period" id="study_period" rows="5"placeholder="記載例：何ヶ月間や合計何時間など。平日は何時間で休日は何時間など。" class="w-100">{{old('study_period',$post->study_period)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="study_method" class="w-100 font-weight-bold">どのような勉強法でしたか？</label><br>
        <textarea name="study_method" id="study_method" rows="5" placeholder="記載例：独学or通信講座or通学？通信講座や通学ならスクール名など。その他具体的な勉強法。" class="w-100">{{old('study_method',$post->study_method)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="books_used" class="w-100 font-weight-bold">使用した教材は何ですか？</label><br>
        <textarea name="books_used" id="books_used" rows="5" placeholder="記載例：教材やWebサービスの名前。それらの特徴など。" class="w-100">{{old('books_used',$post->books_used)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
        <label for="advice" class="w-100 font-weight-bold">合格の秘訣や受験生へアドバイスをお願いします。</label><br>
        <textarea name="advice" id="advice" rows="5" placeholder="記載例：おすすめの学習方法や受験上の注意点など。" class="w-100">{{old('advice',$post->advice)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <button type="submit" onClick="return double()" class="btn btn-primary">　更　新　</button>
    </form>
    <div class="container pb-3">
      <a href="{{route('show', ['post_id' => $post->id])}}" class="btn btn-outline-dark">キャンセル</a>
    </div>
    <script>
      'use strict';
      // 合格年月をどのブラウザでも統一できるようにflatpickrを導入
      flatpickr(document.getElementById('pass_date'), {
        plugins: [
          new monthSelectPlugin({
            dateFormat: "20y年m月",
          })
        ],
        locale: 'ja',
        maxDate: "today"
      });
      //クリック連打防止
      var set=0; //クリック数を判断するための変数を定義
      function double() {
        if(set==0){
          set=1;  //１クリック目は変数setに１を代入するだけ
        } else {
          alert("只今処理中です。\nそのままお待ちください。"); //２クリック目はアラートを表示
          return false; //２クリック目は中止
        }
      }
    </script>
  </body>
</html>