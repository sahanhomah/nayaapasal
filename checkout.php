<?php
require 'includes/db.php';
session_start();
include 'includes/header.php';

$cart = $_SESSION['cart'] ?? [];
if(!$cart){
  echo '<main class="container"><p>Your cart is empty. <a href="index.php">Shop now</a></p></main>';
  include 'includes/footer.php'; exit;
}
$ids = implode(',', array_map('intval', array_keys($cart)));
$res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
$items = []; $total = 0;
while($r = $res->fetch_assoc()){ $items[] = $r; $total += $r['price'] * $cart[$r['id']]; }

// Handle Cash on Delivery POST
if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['cod'])){
  $user_id = isset($_SESSION['user']) ? intval($_SESSION['user']['id']) : NULL;
  $name = $conn->real_escape_string($_POST['name'] ?? 'Guest');
  $address = $conn->real_escape_string($_POST['address'] ?? 'Not provided');
  $items_json = $conn->real_escape_string(json_encode(array_map(function($p) use ($cart){ return ['id'=>$p['id'],'name'=>$p['name'],'qty'=>$cart[$p['id']],'price'=>$p['price']]; }, $items)));
  $status = 'COD';
  $query = "INSERT INTO orders (user_id,items,total_amount,status,name,address,created_at) VALUES (".($user_id?intval($user_id):'NULL').",'".$items_json."',".$total.", 'COD', '".$conn->real_escape_string($name)."', '".$conn->real_escape_string($address)."', NOW())";
  @mysqli_query($conn, $query);
  $_SESSION['cart'] = [];
  header('Location: thankyou.php');
  exit;
}

?>

<main class="container">
  <h1>Checkout</h1>
  <div class="card simple">
    <h3>Order Summary</h3>
    <ul>
      <?php foreach($items as $it): $q=$cart[$it['id']]; ?>
        <li><?=htmlspecialchars($it['name'])?> x <?=$q?> — Rs. <?=$it['price'] * $q?></li>
      <?php endforeach; ?>
    </ul>
    <p><strong>Total: Rs. <?=$total?></strong></p>
  </div>

  <div class="payment-options">
    <div class="card simple">
      <h3>Pay Online - Khalti</h3>
      <button id="khaltiBtn" class="btn">💜 Pay with Khalti</button>
      <p class="muted">Khalti test mode (demo).</p>
    </div>

    <div class="card simple">
      <h3>Cash on Delivery</h3>
      <form method="post">
        <input type="hidden" name="cod" value="1">
        <label>Name: <input name="name" required></label><br>
        <label>Address: <input name="address" required></label><br>
        <button class="btn" type="submit">💵 Confirm COD</button>
      </form>
    </div>
  </div>

</main>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
var config = {
    "publicKey": "test_public_key_dc74a3b4e97a4e6ea4e4cf8e6dbd4ea3",
    "productIdentity": "TechZoneOrder",
    "productName": "TechZone Order",
    "productUrl": "http://localhost/techzone_dark_khalti/",
    "eventHandler": {
        onSuccess (payload) {
            fetch('verify_khalti.php', {
                method: 'POST',
                headers: {'Content-Type':'application/json'},
                body: JSON.stringify(payload)
            }).then(r=>r.json()).then(data=>{
                if(data.success){ window.location.href = 'thankyou.php'; }
                else alert('Payment verification failed: ' + (data.message||'Unknown'));
            }).catch(e=>{ alert('Verify request failed'); });
        },
        onError (error) { console.log(error); },
        onClose () { console.log('widget closed'); }
    }
};
var checkout = new KhaltiCheckout(config);
document.getElementById('khaltiBtn').onclick = function () {
    checkout.show({amount: Math.round(<?=$total?> * 100)});
};
</script>

<?php include 'includes/footer.php'; ?>