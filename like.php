<?php

    require_once("dbconnect.php");

    $feed_id = $_POST["feed_id"];
    $user_id = $_POST["user_id"];

    if (isset($_POST["is_liked"])){
      //いいねボタンが押された時
      //どの記事をだれがいいねしたか、likesテーブルに保存
      $sql = "INSERT INTO `likes` (`user_id`, `feed_id`) VALUES (?, ?);";
    }else{
      //いいねを取り消すボタンが押された時
      //保存されてる、like情報をlikesテーブルから削除
      $sql = "DELETE FROM `likes` WHERE `user_id`=? AND `feed_id`=?";
    }

    $data = [$user_id, $feed_id];
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute($data);

     echo json_encode($res);
