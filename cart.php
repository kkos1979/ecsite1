<?php

require_once('common.php');

if (!isset($rows)) {//
  $rows = [];
}
if (!isset($errors)) {//
  $errors = [];
}
if (!isset($sum)) {//
  $sum = 0;
}
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

//postであれば数量を＋する。
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  check_token();
  unset($_POST['token']);

  foreach ($_POST as $key => $value) {
    //数量が正しく入力されているかチェック
    if (!isset($value) || $value === '') {
      echo '数量が入力されていません。';
      echo '<a href="index.php">戻る</a>';
      exit;
    } elseif (!is_numeric($value)) {
      echo '数量が不正です。<br>';
      echo '<a href="index.php">戻る</a>';
      exit;
    }
    $id = str_replace('num_', '', $key);
    if (!isset($_SESSION['cart'][$id])) {
      $_SESSION['cart'][$id] = 0;
    }
    $_SESSION['cart'][$id] += $value;
  }
  header('Location: http://localhost/shop/cart.php');//リロード対策
}

//商品情報の表示
$pdo = connect();
foreach ($_SESSION['cart'] as $id => $num) {
  //sql実行時にtryは必要か？必要ならどこまでtryで囲むべきか？
  try {
    $stmt = $pdo->prepare('SELECT * FROM goods WHERE id=:id');
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    $stmt->closeCursor();
    if ($num !== 0) {
      $row['num'] = strip_tags($num);
      $sum += $num * $row['price'];
      $rows[] = $row;
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  if (isset($row['num']) && $row['num'] > $row['stock']) {
    //html内で改行するには？
    $errors[] = "{$row['name']}の購入希望数が在庫数を超えています。\n購入希望数を減らしてください。";
  }
}

require_once('t_cart.php');

 ?>
