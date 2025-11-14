<?php
require 'includes/db.php';
include 'includes/header.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM products WHERE id=?');
$stmt->bind_param('i',$id);
$stmt->execute();
$res = $stmt->get_result();
$p = $res->fetch_assoc();
if(!$p){ echo '<p>Product not found.</p>'; include 'includes/footer.php'; exit; }
?>
<main class="container">
  <div class="product-detail">
    <img src="assets/images/<?=$p['image']?>" alt="<?=$p['name']?>">
    <div class="info">
      <h2><?=$p['name']?></h2>
      <p class="price">Rs. <?=$p['price']?></p>
      <p><?=$p['description']?></p>
      <form method="post" action="cart.php">
        <input type="hidden" name="product_id" value="<?=$p['id']?>">
        <label>Quantity: <input type="number" name="quantity" value="1" min="1"></label>
        <button class="btn" type="submit">Add to cart</button>
      </form>
    </div>
  </div>
</main>
<?php include 'includes/footer.php'; ?>