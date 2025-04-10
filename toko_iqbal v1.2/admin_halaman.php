<?php
require 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
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
  <div class="admin-container">
    <h1>Halaman Admin Toko Iqbal</h1>
    <button onclick="window.location.href='admin_regist.php'">Registrasi Admin</button>
    <button onclick="window.location.href='pelanggan_regist_for_admin.php'">Registrasi Pelanggan</button>
    <button onclick="window.location.href='penjualan.php'">Penjualan</button>
    <button onclick="window.location.href='barang.php'">Barang</button>
    <button onclick="window.location.href='logout.php'">Log Out</button>
    <div class="user-info">
      Logged in as: <span><?php echo $username; ?></span>
    </div>
  </div>
</body>
</html>