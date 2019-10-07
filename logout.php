<?php

require_once('common.php');

$_SESSION = [];

if (isset($_COOKIE['PHPSESSID'])) {
  setcookie('PHPSESSID', '', time()-64800, '/');
}

session_destroy();

header('Location: http://localhost/shop/index.php');

 ?>
