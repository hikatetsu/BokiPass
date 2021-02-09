@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card rounded-lg shadow-sm bg-white mt-4">
        <p class="card-header">退会の注意点</p>
        <p class="card-body">退会すると、現在のユーザーアカウントは削除され、復元することが出来ません。<br>退会するだけでは合格体験記・コメント・いいねは削除されません。</p>
        <div class="text-center">
          <form action="{{route('userDelete')}}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <button type="submit" class="btn btn-danger m-2" onClick="return withdrawal()">退会実行</button>
          </form>
          <a href="{{route('timeline')}}" class="btn btn-outline-dark mb-3">TOPへ戻る</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection