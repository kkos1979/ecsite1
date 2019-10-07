<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>カート | Noodle Shop</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <h1>カート</h1>
  <div class="base">
    <?php if (isset($_SESSION['user'])) :?>
      <p><?= h($_SESSION['user']['name']); ?> さんのカート</p>
    <?php else: ?>
      <p>
        ゲストさんのカート
        <button class="btn right" type="button" onclick="location.href='login.php'">ログイン</button>
      </p>
    <?php endif;?>
  </div>
  <?php if (count($errors) > 0): ?>
    <div class="base">
      <?php foreach ($errors as $error): ?>
        <p><span class="error"><?= h($error); ?></span></p>
      <?php endforeach; ?>
    </div>
  <?php endif;?>
  <?php if (!empty($rows)): ?>
    <table>
      <tr>
        <th>商品名</th><th>単価</th><th>購入希望数</th><th>在庫数</th><th>小計</th>
      </tr>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= h($row['name']); ?></td>
          <td><?= h($row['price']); ?>円</td>
          <td><?= h($row['num']); ?>個</td>
          <td><?= h($row['stock']); ?>個</td>
          <td><?= h($row['price'] * $row['num']); ?>円</td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3"> </td><td><strong>合計</strong></td><td><?= h($sum); ?>円</td>
      </tr>
    </table>
  <?php else: ?>
    <div class="base">
      <p>カートの中身はありません。</p>
    </div>
  <?php endif;?>
  <div class="base">
    <a href="index.php">お買い物に戻る</a>
    <a href="cart_empty.php">カートを空にする</a>
    <?php if ($sum > 0 && count($errors) === 0) :?>
      <a href="buy.php">購入する</a>
    <?php endif;?>
  </div>
</body>
</html>
