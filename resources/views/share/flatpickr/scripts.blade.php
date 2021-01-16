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