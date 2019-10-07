<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <h1>ログイン</h1>
  <div class="base">
    <?php if (count($errors) > 0): ?>
      <?php foreach ($errors as $error): ?>
        <p><span class="error"><?= h($error); ?></span></p>
      <?php endforeach; ?>
    <?php endif; ?>
    <form action="login.php" method="post">
      <p>
        メールアドレス：<br>
        <input type="text" name="email" value="<?= isset($email) ? h($email) : ''; ?>">
      </p>
      <p>
        パスワード：<br>
        <input type="password" name="password">
      </p>
      <p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <input type="submit" value="ログイン">
        <button class="btn" type="button" onclick="location.href='signup.php'">新規登録</button>
      </p>
    </form>
  </div>
  <div class="base">
    <a href="index.php">お買い物に戻る</a>
    <a href="cart.php">カートに戻る</a>
  </div>
</body>
</html>
