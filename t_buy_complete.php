<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>購入完了 | Noodle Shop</title>
  <link rel="stylesheet" href="shop.css">
</head>
<body>
  <div class="base">
    商品が購入されました。<br>
    ご購入ありがとうございました。<br>
    -----------------商品送付先------------------<br>
    お名前　：　<?= h($name); ?>様 <br>
    ご住所　：　<?= h($address); ?> <br>
    電話番号：　<?= h($tel); ?> <br>
    <?php foreach ($rows as $row): ?>
    -----------------ご購入商品------------------<br>
    商品名　：<?= h($row['name']); ?><br>
    単価　　：<?= h($row['price']); ?>円<br>
    数量　　：<?= h($row['num']); ?><br>
    -----------------------------------------------<br>
    小計　　：<?= h($row['total']); ?>円<br>
    -----------------------------------------------<br>
    <?php endforeach; ?>
    合計　　：<?= h($sum); ?>円<br>
  </div>
  <div class="base">
    <a href="index.php">お買い物に戻る</a>
  </div>
</body>
</html>
