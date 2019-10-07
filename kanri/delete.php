<?php

require_once('common.php');

$pdo = connect();
$id = $_GET['id'];
try {
  $stmt = $pdo->prepare('DELETE FROM goods WHERE id=:id');
  $stmt->bindValue('id', $id, PDO::PARAM_INT);
  $stmt->execute();

} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}
header('Location: index.php');
 ?>
