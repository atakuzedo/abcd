<?php
require 'koneksi.php';

if(isset($_GET['pesan'])){
  if($_GET['pesan'] == "gagal"){
    echo "<script>alert('Username atau Password Salah');location.href='index.php';</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Toko Iqbal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form  action="ceklogin.php" method="POST" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <label for="">Belum Punya akun? <a href="register.php">Registerasi disini!</a></label>
        </form>
    </div>