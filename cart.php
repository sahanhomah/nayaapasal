<?php
require 'includes/db.php';
session_start();
// Add to cart
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['product_id'])){
  $pid = intval($_POST['product_id']);
  $qty = max(1,intval($_POST['quantity'] ?? 1));
  $_SESSION['cart'][$pid] = ($_SESSION['cart'][$pid] ?? 0) + $qty;
  header('Location: cart.php');
  exit;
}
include 'includes/header.php';
$cart = $_SESSION['cart'] ?? [];
$products = [];
$total = 0;
if($cart){
  $ids = implode(',', array_map('intval', array_keys($cart)));
  $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
  while($r = $res->fetch_assoc()){ $products[] = $r; $total += $r['price'] * $cart[$r['id']]; }
}
?>
<main class="container">
  <h1>Your Cart</h1>
  <?php if(!$products): ?>
    <p>Your cart is empty. <a href="index.php">Continue shopping</a></p>
  <?php else: ?>
    <table class="cart">
      <tr><th>Product</th><th>Qty</th><th>Price</th></tr>
      <?php foreach($products as $p): $q=$cart[$p['id']]; ?>
        <tr>
          <td><?=$p['name']?></td>
          <td><?=$q?></td>
          <td>Rs. <?=$p['price'] * $q?></td>
        </tr>
      <?php endforeach; ?>
      <tr class="total"><td colspan="2">Total</td><td>Rs. <?=$total?></td></tr>
    </table>
    <a class="btn" href="checkout.php">Checkout</a>
  <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>