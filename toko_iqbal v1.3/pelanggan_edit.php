<?php
require 'koneksi.php';

if(!isset($_SESSION['username']) || ($_SESSION['level'] !== 'pelanggan' && $_SESSION['level'] !== 'admin')) {
    header('location: index.php');
    exit();
}

if(isset($_POST['nama_pelanggan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $insert = mysqli_query($koneksi, "INSERT INTO pelanggan VAlUES(NULL,'$nama','$alamat','$telepon')");

    if($insert) {
        echo "<script>alert('Register Berhasil'); location.href='halamanpelanggan.php';</script>";
    } else {
        echo "<script>alert('Register Gagal'); location.href='register.php';</script>";
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
                <label for="nama_pelanggan">Nama</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            
            <div class="input-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            
            <div class="input-group">
                <label for="telepon">Nomor Telepon</label>
                <input type="text" id="telepon" name="telepon" required>
            </div>
            <button type="submit">Register</button>
            <button onclick="window.location.href='pelanggan_halaman.php'">Kembali Ke Halaman Utama</button>
        </form>
    </div>