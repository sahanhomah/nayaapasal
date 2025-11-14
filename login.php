<?php
require 'includes/db.php';
session_start();
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = $_POST['email']; $pw = $_POST['password'];
  $stmt = $conn->prepare('SELECT id,name,email,role,password FROM users WHERE email=? LIMIT 1');
  $stmt->bind_param('s',$email); $stmt->execute();
  $res = $stmt->get_result()->fetch_assoc();
  if($res && password_verify($pw, $res['password'])){
    $_SESSION['user']=$res;
    header('Location: index.php'); exit;
  } else $msg='Invalid credentials';
}
include 'includes/header.php';
?>
<main class="container">
  <h1>Login</h1>
  <p class="error"><?=$msg?></p>
  <form method="post" class="card simple">
    <label>Email: <input name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button class="btn" type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="register.php">Register</a></p>
</main>
<?php include 'includes/footer.php'; ?>