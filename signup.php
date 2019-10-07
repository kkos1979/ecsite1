<?php

require_once('common.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  check_token();

  //送信されていない（直接のアクセス？）、配列でない、空文字でないことのチェック
  if (!isset($_POST['name']) || !is_string($_POST['name']) || $_POST['name'] === '') {
    $errors[] = 'お名前が入力されていません。';
  } else {
    $name = $_POST['name'];

  }
  if (!isset($_POST['address']) || !is_string($_POST['address']) || $_POST['address'] === '') {
    $errors[] = 'ご住所が入力されていません。';
  } else {
    $address = $_POST['address'];
  }
  if (!isset($_POST['tel']) || !is_string($_POST['tel']) || $_POST['tel'] === '') {
    $errors[] = '電話番号が入力されていません。';
  } elseif (!preg_match('/\A\d{2,4}-?\d{2,4}-?\d{4}\z/', $_POST['tel'])) {
    $errors[] = '正しい電話番号を入力してください。';
  } else {
    $tel = $_POST['tel'];
  }
  if (!isset($_POST['email']) || !is_string($_POST['email']) || $_POST['email'] === '') {
    $errors[] = 'メールアドレスが入力されていません。';
  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しいメールアドレスを入力してください。';
  } else {
    $email = $_POST['email'];
  }
  if (!isset($_POST['password']) || !is_string($_POST['password']) || $_POST['password'] === '') {
    $errors[] = 'パスワードが入力されていません。';
  }

  if (count($errors) === 0) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $pdo = connect();
    try {
      $stmt = $pdo->prepare('INSERT INTO users (name, address, tel, email, password)
      VALUES (:name, :address, :tel, :email, :password)');
      $stmt->bindValue('name', $name, PDO::PARAM_STR);
      $stmt->bindValue('address', $address, PDO::PARAM_STR);
      $stmt->bindValue('tel', $tel, PDO::PARAM_STR);
      $stmt->bindValue('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {  //このエラーはmailが重複していた場合のみ、と考えてもよいか？
      $errors[] = '既に登録されているメールアドレスです。';
    }
    if ($stmt->rowCount() === 1) {      //登録ができたかの確認？
      $message = '新規登録完了しました。';
    }
  }
}

require_once('t_signup.php');

 ?>
