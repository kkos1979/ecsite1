<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商品一覧</title>
  <link rel="stylesheet" href="kanri.css">
</head>
<body>
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
          <p>
            <a href="edit.php?id=<?= h($g['id']); ?>">修正</a>
          </p>
          <p>
            <a href="upload.php?id=<?= h($g['id']); ?>&name=<?= h($g['name']); ?>">画像</a>
          </p>
          <p>
            <a href="delete.php?id=<?= h($g['id']); ?>" onclick="return confirm('<?= h($g['name']); ?>を削除してよろしいですか？')">削除</a>
          </p>
        </td>
      </tr>
    <?php endforeach;?>
  </table>
  <div class="base">
    <a href="insert.php">新規追加</a>
    <a href="../index.php" target="blank">サイト確認</a>
  </div>
</body>
</html>
