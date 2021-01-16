@extends('layout')

@section('content')
  <div class="container my-3">
    <h1 class="h4">合格体験記 投稿フォーム</h1>
    <!-- 入力エラーがある場合は表示 -->
    @if($errors->any())
      <ul class="list-unstyled">
        @foreach($errors->all() as $message)
          <li class="alert alert-danger">{{ $message }}</li>
        @endforeach
      </ul>
    @endif
  </div>
  <!-- 合格体験記入力フォーム -->
  <form action="{{route('create')}}" method="post" class="container mb-4">
    @csrf
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="pass_class" class="font-weight-bold">何級に合格しましたか？</label><br>
      <input type="radio" name="pass_class" id="pass_class" value="１" {{old('pass_class') == "１" ? 'checked' : ''}} checked>１級
      <input type="radio" name="pass_class" id="pass_class" value="２" {{old('pass_class') == "２" ? 'checked' : ''}} class="ml-2">２級
      <input type="radio" name="pass_class" id="pass_class" value="３" {{old('pass_class') == "３" ? 'checked' : ''}} class="ml-2">３級
      <input type="radio" name="pass_class" id="pass_class" value="初" {{old('pass_class') == "初" ? 'checked' : ''}} class="ml-2">初級
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="test_style" class="font-weight-bold">どの試験方式でしたか？</label><br>
      <input type="radio" name="test_style" id="test_style" value="筆記試験" {{old('test_style') == "筆記試験" ? 'checked' : ''}} checked>筆記試験 
      <input type="radio" name="test_style" id="test_style" value="ネット試験" {{old('test_style') == "ネット試験" ? 'checked' : ''}} class="ml-2">ネット試験
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="nunber_times" class="font-weight-bold">受験回数は何回ですか？</label><br>
      <input type="radio" name="nunber_times" id="nunber_times" value="１回" {{old('nunber_times') == "１回" ? 'checked' : ''}} checked>１回
      <input type="radio" name="nunber_times" id="nunber_times" value="２回" {{old('nunber_times') == "２回" ? 'checked' : ''}} class="ml-2">２回
      <input type="radio" name="nunber_times" id="nunber_times" value="３回" {{old('nunber_times') == "３回" ? 'checked' : ''}} class="ml-2">３回
      <input type="radio" name="nunber_times" id="nunber_times" value="４回以上" {{old('nunber_times') == "４回以上" ? 'checked' : ''}} class="ml-2">４回以上
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="pass_date" class="w-100 font-weight-bold">いつ合格しましたか？</label><br>
      <input type="month" name="pass_date" id="pass_date" value="{{old('pass_date')}}" placeholder="記載例：2021-01（半角）">
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="study_period" class="w-100 font-weight-bold">勉強期間(時間)はどれくらいでしたか？</label><br>
      <textarea name="study_period" id="study_period" rows="5" placeholder="記載例：何ヶ月間や合計何時間など。平日は何時間で休日は何時間など。" class="w-100">{{old('study_period')}}</textarea>
      <small class="form-text text-muted">191文字まで</small>
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="study_method" class="w-100 font-weight-bold">どのような勉強法でしたか？</label><br>
      <textarea name="study_method" id="study_method" rows="5" placeholder="記載例：独学or通信講座or通学？通信講座や通学ならスクール名など。その他具体的な勉強法。" class="w-100">{{old('study_method')}}</textarea>
      <small class="form-text text-muted">191文字まで</small>
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="books_used" class="w-100 font-weight-bold">使用した教材は何ですか？</label><br>
      <textarea name="books_used" id="books_used" rows="5" placeholder="記載例：教材やWebサービスの名前。それらの特徴など。" class="w-100">{{old('books_used')}}</textarea>
      <small class="form-text text-muted">191文字まで</small>
    </div>
    <div class="container form-group rounded-lg shadow-sm p-3 bg-white">
      <label for="advice" class="w-100 font-weight-bold">合格の秘訣や受験生へアドバイスをお願いします。</label><br>
      <textarea name="advice" id="advice" rows="5" placeholder="記載例：おすすめの学習方法や受験上の注意点など。" class="w-100">{{old('advice')}}</textarea>
      <small class="form-text text-muted">191文字まで</small>
    </div>
    <small class="form-text text-muted mb-3">※入力欄が足りない場合は投稿後にコメント機能をご利用ください。</small>
    <button type="submit" onClick="return double()" class="btn btn-primary">　送　信　</button>
  </form>
  <div class="container pb-3">
    <a href="{{route('timeline')}}" class="btn btn-outline-dark">キャンセル</a>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection