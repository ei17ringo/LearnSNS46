<?php
    session_start();
    require('../functions.php');
    
    v($_POST, '$_POST');

    // 2種類
    // 毎回必ず処理したいプログラム
    echo 'Aの処理<br>';

    // バリデーション格納用の配列を用意
    $validations = array();
    $name = '';
    $email = '';

    // ユーザーが送信ボタンを押したとき
    // POSTが空じゃない時
    if (!empty($_POST)) {
        // ユーザーがデータを送信したときのみ処理したいプログラム
        echo 'Bの処理<br>';

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // バリデーション
        // ユーザー名の空
        if ($name == '') {
            $validations['name'] = 'blank';
        }

        // メールアドレスの空
        if ($email == '') {
            $validations['email'] = 'blank';
        }

        $c = strlen($password);
        // パスワードの空
        if ($password == '') {
            $validations['password'] = 'blank';
        } elseif ($c < 4 || 16 < $c) {
            $validations['password'] = 'length';
        }

        // 画像の選択
        $file_name = $_FILES['img_name']['name'];
        v($file_name, '$file_name');
        if ($file_name == '') {
            $validations['img_name'] = 'blank';
        }


        // もしすべてのバリデーションに引っかからなければ
        if (empty($validations)) {

            // 画像アップロード処理
            v($_FILES, '$_FILES');
            // move_uploaded_file(送りたいファイルデータ, 送信先);
            $tmp_file = $_FILES['img_name']['tmp_name']; // 選択した画像データ
            $file_name = date('YmdHis') . $_FILES['img_name']['name'];
            $destination = '../user_profile_img/' . $file_name; // 登録先と保存名
            move_uploaded_file($tmp_file, $destination);

            $_SESSION['46_LearnSNS']['name'] = $name;
            $_SESSION['46_LearnSNS']['email'] = $email;
            $_SESSION['46_LearnSNS']['password'] = $password;
            $_SESSION['46_LearnSNS']['file_name'] = $file_name;

            // HTMLのaタグと同じ処理をする関数
            // 要は指定した文字列にURLを書き換えて実行する
            header('Location: check.php');
            exit();
        }
    }

    // 毎回必ず処理したプログラム
    echo 'Cの処理<br>';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title></title>
  <meta charset="utf-8">
  <style>
    .error_msg {
      color: red;
      font-size: 12px;
    }
  </style>
</head>
<body>
  <h1>ユーザー登録</h1>
  <form method="POST" action="" enctype="multipart/form-data">
    
    <div>
      ユーザー名<br>
      <input type="text" name="name" value="<?= $name; ?>">
      <?php if(isset($validations['name']) && $validations['name'] == 'blank'): ?>
        <span class="error_msg">ユーザー名を入力してください</span>
      <?php endif; ?>
    </div>

    <div>
      メールアドレス<br>
      <input type="email" name="email" value="<?= $email; ?>">
      <?php if(isset($validations['email']) && $validations['email'] == 'blank'): ?>
        <span class="error_msg">メールアドレスを入力してください</span>
      <?php endif; ?>
    </div>

    <div>
      パスワード<br>
      <input type="password" name="password" value="">
      <?php if(isset($validations['password']) && $validations['password'] == 'blank'): ?>
        <span class="error_msg">パスワードを入力してください</span>
      <?php endif; ?>
      <?php if(isset($validations['password']) && $validations['password'] == 'length'): ?>
        <span class="error_msg">パスワードは4 - 16文字で入力してください</span>
      <?php endif; ?>
    </div>

    <div>
      プロフィール画像<br>
      <input type="file" name="img_name" accept="image/*">
      <?php if(isset($validations['img_name']) && $validations['img_name'] == 'blank'): ?>
        <span class="error_msg">画像を選択してください</span>
      <?php endif; ?>
    </div>

    <input type="submit" value="確認">
  </form>
</body>
</html>














