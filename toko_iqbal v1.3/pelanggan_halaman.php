<?php
require 'koneksi.php';

if(!isset($_SESSION['username']) || ($_SESSION['level'] !== 'pelanggan' && $_SESSION['level'] !== 'admin')) {
  header('location: index.php');
  exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="stylehal.css">
<head>
</head>
<body>
  <div class="pelanggan-container">
    <h1>Halaman Pelanggan Toko Iqbal</h1>
    <button onclick="window.location.href='pelanggan_regist.php'">Registrasi Pelanggan</button>
    <button class="logout" onclick="window.location.href='logout.php'">Log Out</button>
    <div class="user-info">
      Logged in as: <span><?php echo $username; ?></span>
    </div>
  </div>
</body>
</html>