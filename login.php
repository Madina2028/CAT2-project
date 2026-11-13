<?php
require 'config.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST["username"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        $_SESSION["user"] = $user["username"];
        header("Location: dashboard.php");
        exit;
    }
    $msg = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body{font-family:Arial;background:#eef2f7;display:flex;justify-content:center;padding-top:60px}
.box{background:#fff;padding:30px;border-radius:8px;width:320px;box-shadow:0 2px 8px #0003}
input,button{width:100%;padding:10px;margin:6px 0;box-sizing:border-box}
button{background:#1e5aa8;color:#fff;border:0;cursor:pointer}
</style>
</head>
<body>
<div class="box">
<h2>CNS Student Login</h2>
<p style="color:red"><?= $msg ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<a href="signup.php">Create an account</a>
</div>
</body>
</html>
