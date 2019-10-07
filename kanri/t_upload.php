<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品画像アップロード</title>
  <link rel="stylesheet" href="kanri.css">
</head>
<body>
  <div class="base">
    <?php if (count($errors) > 0): ?>
      <?php foreach ($errors as $error): ?>
        <span class="error"><?= h($error) ?></span><br>
      <?php endforeach; ?>
    <?php endif; ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <p>
        <?= h($_SESSION['name']); ?>の商品画像（JPEGのみ）<br>
        <input type="file" name="pic">
      </p>
      <p>
        <input type="hidden" name="id" value="<?= h($_SESSION['id']) ?>">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000">
        <input type="submit" name="submit" value="追加">
      </p>
    </form>
  </div>
  <div class="base">
    <a href="index.php">一覧に戻る</a>
  </div>
</body>
</html>
