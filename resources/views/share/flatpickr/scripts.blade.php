<!-- ajax & Bootstrap(ナビバー)用  -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script>
  'use strict'; 
  
  // ajaxいいね機能
  $(function (){
    //「toggle_wish」クラスを持つハート印がクリックされると以下のイベントが起こる
    $('.toggle_wish').on('click', function (e){
      //フォームが送信された時に、デフォルトだとフォームを送信するための通信がされてしまうので、preventDefault()を使用してデフォルトのイベントを止める。
      e.preventDefault(); 
      // イベントを起こした要素(aタグ)を代入
      var clickthis = $(this)
      //クリックした投稿のidを取得
      var post_id = clickthis.data("post-id");

      //ajax処理スタート
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        }, //name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/timeline/like/ajax',  //web.phpで指定したコントローラーのメソッドURLを指定
        method: 'POST',   //POSTメソッドを選択
        data: { 'post_id': post_id, }, //コントローラーに送るに名称をつけてデータを指定
        timeout: 10000, // タイムアウト時間の指定
        async: true, // 非同期通信フラグの指定
      })

      // Ajaxリクエストが成功した場合
      .done(function (data) 
      {
        //classにtext-dangerがあれば削除、なければ追加
        clickthis.toggleClass('text-danger'); 
        //次の弟要素のhtmlを「data」の値に書き換える
        clickthis.next('.likesCount').html(data); 
        // 成功確認用コード
        console.log('ajax正常');
        // alert(data);
      })

      // Ajaxリクエストが失敗した場合
      .fail(function (data)
      {
        //失敗確認用コード
        console.log('ajaxエラー');
        // alert(JSON.stringify(data));
      });
    });
  });

  // 画像をクリックすると拡大表示
  var count = 0; //クリックの度に処理を変更するため変数を定義
  $(function(){
    // 画像をクリックするとイベント発生
    $(".expansion").click(function(){
      if(count == 0){  
        //.reference-image要素の最後にdiv #photoを追加
        $(".reference-image").append('<div id="photo">');
        //一旦非表示にする(後でフェードインするため)
        $("#photo").hide();
        //#photoの中にimg要素を追加
        $("#photo").html("<img>");
        //img要素にsrc属性を設定
        $("#photo img").attr("src",$(this).attr("src"));
        //img要素のwidthとpaddingを設定(Bootstrap)
        $("#photo img").addClass("w-100 p-1");
        //#photoをフェードイン
        $("#photo").fadeIn();
        //countを1へ
        count = 1;
      }else{
        //画像をフェードアウト、完了したら削除
        $("#photo").fadeOut(function(){
          $(this).remove();
        });
        //countを0へ戻す
        count = 0;
      }
    });
  });

  //退会ボタンを押すと再確認する。
  function withdrawal(){
    if(confirm('退会すると、現在のユーザーアカウントは削除され、復元することが出来ません。\n退会するだけでは合格体験記・コメント・いいねは削除されません。\n本当に退会してよろしいですか？')){ // 確認ダイアログを表示
      return true; // 「OK」時は削除を実行
    }else{
      alert('キャンセルされました'); // 警告ダイアログを表示
      return false; // 「キャンセル」時は削除を中止
    }
  }

  //削除ボタンを押すと再確認する。
  function check(){
    if(confirm('本当に削除しますか？')){ // 確認ダイアログを表示
      return true; // 「OK」時は削除を実行
    }else{
      alert('キャンセルされました'); // 警告ダイアログを表示
      return false; // 「キャンセル」時は削除を中止
    }
  }

  //ボタンクリック連打防止
  var set=0; //クリック数を判断するための変数を定義
  function double() {
    if(set==0){
      set=1;  //１クリック目は変数setに１を代入するだけ
    } else {
      alert("只今処理中です。\nそのままお待ちください。"); //２クリック目はアラートを表示
      return false; //２クリック目は中止
    }
  }

  // 合格年月をどのブラウザでも統一できるようにflatpickrを導入
  flatpickr(document.getElementById('pass_date'), {
  plugins: [
    new monthSelectPlugin({
      dateFormat: "20y年m月", //年月で表示
    })
  ],
  locale: 'ja', //日本語化
  maxDate: "today" //今日より先の月は選べない
});

</script>