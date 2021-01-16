<script>
    'use strict'; 
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
  </script>
  <!-- Bootstrap(ナビバー)用 jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>