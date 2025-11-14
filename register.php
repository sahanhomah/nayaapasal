<?php
require 'includes/db.php';
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name']; $email=$_POST['email']; $pw=password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare('INSERT INTO users (name,email,password,role) VALUES (?,?,?,"user")');
  $stmt->bind_param('sss',$name,$email,$pw);
  if($stmt->execute()){ header('Location: login.php'); exit; } else $msg='Error creating account';
}
include 'includes/header.php';
?>
<main class="container">
  <h1>Register</h1>
  <p class="error"><?=$msg?></p>
  <form method="post" class="card simple">
    <label>Name: <input name="name" required></label><br>
    <label>Email: <input name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button class="btn" type="submit">Register</button>
  </form>
</main>
<?php include 'includes/footer.php'; ?>