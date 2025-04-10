<?php
require 'koneksi.php';
$id_barang = $_GET['id_barang'];
$query = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");
if($query) {
    echo "<script>alert('Data Berhasil di Hapus!'); location.href='barang.php';</script>";
} else {
    echo "<script>alert('Data Gagal di Hapus!');</script>";
}


?>