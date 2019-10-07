<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>購入 | Noodle Shop</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <div id="loading" class="">
    <h1>読み込み中…</h1>
  </div>
  <div id="contents" class="hidden">
    <h1>購入</h1>
    <div class="base">
      <?php if (count($errors) > 0): ?>
        <div class="base">
          <?php foreach ($errors as $error) : ?>
            <span class="error"><?= h($error); ?></span><br>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <p>商品のご送付先を入力してください。</p>
      <?php if (!isset($_SESSION['user'])): ?>
        <p>ログインしていただくとご登録いただいている情報が入力されます。</p>
      <?php endif; ?>
      <form action="buy.php" method="post">
        <p>
          お名前：<br>
          <input type="text" name="name" value="<?=
          isset($_SESSION['user']) ? $_SESSION['user']['name'] : $name; ?>">
        </p>
        <p>
          ご住所：<br>
          <input type="text" name="address" size="60" value="<?=
          isset($_SESSION['user']) ? $_SESSION['user']['address']: $address; ?>">
        </p>
        <p>
          電話番号：<br>
          <input type="text" name="tel" value="<?=
          isset($_SESSION['user']) ? $_SESSION['user']['tel']: $tel; ?>">
        </p>
        <p>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          <input type="hidden" name="buy_token" value="<?= h($_SESSION['buy_token']); ?>">
          <input type="submit" value="購入">
        </p>
      </form>
    </div>
    <div class="base">
      <a href="index.php">お買い物に戻る</a>
      <a href="cart.php">カートに戻る</a>
      <?php if (!isset($_SESSION['user'])): ?>
        <button class="btn" type="button" onclick="location.href='login.php'">ログイン</button>
      <?php endif; ?>
    </div>
  </div>
</body>
<script type="text/javascript">
  let loading = document.getElementById('loading');
  let contents = document.getElementById('contents');

  window.addEventListener('load', function() {
    loading.style.display = 'none';
    contents.classList.remove('hidden');
  });
</script>
</html>
