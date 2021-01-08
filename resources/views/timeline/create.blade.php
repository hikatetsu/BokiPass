<h1>投稿ページ</h1>
<form action="{{route('create')}}" method="POST">
@csrf

<div>
  <label for="pass_class">合格したのは何級ですか？</label>
  <input type="radio" name="pass_class" id="pass_class" value="1{{ old('pass_class') }}" checked>１級
  <input type="radio" name="pass_class" id="pass_class" value="2{{ old('pass_class') }}">２級
  <input type="radio" name="pass_class" id="pass_class" value="3{{ old('pass_class') }}">３級
  <input type="radio" name="pass_class" id="pass_class" value="4{{ old('pass_class') }}">初級
</div>

<button tipe="submit">送信</button>

</form>

<a href="{{route('timeline')}}">キャンセル</a>