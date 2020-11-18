$(function() {
// #add_buttonがクリックされた時の処理(追加処理)
$('#add_button').on('click',function(){
    // OKならtrue キャンセルならfalseが代入
    var confirm_result = window.confirm("追加しますか？");

    //入力フォームの空欄チェック
    if (document.getElementById('task').value == "" )  {
        alert('登録したいタスクを入力してください');
        return false;
    }

    //ダイアログの確認でOKをクリックした場合の処理
    if(confirm_result) {
        $.ajax({
            // 送信方法
            type: "POST",
            // 送信先ファイル名
            url: "todo_add.php",
            // 受け取りデータの種類
            datatype: "json",
            // 送信データ
            data: {
                // #taskのvalueをセット
                "task" : $('#task').val()
            },
            // 通信が成功した時
            success: function(data) {
              //HTMLファイル内の該当箇所にレスポンスデータを追加
              $('#res').html(data);

              //追加完了のポップアップ
              alert("追加しました");

              //コンソール確認用
              console.log("通信成功");
            },

            // 通信が失敗した時
            error: function(data) {
                console.log("通信失敗");
            }
        });
    } else {
      //削除キャンセルのポップアップ
      alert("追加をキャンセルしました");
    }
    //テキストボックスを空にして連続で入力を可能にする
    $('#task').val('');
    return false;
 });

// #checkboxがクリックされた時の処理(削除処理)
 $(document).on('change', '.checkbox', function(){
     // OKならtrue キャンセルならfalseが代入される
     var confirm_result = window.confirm("削除しますか？");

    //チェックが入ったチェックボックスのvalueのみを取得する方法（開発用メモ2020.11.08）
    //$('input:checked').each(function() {
    //    var r = $(this).val();
    //    console.log(r);
    //})

     //ダイアログの確認でOKをクリックした場合の処理
     if(confirm_result) {
         $.ajax({
             // 送信方法
             type: "POST",
             // 送信先ファイル名
             url: "todo_delete.php",
             // 受け取りデータの種類
             datatype: "json",
             // 送信データ
             data: {
                 // .checkboxのvalueをセット
                 //($('.checkbox').val()にすると先頭のレコードのvalueを取ってしまい先頭レコードをDELETEしてしまう（開発用メモ2020.11.08）
                 "checkbox" : $('input:checked').val(),
             },
             // 通信が成功した時
             success: function(data) {
               //HTMLファイル内の該当箇所にレスポンスデータを追加
               $('#res').html(data);

               //削除完了のポップアップ
                alert("削除しました");
                //コンソール確認用
                console.log("通信成功");

                //コンソール確認用（DELETEしたいレコードの主キー）
                console.log($('.checkbox').val());
             },

             // 通信が失敗した時
             error: function(data) {
                 console.log("通信失敗");
             }
         });
     } else {
       //削除キャンセルのポップアップ
       alert("削除をキャンセルしました");
       //チェックボックスのチェックを外す
       $('.checkbox').prop('checked', false);
     }
     return false;
  });
});
