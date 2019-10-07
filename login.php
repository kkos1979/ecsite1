<?php

require_once('common.php');

if (isset($_SESSION['user'])) {
  header('Location: http://localhost/shop/index.php');
  exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_token();

  if (!isset($_POST['email']) || !is_string($_POST['email']) || $_POST['email'] === '') {
    $errors[] = 'メールアドレスが入力されていません。';
  } else {
    $email = $_POST['email'];
  }
  if (!isset($_POST['password']) || !is_string($_POST['password']) || $_POST['password'] === '') {
    $errors[] = 'パスワードが入力されていません。';
  }

  if (count($errors) === 0) {
    $pdo = connect();
    try {
      $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');

      // $stmt->execute([
      //   ':email' => $_POST['email'],
      // ]);

      $stmt->bindValue('email', $_POST['email'], PDO::PARAM_STR);
      $stmt->execute();
      $user = $stmt->fetch();
    } catch (PDOException $e) {
      echo 'エラーがありました。';
      echo $e->getMessage();
      exit;
    }

    if ($user) {        //DBにemail登録されているかいないかの判断はこれでいいのか？
      if (password_verify($_POST['password'], $user['password'])) {
        //セッションハイジャック対策（記載個所はOK？）
        session_regenerate_id(true);
        //SESSION['user']でログインを判断してもよいか？
        $_SESSION['user'] = $user;
        header('Location: http://localhost/shop/index.php');
      } else {
        $errors[] = 'メールアドレスまたはパスワードが間違えています。';
      }
    } else {
      $errors[] = 'メールアドレスまたはパスワードが間違えています。';
    }
  }
}

require_once('t_login.php');

 ?>
