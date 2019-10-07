<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Noodle Shop</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <div class="container">
    <h1>Noodle Shop</h1>
    <?php if(isset($_SESSION['user']['name'])) : ?>
      <div class="base">
        <p><?= h($_SESSION['user']['name']); ?>さん、こんにちは。</p>
        <p>
          <button class="btn" type="button" onclick="location.href='logout.php'">ログアウト</button>
        </p>
      </div>
    <?php else : ?>
      <div class="base">
        <button class="btn" type="button" onclick="location.href='login.php'">ログイン</button>
        <button class="btn" type="button" onclick="location.href='signup.php'">新規登録</button>
      </div>
    <?php endif;?>
    <form action="/shop/cart.php" method="post">
      <table>
        <?php foreach ($goods as $g): ?>
          <tr>
            <td>
              <?= img_tag($g['id']); ?>
            </td>
            <td>
              <p class="goods"><?= h($g['name']); ?></p>
              <p><?= nl2br(h($g['comment'])); ?></p>
            </td>
            <td width="80">
              <p><?= h($g['price']); ?>円</p>
              <p>在庫 <?= h($g['stock']); ?> 個</p>
            </td>
            <td>
              <?php if ($g['stock'] > 0): ?>
                <select name="num_<?= h($g['id']); ?>">
                  <?php for ($i = 0; $i <= $g['stock']; $i++): ?>
                    <option><?= $i; ?></option>
                  <?php endfor; ?>
                </select>
              <?php else: ?>
                <p>品切れ中</p>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="base">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <input type="submit" value="カートへ">
      </div>
    </form>
  </div>
</body>
</html>
