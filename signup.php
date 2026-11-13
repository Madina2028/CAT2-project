<?php
require 'config.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (fullname, username, email, phone, password_hash) VALUES (?,?,?,?,?)");
        $stmt->execute([$_POST["fullname"], $_POST["username"], $_POST["email"], $_POST["phone"], $hash]);
        $msg = "Registration successful. <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        $msg = "Username or email already exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<style>
body{font-family:Arial;background:#eef2f7;display:flex;justify-content:center;padding-top:60px}
.box{background:#fff;padding:30px;border-radius:8px;width:320px;box-shadow:0 2px 8px #0003}
input,button{width:100%;padding:10px;margin:6px 0;box-sizing:border-box}
button{background:#1e5aa8;color:#fff;border:0;cursor:pointer}
</style>
</head>
<body>
<div class="box">
<h2>Sign Up</h2>
<p><?= $msg ?></p>
<form method="POST">
  <input name="fullname" placeholder="Full name" required>
  <input name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input name="phone" placeholder="Phone">
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
<a href="login.php">Already have an account? Login</a>
</div>
</body>
</html>
