<?php
// db_connect.phpの読み込み
require_once('db_connect.php');
// function.phpの読み込み
// 提出ボタンが押された場合
if (!empty($_POST)) {
    // titleとcontentの入力チェック 
    if (empty($_POST["task"])) {
        echo 'Todoが未入力です。'; 
    }
    if (!empty($_POST["task"])) {
        //エスケープ処理
        $task = htmlspecialchars($_POST["task"], ENT_QUOTES); 
        // PDOのインスタンスを取得 
        $pdo = db_connect();
        try {
            // SQL文の準備
            $sql = "INSERT INTO tasks (task) VALUES (:task)";
            // プリペアドステートメントの準備 
            $stmt = $pdo->prepare($sql);
            // タイトルをバインド
            $stmt->bindParam(':task', $task);
            // 本文をバインド
            // 実行
            $stmt->execute();
            // main.phpにリダイレクト
            header("Location: main.php");
            exit;
        } catch (PDOException $e) { 
            // エラーメッセージの出力 
            echo 'Error: ' . $e->getMessage();
            // 終了
            die(); 
        }
    } 
}
?>
<!DOCTYPE html> <html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
</head>
<body>
    <h1>Todo追加</h1>
    <form method="POST" action="">
        Todo:<br>
        <input type="text" name="task" id="post" style="width:200px;height:50px;">
        <br>
        <input type="submit" value="submit" id="post" name="post">
    </form> 
</body>
</html>