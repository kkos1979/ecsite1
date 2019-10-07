<?php

require_once('common.php');

$pdo = connect();
try {
  $stmt = $pdo->query('SELECT * FROM goods');
  $goods = $stmt->fetchAll();
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

//ワンタイムでないトークンの発行
if (!isset($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}

require_once('t_index.php');

?>
