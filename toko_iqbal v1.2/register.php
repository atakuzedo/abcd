<?php
require 'koneksi.php';

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
    <title>Register Pelanggan | Toko Iqbal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register pelanggan</h2>
        <form  action="" method="POST" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="input-group" style="display: none;">
                <select name="level" id="level">
                    <option value="pelanggan">pelanggan</option>
                </select>
            </div>
            <button type="submit">Register</button>
            <label for="">Sudah Mempunyai Akun? <a href="index.php">Disini!</a></label>
        </form>
    </div>