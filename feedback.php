<?php
require 'config.php';
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO feedback (username, rating, comments) VALUES (?,?,?)");
    $stmt->execute([$_SESSION["user"], $_POST["rating"], $_POST["comments"]]);
    $msg = "Feedback submitted successfully.";
}
$rows = $pdo->query("SELECT * FROM feedback ORDER BY submitted_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Feedback</title>
<style>
body{font-family:Arial;background:#eef2f7;padding:40px}
.box{background:#fff;padding:25px;border-radius:8px;max-width:600px;box-shadow:0 2px 8px #0003}
select,textarea,button{width:100%;padding:10px;margin:6px 0;box-sizing:border-box}
button{background:#1e5aa8;color:#fff;border:0;cursor:pointer}
table{border-collapse:collapse;width:100%;margin-top:15px}
th,td{border:1px solid #999;padding:6px;text-align:left}
</style>
</head>
<body>
<div class="box">
<h2>Feedback Form</h2>
<p style="color:green"><?= $msg ?></p>
<form method="POST">
  <label>Rating</label>
  <select name="rating">
    <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
  </select>
  <textarea name="comments" placeholder="Your comments" required></textarea>
  <button type="submit">Submit</button>
</form>
<h3>Submitted feedback</h3>
<table>
  <tr><th>User</th><th>Rating</th><th>Comments</th><th>Time</th></tr>
  <?php foreach ($rows as $r): ?>
  <tr>
    <td><?= htmlspecialchars($r["username"]) ?></td>
    <td><?= $r["rating"] ?></td>
    <td><?= htmlspecialchars($r["comments"]) ?></td>
    <td><?= $r["submitted_at"] ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<p><a href="dashboard.php">Back to dashboard</a></p>
</div>
</body>
</html>
