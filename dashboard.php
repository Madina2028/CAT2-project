<?php
require 'config.php';
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }
?>
<h2>Welcome, <?= htmlspecialchars($_SESSION["user"]) ?>! You are logged in.</h2>
<p><a href="feedback.php">Go to feedback form</a> | <a href="logout.php">Logout</a></p>
