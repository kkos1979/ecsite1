<?php

require_once('common.php');

$errors = [];
$name = $address = $tel ='';
$rows = [];

if (!isset($_SESSION['buy_token'])) {
  $_SESSION['buy_token'] = bin2hex(openssl_random_pseudo_bytes(16));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  check_token();

  //ボタン連打による二重送信を防止するには？
  if (!isset($_SESSION['buy_token']) || !isset($_POST['buy_token']) || $_SESSION['buy_token'] !== $_POST['buy_token']) {
    return;
  }

  unset($_SESSION['buy_token']);

  if (!isset($_POST['name']) || !is_string($_POST['name']) || $_POST['name'] === '') {
    $errors[] = 'お名前を入力してください。';
  }
  if (!isset($_POST['address']) || !is_string($_POST['name']) ||$_POST['address'] === '') {
    $errors[] = 'ご住所を入力してください。';
  }
  if (!isset($_POST['tel']) || !is_string($_POST['tel']) || $_POST['tel'] === '') {
    $errors[] = '電話番号を入力してください。';
  } elseif (!preg_match('/\A\d{2,4}-?\d{2,4}-?\d{4}\z/', $_POST['tel'])) {
    $errors[] = '電話番号が正しくありません。';
  }
  // if (preg_match('/\A\d{2,4}-?\d{2,4}-?\d{4}\z/', $tel)) {
  //   $tel = $_POST['tel'];
  // } else {
  //   $error .= '電話番号が正しくありません。<br>';
  // }

  $name = $_POST['name'];
  $address= $_POST['address'];
  $tel = $_POST['tel'];

  if (count($errors) === 0) {
    $body = <<<EOD
      商品が購入されました。
      ご購入ありがとうございました。
      -----------------商品送付先------------------
      お名前　：　{$name}様
      ご住所　：　$address
      電話番号：　$tel
      -----------------ご購入商品------------------
EOD;
    $sum = 0;
    $pdo = connect();

    //購入された個々の商品に対する処理
    foreach ((array)$_SESSION['cart'] as $id => $num) {
      try {
        $stmt = $pdo->prepare('SELECT * FROM goods WHERE id=:id');
        $stmt->execute([':id' => $id]);
      } catch (PDOException $e) {  //
        echo 'エラーが発生しました。';
        echo $e->getMessage();
        exit;
      }
      $row = $stmt->fetch();
      $stmt->closeCursor();

      //idが存在するかのエラーチェック
      if ($row) {
        if ($num > 0) {
          $row['num'] = $num;
          $row['total'] = $row['price'] * $num;
          $body .= <<<EOD
          商品名　：{$row['name']}
          単価　　：{$row['price']}円
          数量　　：{$row['num']}
          -----------------------------------------------
          小計　　：{$row['total']}円
          -----------------------------------------------
          EOD;
          $sum += $row['price'] * $num;
          $rows[] = $row;

        }
      } else {
        echo '存在しない商品です。';
        exit;
      }

      //在庫の減少処理
      try {
        $stmt = $pdo->prepare('UPDATE goods SET stock= stock - :num WHERE id=:id');
        $stmt->execute([
          ':id' => $id,
          'num' => $num,
        ]);
      } catch (PDOException $e) {  //
        echo 'エラーが発生しました。';
        echo $e->getMessage();
        exit;
      }

    }
  $body .= "合計　　：{$sum}円";
  $from = "kkos197919791979@gmail.com";
  //本来は　$_SESSION['user']['email']; にする。
  $to = "kkos197919791979@gmail.com";
  mb_send_mail($to, '購入メール', $body, "From: $from"); //メールで送ると
  $_SESSION['cart'] = null;
  // $is_disabled = '';
  require_once('t_buy_complete.php');
  exit;
}
}
require_once('t_buy.php');
 ?>
