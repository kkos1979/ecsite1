<?php

require_once('common.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_token();

  if (!isset($_POST['name']) || !is_string($_POST['name'])  || $_POST['name'] === '') {
    $errors[] = '商品名を入力してください。';
  }
  if (!isset($_POST['comment']) || !is_string($_POST['comment'])  || $_POST['comment'] === '') {
    $errors[] = '商品説明を入力してください。';
  }
  if (!isset($_POST['price']) || !is_string($_POST['price'])  || $_POST['price'] === '') {
    $errors[] = '価格を入力してください。';
  } elseif (!preg_match('/\A\d+\Z/', $_POST['price'])) {
    $errors[] = '価格は半角数字で入力してください。';
  }
  if (!isset($_POST['stock']) || !is_string($_POST['stock'])  || $_POST['stock'] === '') {
    $errors[] = '商品在庫数を入力してください。';
  } elseif (!preg_match('/\A\d+\z/', $_POST['stock'])) {
    $errors[] = '商品在庫数は半角数字で入力してください。';
  }

  $id = $_POST['id'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];

  if (count($errors) === 0) {
    $pdo = connect();
    try {
      $stmt = $pdo->prepare('UPDATE goods SET name=:name, comment=:comment, price=:price, stock=:stock WHERE id=:id');
      $stmt->bindValue('name', $name, PDO::PARAM_STR);
      $stmt->bindValue('comment', $comment, PDO::PARAM_STR);
      $stmt->bindValue('price', $price, PDO::PARAM_INT);
      $stmt->bindValue('id', $id, PDO::PARAM_INT);
      $stmt->bindValue('stock', $stock, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    header('Location: index.php');
    exit;
  }
} else {
  $id = $_GET['id'];
  $pdo = connect();
  try {
    $stmt = $pdo->prepare('SELECT * FROM goods WHERE id=:id');
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $name = $row['name'];
    $comment = $row['comment'];
    $price = $row['price'];
    $stock = $row['stock'];
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}

require_once('t_edit.php');

 ?>
