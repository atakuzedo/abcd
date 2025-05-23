<?php
require 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] !== 'pelanggan') {
    header('location: index.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .user-info {
      color: #fff;
      margin-bottom: 20px;
      font-size: 1.2em;
    }
    
    .user-info span {
      color: #dd2476; 
      font-weight: bold;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(20, 20, 20);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .pelanggan-container {
      background-color: rgb(40, 40, 40);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
      width: 300px;
      text-align: center;
    }

    h1 {
      color: #fff;
      margin-bottom: 30px;
    }

    button {
      width: 100%;
      padding: 10px;
      background: linear-gradient(90deg, #ff512f, #dd2476, #8a1c4a);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-bottom: 10px;
    }

    button:hover {
      background-color: #004494;
    }
  </style>
</head>
<body>
  <div class="pelanggan-container">
    <h1>Halaman Pelanggan Toko Iqbal</h1>
    <button onclick="window.location.href='registerpelanggan.php'">Registrasi Pelanggan</button>
    <button onclick="window.location.href='logout.php'">Log Out</button>
    <div class="user-info">
      Logged in as: <span><?php echo $username; ?></span>
    </div>
  </div>
</body>
</html>