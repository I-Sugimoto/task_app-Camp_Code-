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

// // タスクの編集
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     // 受け取ったデータ
//     $detail = $_POST['detail'];

//     // エラーチェック用の配列
//     $errors = array();

//     // バリデーション
//     if ($detail == '') {
//         $errors['detail'] = '詳細を入力してください';
//     }

//     if ($title == $post['detail']) {
//         $errors['detail'] = '詳細が変更されていません';
//     }

//     // エラーが1つもなければレコードを更新
//     if (empty($errors)) {
//         $dbh = connectDb();

//         $sql = "update tasks set detail = :detail, updated_at = now() where id = :id";

//         $stmt = $dbh->prepare($sql);
//         $stmt->bindParam(":detail", $detail);
//         $stmt->bindParam(":id", $id);
//         $stmt->execute();

//         header('Location: index.php');
//         exit;
//     }
// }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>タスクの詳細</title>
</head>
<body>
<h2>タスクの詳細</h2>
        <li>
        <?php foreach ($tasks as $task) : ?>
    <?php if ($task['detail'] != '') : ?>
        <li>
            <?php echo h($task['detail']); ?>
        </li>
    <?php endif; ?>
<?php endforeach; ?>
        </li>
        <a href="detail_edit.php?id=<?php echo h($task['id']); ?>">タスクの詳細を編集</a>
</body>
</html>