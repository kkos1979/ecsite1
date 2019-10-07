<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>新規登録</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <?php if(isset($message)): ?>
    <div class="base">
      <p>
        <?= h($message); ?>
      </p>
      <button class="btn" type="button" onclick="location.href='login.php'">ログイン</button>
    </div>
  <?php else: ?>
  <h1>新規登録</h1>
  <div class="base">
    <?php if (isset($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <p><span class="error"><?= h($error); ?></span></p>
      <?php endforeach; ?>
    <?php endif; ?>
    <form action="signup.php" method="post">
      <p>
        お名前：<br>
        <input type="text" name="name" value="<?= isset($name) ? h($name) : ''; ?>">
      </p>
      <p>
        ご住所：<br>
        <input type="text" name="address" value="<?= isset($address) ? h($address) : ''; ?>">
      </p>
      <p>
        電話番号<br>
        <input type="text" name="tel" value="<?= isset($tel) ? h($tel) : ''; ?>">
      </p>
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
        <input type="submit" value="新規登録">
      </p>
    </form>
  </div>
<?php endif; ?>
  <div class="base">
    <a href="index.php">お買い物に戻る</a>
    <a href="cart.php">カートに戻る</a>
  </div>
</body>
</html>
