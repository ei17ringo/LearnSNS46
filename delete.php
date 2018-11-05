<?php
// DBに接続
 require('dbconnect.php');
 require('functions.php');

 //http://localhost/LearnSNS/delete.php?feed_id=10
 // というURLでここのファイルにアクセスすると、?以降のfeed_idがGET送信されて来る
 // $_GET["feed_id"]には10が格納されている

 v($_GET['feed_id'],"feed_id");

// 削除したいFeedのIDを取得
 $feed_id = $_GET['feed_id'];


// Delete文作成
$sql = "DELETE FROM `feeds` WHERE `feeds`.`id`=?";

//演習 これ以降の処理部分を作って、削除機能を完成させましょう！

// Delete文実行(SQLインジェクションを防ぐ)
$data = array($feed_id);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

// タイムライン一覧にもどる
header("Location: timeline.php");
exit();


?>