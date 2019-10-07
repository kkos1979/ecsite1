<?php

require_once('common.php');

$errors = [];
$name = $comment = $price = '';

$pdo = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_token();

  if (!isset($_POST['name']) || !is_string($_POST['name']) || $_POST['name'] === '') {
    $errors[] = '商品名が入力されていません。';
  }
  if (!isset($_POST['comment']) || !is_string($_POST['comment']) || $_POST['comment'] === '') {
    $errors[] = '商品説明が入力されていません。';
  }
  if (!isset($_POST['price']) || !is_string($_POST['price']) || $_POST['price'] === '') {
    $errors[] = '価格が入力されていません。';
  } elseif (!preg_match('/\A\d+\z/', $_POST['price'])) {
    $errors[] = '価格は半角数字で入力してください。';
  }
  if (!isset($_POST['stock']) || !is_string($_POST['stock']) || $_POST['stock'] === '') {
    $errors[] = '在庫数が入力されていません。';
  } elseif (!preg_match('/\A\d+\z/', $_POST['stock'])) {
    $errors[] = '在庫数は半角数字入力してください。';
  }

  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];

  if (count($errors) === 0) {
    try {
      $stmt = $pdo->prepare('INSERT INTO goods (name, comment, price, stock) VALUES (:name, :comment, :price, :stock)');
      $stmt->bindValue('name', $name, PDO::PARAM_STR);
      $stmt->bindValue('comment', $comment, PDO::PARAM_STR);
      $stmt->bindValue('price', $price, PDO::PARAM_INT);
      $stmt->bindValue('stock', $stock, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    header('location: index.php');
    exit;
  }
}

require_once('t_insert.php');

 ?>
