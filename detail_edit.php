<?php

require_once('config.php');
require_once('functions.php');

// 受け取ったレコードのID
$id = $_GET['id'];

// データベースへの接続
$dbh = connectDb();

// SQLの準備と実行
$sql = "select * from tasks where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

// 結果の取得
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// タスクの編集
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 受け取ったデータ
    $title = $_POST['detail'];

    // エラーチェック用の配列
    $errors = array();

    // バリデーション
    if ($title == '') {
        $errors['detail'] = 'タスク名を入力してください';
    }

    if ($title == $post['detail']) {
        $errors['detail'] = 'タスク名が変更されていません';
    }

    // エラーが1つもなければレコードを更新
    if (empty($errors)) {
        $dbh = connectDb();

        $sql = "update tasks set detail = :detail, updated_at = now() where id = :id";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":detail", $title);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        header('Location: index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>タスク詳細の編集画面fds</title>
</head>
<body>
<h2>タスク詳細の編集</h2>
<p>
    <form action="" method="post">
        <input type="text" name="detail">
        <input type="submit" value="編集">
    </form>
    <a href="index.php">タスク管理アプリに戻る</a>
</p>
</body>
</html>