<?php

require_once('common.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  check_token();

  if (!isset($_FILES['pic']['error']) || !is_int($_FILES['pic']['error'])) {
    $errors[] = 'パラメータが不正です。';
  }

  switch ($_FILES['pic']['error']) {
    case UPLOAD_ERR_OK:
      break;
    case UPLOAD_ERR_NO_FILE:
      $errors[] = 'ファイルが選択されていません。';
      break;
    case UPLOAD_ERR_INT_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      $errors[] = 'ファイルサイズが大きすぎます。';
      break;
    default:
      $errors[] = 'その他のエラーが発生しました。';
  }

  if (count($errors) === 0) {
    if (!array_search(mime_content_type($_FILES['pic']['tmp_name']),
      array(
        'jpg' => 'image/jpeg',
      ), true
    )) {
      $errors[] = 'ファイル形式がJPEGではありません。';
    }
  }

  if (count($errors) === 0) {
    $uploadedFile = $_FILES['pic']['tmp_name'];
    list($width, $height) = getimagesize($uploadedFile);
    $image = imagecreatetruecolor(100, 100);
    $baseImage = imagecreatefromjpeg($uploadedFile);
    imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 100, 100, $width, $height);
    $id = $_POST['id'];
    imagejpeg($image, "../images/$id.jpg");
    // if (move_uploaded_file($_FILES['pic']['tmp_name'], "../images/$id.jpg")) {
      header('Location: index.php');
      exit;
    // }
  }

} else {
  if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
  }
  if (isset($_GET['name'])) {
    $_SESSION['name'] = $_GET['name'];
  }
}

require_once('t_upload.php');

 ?>
