<?php

function connect() {
    return new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root', '');
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function img_tag($id) {
  if (file_exists("../images/$id.jpg")) {
    $name = $id;
  } else {
    $name = 'noimage';
  }
  return '<img src="../images/' . $name . '.jpg" alt="">';
}

function check_token() {
  if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
    echo '不正なリクエスト';
    exit;
  }
}

session_start();
