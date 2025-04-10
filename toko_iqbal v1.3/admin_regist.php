<?php
require 'koneksi.php';
if(!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
    header('location: index.php');
    exit();
}

$username = $_SESSION['username']; 

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $insert = mysqli_query($koneksi, "INSERT INTO user VAlUES(NULL,'$username','$password','$level')");

    if($insert) {
        echo "<script>alert('Register Berhasil'); location.href='index.php';</script>";
    } else {
        echo "<script>alert('Register Gagal');</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin | Toko Iqbal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register Admin / Pelanggan</h2>
        <form  action="" method="POST" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="input-group">
                <select name="level" id="level">
                    <option value="admin">Admin</option>
                    <option value="pelanggan">Pelanggan</option>
                </select>
            </div>
            <button type="submit">Register</button>
            <button onclick="window.location.href='admin_halaman.php'">Kembali Ke Halaman Utama</button>
        </form>
    </div>