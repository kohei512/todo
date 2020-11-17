<?php
// db_connect.phpの読み込み
require_once('db_connect.php');

session_start();

// PDOのインスタンスを取得
$pdo = db_connect();
try {
    // SQL文の準備
    $sql = "SELECT * FROM tasks ORDER BY id ASC"; 
    // プリペアドステートメントの作成 
    $stmt = $pdo->prepare($sql); 
    // 実行
    $stmt->execute();
} catch (PDOException $e) { 
    // エラーメッセージの出力 
    echo 'Error: ' . $e->getMessage();
    // 終了
    die();
}
?>
<!doctype html> 
<html>
<head>
    <meta charset="UTF-8">
    <title>Todoリスト</title> 
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2>Todoリスト</h2>
        <a href="create_post.php">Todo追加!</a><br />
        </div>
    <table>
        <tr>
            <td>Todoリスト</td> 
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['task']; ?></td> 
                <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
                <td><?php echo $row['time']; ?></td>
            </tr>
        <?php } ?> 
    </table>
</body> 
</html>