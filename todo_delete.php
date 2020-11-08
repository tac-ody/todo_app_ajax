<?php
    //todo.jsからPOSTデータを受け取る
    $checkbox = $_POST['checkbox'];

    //受け取ったデータが空でなければ
    if (!empty($checkbox)) {

        //pdoインスタンス生成
        $pdo = new PDO ('mysql:host=mysql1.php.xdomain.ne.jp;dbname=tacody_todoapp;charset=utf8', 'tacody_070124', 'tac070124');
        //データ削除用SQL
        //SQL文作成
        $sql = "DELETE FROM todolist WHERE (id = :id)";
        //SQLをセット
        $stmt = $pdo->prepare($sql);
        //SQL実行
        $stmt->execute([':id' => $checkbox]);

        //データ取得用SQL
        $sql = "SELECT id, tasks, datetime FROM todolist";
        //SQLをセット
        $db = $pdo->prepare($sql);
        //SQLを実行
        $db->execute();

        //データベースより取得したデータを一行ずつ表示する
        foreach ($db as $result) {
            echo "<input type= 'checkbox' class='checkbox' value=".$result['id'].">";
            echo "<input class='tasks' value=".$result['tasks']." readonly>";
            echo "<input type= 'hidden' value=".$result['datetime'].">";
            echo '<br>';
          };
        $pdo = null;
    }
?>
