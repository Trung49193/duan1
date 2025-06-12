<!-- client/views/product/detail.php -->
<?php include "../user/layout.php"; ?>

<div class="product-detail">
  <h2><?= $product['name'] ?></h2>
  <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="300">
  <p><strong>Giá:</strong> <?= number_format($product['price']) ?> VND</p>
  <p><strong>Mô tả:</strong> <?= $product['description'] ?></p>
  <form method="post" action="index.php?act=add_cart">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <label>Số lượng: <input type="number" name="quantity" value="1" min="1"></label>
    <button type="submit">Thêm vào giỏ hàng</button>
  </form>
</div>
