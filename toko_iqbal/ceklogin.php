<?php
session_start();
require 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
$cek = mysqli_num_rows($login);
if($cek > 0){
  $data = mysqli_fetch_assoc($login);
  if($data['level']=='admin'){
    $_SESSION['username'] = $username;
    $_SESSION['level'] = 'admin';
    header("Location:halamanadmin.php");
  }else if($data['level']=='pelanggan'){
    $_SESSION['username'] = $username;
    $_SESSION['level'] = 'pelanggan';
    header("Location:halamanpelanggan.php");
  }else{
    header("Location:index.php?pesan=gagal");
  }
}else{
  header("Location:index.php?pesan=gagal");
}
?>