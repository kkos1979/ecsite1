<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品追加</title>
  <link rel="stylesheet" href="kanri.css">
</head>
<body>
  <?php if (count($errors) > 0): ?>
    <div class="base">
      <?php foreach ($errors as $error): ?>
        <span class="error"><?= h($error); ?></span><br>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <div class="base">
    <form action="insert.php" method="post">
      <p>
        商品名<br>
        <input type="text" name="name" value="<?= isset($name) ? h($name) : ''; ?>">
      </p>
      <p>
        商品説明<br>
        <textarea name="comment" rows="10" cols="50"><?= isset($comment) ? h($comment) : ''; ?></textarea>
      </p>
      <p>
        価格<br>
        <input type="text" name="price" value="<?= isset($price) ? h($price) : ''; ?>">円
      </p>
      <p>
        在庫<br>
        <input type="text" name="stock" value="<?= isset($stock) ? h($stock) : ''; ?>">個
      </p>
      <p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <input type="submit" name="submit" value="追加">
      </p>
    </form>
  </div>
  <div class="base">
    <a href="index.php">一覧に戻る</a>
  </div>
</body>
</html>
