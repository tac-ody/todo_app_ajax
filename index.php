<?php
//pdoインスタンス生成
$pdo = new PDO ('mysql:host=mysql1.php.xdomain.ne.jp;dbname=tacody_todoapp;charset=utf8', 'tacody_070124', 'tac070124');
// データ取得用SQL
$sql = "SELECT id, tasks, datetime FROM todolist ORDER BY datetime DESC";
// SQLをセット
$db = $pdo->prepare($sql);
// SQLを実行
$db->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ToDo</title>
  <link rel="stylesheet" type="text/css" href="todo.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
</head>

<body class="body">
  <div class="head-area">
    <h1 id="site_title">ToDo</h1>
  </div>

  <div id="main">
      <input type="text" id="task" name="task" size="60" maxlength="50" placeholder="登録したいタスクを入力してください">
      <input type="button" id="add_button" value="追加">
  </div>
  <p id="message">※タスクを削除したい場合はチェックを入れてください</p>
  <div id="res">
<?php
  //データベースより取得したデータを一行ずつ表示
    foreach ($db as $result) {
      echo "<input type= 'checkbox' class='checkbox' value=".$result['id'].">";
      echo "<input class='tasks' value=".$result['tasks']." readonly>";
      echo "<input type= 'hidden' value=".$result['datetime'].">";
      echo '<br>';
    };
?>
  </div>

  <!--Ajax処理を記載したjsファイルを読み込み-->
　<script type="text/javascript" src="todo.js"></script>
</body>
</html>
