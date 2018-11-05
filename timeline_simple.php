<?php
  session_start();
  require('functions.php');
  require('dbconnect.php');

  // v($_SESSION["id"],'$_SESSION["id"]');

  //ユーザー情報の取得
  $sql = 'SELECT * FROM `users` WHERE `id`=?';
  $data = array($_SESSION['id']);

  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

  // v($signin_user,'$signin_user');

  $validations=[];

  // POST送信されたら、空チェック
  if (!empty($_POST)){
    $feed = $_POST['feed'];

    if ($feed == ''){
      $validations['feed'] = 'blank';
    }else{
      //DBに投稿データを保存する
      $sql = 'INSERT INTO `feeds` SET `feed`=?, `user_id`=?, `created`=NOW()';
      $data = array($feed, $signin_user['id']);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);

    }
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
  <style>
    .error_msg {
      color: red;
    }
  </style>
</head>
<body>
ユーザー情報[<img width="30" src="user_profile_img/<?php echo $signin_user['img_name']; ?>" /> <?php echo $signin_user["name"]; ?>]
[<a href="signout.php">サインアウト</a>]
<form method="POST" action="">
<textarea rows="5" name="feed"></textarea>
<input type="submit" value="投稿" />
<br>
<?php if(isset($validations['feed']) && $validations['feed'] == 'blank'): ?>
<span class="error_msg">投稿データを入力して下さい</span>
<?php endif; ?>
</form>
</body>
</html>