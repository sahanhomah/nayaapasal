<?php
require 'includes/db.php';
include 'includes/header.php';
$cats = $conn->query("SELECT DISTINCT category FROM products")->fetch_all(MYSQLI_ASSOC);
$res = $conn->query("SELECT * FROM products");
$products = $res->fetch_all(MYSQLI_ASSOC);
?>
<main class="container">
  <div class="hero">
    <h1>MeroPasal</h1>
    <p class="tag">Your hub for cutting-edge electronics</p>
</div>
    <div class="search-row">
      <input id="searchInput" placeholder="Search products, e.g. laptop, earbuds..." />
      <select id="catFilter">
        <option value="">All Categories</option>
        <?php foreach($cats as $c): ?>
          <option value="<?=htmlspecialchars($c['category'])?>"><?=htmlspecialchars($c['category'])?></option>
        <?php endforeach; ?>
      </select>
      <select id="priceFilter">
        <option value="">All Prices</option>
        <option value="0-5000">Under Rs.5,000</option>
        <option value="5000-10000">From Rs.5000 to Rs.10000</option>
         <option value="10000-50000">From Rs.10000 to Rs.50000</option>
             <option value="50000-500000">From Rs.50000 to Rs.500000</option>
      </select>
    </div>
  </div>

  <section id="productGrid" class="products">
    <?php foreach($products as $p): ?>
      <article class="card" data-name="<?=htmlspecialchars(strtolower($p['name']))?>" data-category="<?=htmlspecialchars($p['category'])?>" data-price="<?=$p['price']?>">
        <a href="product.php?id=<?=$p['id']?>"><img src="assets/images/<?=$p['image']?>" alt="<?=$p['name']?>"></a>
        <div class="card-body">
          <h3><?=$p['name']?></h3>
          <p class="price">Rs. <?=$p['price']?></p>
          <a class="btn" href="product.php?id=<?=$p['id']?>">View</a>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
</main>

<script>
window.TechZone = { initFilters: true };
</script>

<?php include 'includes/footer.php'; ?>