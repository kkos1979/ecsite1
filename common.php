<?php

session_start();

function connect() {
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //静的プレースホルダの使用
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  } catch (Exception $e) {
    echo 'DB接続エラーがありました。<br>';
    $e->getMessage;
  }
}

function img_tag($id) {
  if (file_exists("images/$id.jpg")) {
    $name = $id;
  } else {
    $name = 'noimage';
  }
  return '<img src="images/' . $name . '.jpg" alt="">';
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function check_token() {
  if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
    echo '不正なリクエスト';
    exit;
  }
}
