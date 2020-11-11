<?php
    //todo.jsからPOSTデータを受け取る
    $task = $_POST['task'];
    $datetime = date("Y-m-d H:i:s");

    //受け取ったデータが空でなければ
    if (!empty($task)) {

        //pdoインスタンス生成
        $pdo = new PDO ('mysql:host=mysql1.php.xdomain.ne.jp;dbname=tacody_todoapp;charset=utf8', 'tacody_070124', 'tac070124');
        //データ追加用SQL
        //SQL文作成
        $sql = "INSERT INTO todolist(tasks, datetime) VALUE(:task, :datetime)";
        //SQLをセット
        $stmt = $pdo->prepare($sql);
        //SQL実行
        $stmt->execute([':task' => $task, ':datetime' => $datetime]);

        //データ取得用SQL
        $sql = "SELECT id, tasks, datetime FROM todolist ORDER BY datetime DESC";
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
