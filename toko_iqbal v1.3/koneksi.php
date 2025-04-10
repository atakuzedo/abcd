<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "toko_iqbal"); 

if (!$koneksi) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
?>